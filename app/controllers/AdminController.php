<?php
/*
* MyUCP
*/

class AdminController extends Controller {


    public function stats() {
        if(!IsOnline())
            return view("landing");

        if(IsOnline()->user_group <= 2)
            return view("dashboard");

        model("Donation", "Event");

        //  $data['events'] = $this->EventModel->getUserEvents(session("user_id"));
        //    $data['stats'] = $this->DonationModel->getGraphData(session("user_id"));

        $data['events'] = $this->EventModel->getAllUserEvents();
        $data['stats'] = $this->DonationModel->getAllGraphData();

        $data['users'] = $this->UserModel->getUsers();
        $data['donations'] = $this->DonationModel->getAllDonations();
        $data['payouts'] = $this->MoneyModel->getAllPayOuts();

        //   $data['userdonations'] = $this->DonationModel->getUserDonations();


        return view("/admin/stats", $data);
    }

    public function users() {
        if(!IsOnline())
            return view("landing");

        if(IsOnline()->user_group <= 2)
            return view("dashboard");

        model("User");

        $data['users'] = $this->UserModel->getUsers();


        return view("/admin/users/all", $data);
    }

    public function editUsers($id) {
        if(!IsOnline())
            return view("landing");

        if(IsOnline()->user_group <= 2)
            return view("dashboard");

        model("User", "Donation");

        $data['user'] = $this->UserModel->getUser($id);


        $data['user']->user_wallets = json_decode($data['user']->user_wallets);
        $data['user']->user_all_balance = $this->DonationModel->getBalance($id, 3)['balance'];
        $data['user']->user_stream_time = (float)($this->UserModel->getStreamTime($id) / 60);
        $balance = $this->UserModel->getBalance($id);
        $data['user']->user_balance = (empty($balance)) ? 0 : $balance;
        $data['ip'] = $this->UserModel->getLog($id);
        //   $wallets = json_decode($data['user']->user_wallets);
        //$data['user']->user_stream_time = (float) ($this->UserModel->getStreamTime($id) / 60);
        //   $data['user']->user_balance = (empty($balance)) ? 0 : $balance;

        //dd($data['user']);

        return view("/admin/users/index", $data);
    }

    public function payouts() {
        if(!IsOnline())
            return view("landing");

        if(IsOnline()->user_group <= 2)
            return view("dashboard");


        $data['payouts'] = $this->MoneyModel->getAllPayOuts();

        return view("/admin/payouts", $data);
    }


    public function payoutsPost(){

        model("Money");

        switch (Request::post("ajax")) {
            case "okRequest":
                if(empty(Request::post('item_id')))
                    return json_encode(["status" => "error", "error" => "Укажите ID выплаты!"]);
                $this->MoneyModel->editMoney(Request::post('item_id'), ['money_status' => 1]);

                break;
            case "aremoveRequest":
                if(empty(Request::post('item_id')))
                    return json_encode(["status" => "error", "error" => "Укажите ID выплаты!"]);
                $this->MoneyModel->editMoney(Request::post('item_id'), ['money_status' => 2]);

                break;
        }

        return json_encode(['status' => "success"]);

    }


    public function verify($id, $code)
    {
        model('User');
        $user = $this->UserModel->getUser($id)[0];
        dd($user);
        if($code == strrev(md5($user['user_login'])))
        {
            Builder::table('users')->where('user_id', $user['user_id'])
                ->set(['user_group' => 1])
                ->update();
            redirect(route("user.profile"));
        }
        else
            abort(401,lang('errors/system.verify_error'));
    }

    public function post_user()
    {
        model('User');

        if (!($user = IsOnline()))
            return abort(403);

        $user->user_wallets = json_decode($user->user_wallets);

        //Email Verify POST
        if (!empty(Request::post('firstEmail'))) {
            if (filter_var(Request::post('firstEmail'), FILTER_VALIDATE_EMAIL) && IsOnline()->user_group == 0) {
                $this->UserModel->editUser($user->user_id, ['user_email' => Request::post('firstEmail')]);
                $this->UserModel->sendMailTo(IsOnline()->user_id);
            } else {
                abort(401, lang('errors/system.incorrect_mail'));
            }
        } elseif(!empty(Request::post('change_email'))) {
            if(empty(Request::post('value')))
                return json_encode(["status" => "error", "error" => "Введите новый E-mail адрес!"]);

            model("Secure");

            $action_id = $this->SecureModel->addAction(session("user_id"), 1, json_encode(['email' => Request::post("value")]));
            $this->UserModel->sendChangeMail(session("user_id"), $action_id);
            return json_encode(['status' => "success"]);
        } elseif(!empty(Request::post('pay_wallet'))) {
            if(Request::post("name") == "qiwi") {
                $data = [
                    "qiwi"  =>  Request::post('value'),
                    "webmoney"  =>  $user->user_wallets->webmoney,
                    "yamoney"   =>  $user->user_wallets->yamoney,
                    "bank"      =>  $user->user_wallets->bank,
                ];
            }

            switch (Request::post("name")) {
                case "qiwi":
                    if(empty(Request::post('value')))
                        return json_encode(["status" => "error", "error" => "Введите номер телефона кошелька Qiwi!"]);

                    $data = [
                        "qiwi"  =>  Request::post('value'),
                        "webmoney"  =>  $user->user_wallets->webmoney,
                        "yamoney"   =>  $user->user_wallets->yamoney,
                        "bank"      =>  $user->user_wallets->bank,
                    ];
                    break;
                case "webmoney":
                    if(empty(Request::post('value')))
                        return json_encode(["status" => "error", "error" => "Введите номер кошелька WebMoney!"]);

                    $data = [
                        "qiwi"  =>  $user->user_wallets->qiwi,
                        "webmoney"  =>  Request::post('value'),
                        "yamoney"   =>  $user->user_wallets->yamoney,
                        "bank"      =>  $user->user_wallets->bank,
                    ];
                    break;
                case "yamoney":
                    if(empty(Request::post('value')))
                        return json_encode(["status" => "error", "error" => "Введите номер кошелька Яндекс.Деньги!"]);

                    $data = [
                        "qiwi"  =>  $user->user_wallets->qiwi,
                        "webmoney"  =>  $user->user_wallets->webmoney,
                        "yamoney"   =>  Request::post('value'),
                        "bank"      =>  $user->user_wallets->bank,
                    ];
                    break;
                case "bank":
                    if(empty(Request::post('value')))
                        return json_encode(["status" => "error", "error" => "Введите номер банковского счета!"]);

                    $data = [
                        "qiwi"  =>  $user->user_wallets->qiwi,
                        "webmoney"  =>  $user->user_wallets->webmoney,
                        "yamoney"   =>  $user->user_wallets->yamoney,
                        "bank"      =>  Request::post('value'),
                    ];
                    break;
            }

            $this->UserModel->editUser($user->user_id, [
                'user_wallets' => json_encode($data)
            ]);

            return json_encode(['status' => "success"]);
        } else {
            abort(401, lang('errors/system.all_rows_req'));
        }
    }

    public function profile()
    {
        if(!($data['user'] = IsOnline()))
            abort(403);

        model("User", "Donation");

        $data['user']->user_wallets = json_decode($data['user']->user_wallets);
        $data['user']->user_all_balance = $this->DonationModel->getBalance(session("user_id"), 3)['balance'];
        $data['user']->user_stream_time = (float) ($this->UserModel->getStreamTime(session("user_id")) / 60);
        $balance = $this->UserModel->getBalance(session('user_id'));
        $data['user']->user_balance = (empty($balance)) ? 0 : $balance;

        return view("user/profile", $data);
    }

    public function check_url($url)
    {
        model("User");

        if($this->UserModel->checkDomain($url) == 0) {
            return json_encode(["status" => "success"]);
        } else {
            return json_encode(["status" => "error", "error" => "Адрес занят"]);
        }
    }

    public function donations()
    {
        model("Donation");
        library('pagination');

        $limit = 15;
        $page = (!empty(Request::get("page"))) ? Request::get("page") : 1;

        $paginationLib = new paginationLibrary;
        $total = $this->DonationModel->getCountUserDonations(session("user_id"));
        $options = array(
            'start'		=>	($page - 1) * $limit,
            'limit'		=>	$limit
        );

        $paginationLib->total = $total;
        $paginationLib->page = $page;
        $paginationLib->limit = $limit;
        $paginationLib->url = '/donations?page={page}';

        $pagination = $paginationLib->render();

        $data['pagination'] = $pagination;

        if ($options['start'] < 0) {
            $options['start'] = 0;
        }
        if ($options['limit'] < 1) {
            $options['limit'] = $limit;
        }
        $data['donations'] = $this->DonationModel->getUserDonations(session("user_id"), $options);

        return view("user/donations", $data);
    }

    public function messages()
    {
        model("Message");
        library('pagination');

        $limit = 15;
        $page = (!empty(Request::get("page"))) ? Request::get("page") : 1;

        $paginationLib = new paginationLibrary;
        $total = $this->MessageModel->getCountUserMessages(session("user_id"));
        $options = array(
            'start'		=>	($page - 1) * $limit,
            'limit'		=>	$limit
        );

        $paginationLib->total = $total;
        $paginationLib->page = $page;
        $paginationLib->limit = $limit;
        $paginationLib->url = '/messages?page={page}';

        $pagination = $paginationLib->render();

        $data['pagination'] = $pagination;

        if ($options['start'] < 0) {
            $options['start'] = 0;
        }
        if ($options['limit'] < 1) {
            $options['limit'] = $limit;
        }
        $data['messages'] = $this->MessageModel->getUserMessages(session("user_id"), $options);

        return view("user/messages", $data);
    }

    public function money()
    {
        model("User", "Money");
        library('pagination');

        $limit = 15;
        $page = (!empty(Request::get("page"))) ? Request::get("page") : 1;

        $paginationLib = new paginationLibrary;
        $total = $this->MoneyModel->getCountRequestsMoney(session("user_id"));
        $options = array(
            'start'		=>	($page - 1) * $limit,
            'limit'		=>	$limit
        );

        $paginationLib->total = $total;
        $paginationLib->page = $page;
        $paginationLib->limit = $limit;
        $paginationLib->url = '/money?page={page}';

        $pagination = $paginationLib->render();

        $data['pagination'] = $pagination;

        if ($options['start'] < 0) {
            $options['start'] = 0;
        }
        if ($options['limit'] < 1) {
            $options['limit'] = $limit;
        }

        $data['money'] = $this->MoneyModel->getRequests(session("user_id"), $options);

        return view("user/money", $data);
    }

    public function moneyPost()
    {
        model("User", "Money", "Message");

        $money_systems = [
            1 => "qiwi",
            "webmoney",
            "yamoney",
            "bank",
        ];

        if(Request::post("request_money")) {
            if(Request::post("money_system") >= 1 && Request::post("money_system") <= 4) {
                if(Request::post("money_sum") >= 50 && Request::post("money_sum") <= 15000) {
                    if(isOnline()->user_balance >= Request::post("money_sum")) {
                        $wallets = json_decode(isOnline()->user_wallets, true);
                        if(!empty($wallets[$money_systems[Request::post("money_system")]])) {
                            $code = md5(time() . (Request::post("money_sum") + Request::post("money_system")) . "donateforme");
                            $this->MoneyModel->addRequest(
                                session("user_id"),
                                (int)Request::post("money_sum"),
                                (int)Request::post("money_system"),
                                $code
                            );
                            $this->MessageModel->addMessage(session("user_id"), "Вы запросили " . Request::post("money_sum") . " руб. на выплату.");
                            $result = ['status' => "success"];
                        } else {
                            $result = ["status" => "error", "error" => "В личных настройках укажите реквизиты для выбранной системы!"];
                        }
                    } else {
                        $result = ["status" => "error", "error" => "На вашем балансе недостаточно денег!"];
                    }
                } else {
                    $result = ["status" => "error", "error" => "Минимальная сумма для запроса выплаты 50 руб. Максимальная - 15 000 руб.!"];
                }
            } else {
                $result = ["status" => "error", "error" => "Выберите платежную систему для выплаты!"];
            }
        } else {
            $result = ["status" => "error", "error" => "При выполнении запроса произошла ошибка. Повторите попытку!"];
        }

        return json_encode($result);
    }

    public function login($type) {

        if(IsOnline())
            redirect(route("home"));

        switch($type)
        {
            case "twitch":
                $this->LoginWithTwitch();
                break;
            case "youtube":
                $this->LoginWithYouTube();
                break;
            case "hitbox":
                $this->LoginWithHitbox();
                break;
            case "vk":
                $this->LoginWithVk();
                break;

            default:
                abort(404);
                break;
        }
    }

    private function LoginWithYouTube()
    {
        if(empty(Request::get("code"))) {

            $url = 'https://accounts.google.com/o/oauth2/auth';

            $params = array(
                'redirect_uri' => config()->youtube['redirect_uri'],
                'response_type' => 'code',
                'client_id' => config()->youtube['client_id'],
                'scope' => 'https://www.googleapis.com/auth/youtube'
            );

            redirect($url . '?' . urldecode(http_build_query($params)));
        } else {
            $result = false;

            $params = [
                'client_id' => config()->youtube['client_id'],
                'client_secret' => config()->youtube['client_secret'],
                'redirect_uri' => config()->youtube['redirect_uri'],
                'grant_type' => 'authorization_code',
                'code' => Request::get('code')
            ];

            $url = 'https://accounts.google.com/o/oauth2/token';

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, urldecode(http_build_query($params)));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            $result = curl_exec($curl);
            curl_close($curl);

            $tokenInfo = json_decode($result, true);

            if(isset($tokenInfo['access_token'])) {
                $userInfo = json_decode(file_get_contents("https://www.googleapis.com/youtube/v3/subscriptions?part=snippet&maxResults=1&myRecentSubscribers=true&access_token=".$tokenInfo['access_token']), true);
                $userInfo = $this->getYouTubeChannelInfo($userInfo);

                if(!($user = $this->UserModel->getUser($userInfo['id'], "user_youtube"))) {
                    $data = [
                        "user_login" 	            =>	"youtube_" . $userInfo['id'],
                        "user_login_show"           =>	$userInfo['login'],
                        "user_domain"               =>  "youtube_" . $userInfo['id'],
                        "user_avatar"	            =>	(!empty($userInfo['avatar'])) ? $userInfo['avatar'] : "/assets/images/no_avatar.png",
                        "user_youtube"	            =>	$userInfo['id'],
                        "user_reg_ip"	            =>  ip2long(Request::server("REMOTE_ADDR")),
                        "user_youtube_token"        =>  $tokenInfo['access_token'],
                        "user_youtube_subs"         =>  $userInfo['subs'],
                        "user_youtube_last_sub_id"  =>  $userInfo['last_sub_id'],
                        "user_donate_page"          =>  "{\"min_sum\":\"1\",\"rec_sum\":\"50\",\"text\":\"\",\"fuck_filter\":\"0\",\"fuck_name_filter\":\"0\",\"fuck_words\":\"\",\"bg_color\":\"#e0e0e0\",\"bg_type\":\"1\",\"bg_size\":\"auto\",\"bg_image\":\"\",\"bg_image_name\":\"\",\"bg_repeat\":\"no-repeat\",\"bg_position\":\"center\",\"bg_header_type\":\"1\",\"bg_header_image\":\"\",\"bg_header_size\":\"auto\",\"bg_header_repeat\":\"no-repeat\",\"bg_header_position\":\"center\",\"bg_header_color\":\"#f2f2f2\",\"text_header_color\":\"#000000\",\"btn_color\":\"#ff5400\",\"btn_text_color\":\"#ffffff\"}",
                    ];
                    $id = $this->UserModel->addUser($data);
                    $this->UserModel->trackIP($id, 0);
                    $this->createDefaultWidgets($id);
                    $this->ToOnline($id);
                }

                $this->UserModel->editUser($user['user_id'], ['user_youtube_token' => $tokenInfo['access_token']]);
                return $this->ToOnline($user['user_id']);
            }
        }
    }

    private function LoginWithTwitch()
    {
        library("TwitchSDK");
        model("User");

        $twitch = new TwitchSDK(config()->twitch);

        if(empty(Request::get('code')))
            return redirect($twitch->authLoginURL('user_read+user_subscriptions+channel_subscriptions+chat_login'));

        $tokens = $twitch->authAccessTokenGet(Request::get('code'));
        $token = $tokens->access_token;

        $user = $twitch->authUserGet($token);
        $userInfo = $twitch->channelGet($user->name);

        if(!($user = $this->UserModel->getUser($userInfo->name, "user_twitch"))) {
            $data = [
                "user_login" 	=>		"twitch_" . $userInfo->name,
                "user_login_show" =>	$userInfo->display_name,
                "user_domain"   =>      "twitch_" . $userInfo->name,
                "user_avatar"	=>		(!empty($userInfo->logo)) ? $userInfo->logo : "/assets/images/no_avatar.png",
                "user_twitch"	=>		$userInfo->name,
                "user_reg_ip"	=>		ip2long(Request::server("REMOTE_ADDR")),
                "user_twitch_token"=>   $token,
                "user_donate_page"          =>  "{\"min_sum\":\"1\",\"rec_sum\":\"50\",\"text\":\"\",\"fuck_filter\":\"0\",\"fuck_name_filter\":\"0\",\"fuck_words\":\"\",\"bg_color\":\"#e0e0e0\",\"bg_type\":\"1\",\"bg_size\":\"auto\",\"bg_image\":\"\",\"bg_image_name\":\"\",\"bg_repeat\":\"no-repeat\",\"bg_position\":\"center\",\"bg_header_type\":\"1\",\"bg_header_image\":\"\",\"bg_header_size\":\"auto\",\"bg_header_repeat\":\"no-repeat\",\"bg_header_position\":\"center\",\"bg_header_color\":\"#f2f2f2\",\"text_header_color\":\"#000000\",\"btn_color\":\"#ff5400\",\"btn_text_color\":\"#ffffff\"}",
            ];
            $id = $this->UserModel->addUser($data);
            $this->getUserSmiles("twitch", $id, "twitch_" . $userInfo->name);
            $this->UserModel->trackIP($id, 0);
            $this->createDefaultWidgets($id);
            $this->ToOnline($id);
        }

        $this->UserModel->editUser($user['user_id'], ['user_twitch_token' => $token]);
        return $this->ToOnline($user['user_id']);
    }

    private function LoginWithHitbox()
    {
        model("User");

        if(!isset($this->request->get["authToken"]) && !isset($this->request->get["request_token"])) //Переадресация на авторизацию
            redirect("https://api.hitbox.tv/oauth/login?app_token=".config()->hitbox['requestToken']);

        if(!isset($this->request->get["authToken"]))
            $authToken = $this->HitBoxExchangeToken($this->request->get["request_token"]);
        else
            $authToken = $this->request->get["authToken"];

        $userInfo = $this->HitBoxGetUserInfo($authToken);

        if(!($user = $this->UserModel->getUser($userInfo->user_id, "user_hitbox")))
        {
            $data = [
                "user_login" 	=>		"hitbox".$userInfo->user_name,
                "user_login_show"=>     $userInfo->user_name,
                "user_domain"   =>      "hitbox".$userInfo->user_name,
                "user_avatar"	=>		(!empty($userInfo->user_logo)) ? "http://edge.sf.hitbox.tv".$userInfo->user_logo : "/assets/images/no_avatar.png",
                "user_hitbox"	=>		$userInfo->user_name,
                "user_hitbox_token"=>   $authToken,
                "user_hitbox_follows"=> $userInfo->followers,
                "user_hitbox_subs"=>    0,
                "user_hitbox_last_sub"=>"test",
                "user_reg_ip"	=>		ip2long($_SERVER["REMOTE_ADDR"]),
                "user_donate_page"      =>  "{\"min_sum\":\"1\",\"rec_sum\":\"50\",\"text\":\"\",\"fuck_filter\":\"0\",\"fuck_name_filter\":\"0\",\"fuck_words\":\"\",\"bg_color\":\"#e0e0e0\",\"bg_type\":\"1\",\"bg_size\":\"auto\",\"bg_image\":\"\",\"bg_image_name\":\"\",\"bg_repeat\":\"no-repeat\",\"bg_position\":\"center\",\"bg_header_type\":\"1\",\"bg_header_image\":\"\",\"bg_header_size\":\"auto\",\"bg_header_repeat\":\"no-repeat\",\"bg_header_position\":\"center\",\"bg_header_color\":\"#f2f2f2\",\"text_header_color\":\"#000000\",\"btn_color\":\"#ff5400\",\"btn_text_color\":\"#ffffff\"}",
            ];
            $id = Builder::table('users')->insert($data);
            $this->getUserSmiles("hitbox", $id, "hitbox".$userInfo->user_name);
            $this->UserModel->trackIP($id,0);
            $this->createDefaultWidgets($id);
            $this->ToOnline($id);
        }
        else
        {
            $this->ToOnline($user['user_id']);
        }

    }

    private function LoginWithVk()
    {
        model("User");
        if (isset($this->request->get["code"])) {
            $token = $this->VKGetAuthToken($this->request->get["code"]);
            if (isset($token['access_token'])) {
                $userInfo = $this->VKGetUserInfo($token);
                if (isset($userInfo['response'][0]['id'])) {
                    $userInfo = $userInfo['response'][0];
                    if(!($user = $this->UserModel->getUser($userInfo['id'], "user_vk")))
                    {
                        $data = [
                            "user_login" 	=>		"vkid".$userInfo["id"],
                            "user_login_show"=>     $userInfo['first_name']. " " . $userInfo['last_name'],
                            "user_domain"   =>      "vkid".$userInfo["id"],
                            "user_avatar"	=>		/*(!empty($userInfo["photo_big"])) ? $userInfo["photo_big"] :*/ "/assets/images/no_avatar.png",
                            "user_vk"		=>		$userInfo['id'],
                            "user_reg_ip"	=>		ip2long($_SERVER["REMOTE_ADDR"]),
                            "user_donate_page"          =>  "{\"min_sum\":\"1\",\"rec_sum\":\"50\",\"text\":\"\",\"fuck_filter\":\"0\",\"fuck_name_filter\":\"0\",\"fuck_words\":\"\",\"bg_color\":\"#e0e0e0\",\"bg_type\":\"1\",\"bg_size\":\"auto\",\"bg_image\":\"\",\"bg_image_name\":\"\",\"bg_repeat\":\"no-repeat\",\"bg_position\":\"center\",\"bg_header_type\":\"1\",\"bg_header_image\":\"\",\"bg_header_size\":\"auto\",\"bg_header_repeat\":\"no-repeat\",\"bg_header_position\":\"center\",\"bg_header_color\":\"#f2f2f2\",\"text_header_color\":\"#000000\",\"btn_color\":\"#ff5400\",\"btn_text_color\":\"#ffffff\"}",
                        ];
                        $id = Builder::table('users')->insert($data);
                        $this->UserModel->trackIP($id,0);
                        $this->createDefaultWidgets($id);
                        $this->ToOnline($id);
                    }
                    else {
                        $this->ToOnline($user['user_id']);
                    }

                }
            }
        }
        else
        {
            $this->VKRedirectToLogin();
        }

    }

    function get_curl($url) {
        if(function_exists('curl_init')) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            $output = curl_exec($ch);
            echo curl_error($ch);
            curl_close($ch);
            return $output;
        } else {
            return file_get_contents($url);
        }
    }

    function post_curl($url,$token) {
        if(function_exists('curl_init')) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_POST, true);
            $row = "request_token=".$token."&app_token=".config()->hitbox['requestToken']."&hash=".base64_encode(config()->hitbox["requestToken"].config()->hitbox["secret"]);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $row);
            $output = curl_exec($ch);
            echo curl_error($ch);
            curl_close($ch);
            return $output;
        } else {
            return file_get_contents($url);
        }
    }

    private function ToOnline($id)
    {
        model("User");
        $this->UserModel->trackIP($id,1);
        $this->session->data['user_id'] = $id;
        redirect(route("home"));
    }

    public function logout()
    {
        if(IsOnline())
            unset($this->session->data['user_id']);
        redirect(route("home"));
    }

    /*HitBoxAuth*/
    private function HitBoxGetUserInfo($authToken)
    {
        $name = json_decode($this->get_curl("https://api.hitbox.tv/userfromtoken/".$authToken))->user_name;
        $userInfo = json_decode($this->get_curl("https://api.hitbox.tv/user/".$name));

        return $userInfo;
    }

    private function HitBoxExchangeToken($token)
    {
        return json_decode($this->post_curl("https://api.hitbox.tv/oauth/exchange",$token))->access_token;
    }
    /*EndHitBoxAuth*/

    /*VKAuth*/
    private function VKRedirectToLogin()
    {
        $url = 'http://oauth.vk.com/authorize';
        $params = array(
            'client_id'     => config()->vk["client_id"],
            'redirect_uri'  => config()->vk["redirect_uri"],
            'response_type' => 'code'
        );
        redirect($url.'?'.urldecode(http_build_query($params)));
    }

    private function VKGetAuthToken($code)
    {
        $params = [
            'client_id'     => config()->vk["client_id"],
            'client_secret' => config()->vk["client_secret"],
            'code' => $code,
            'redirect_uri'  => config()->vk["redirect_uri"],
        ];
        return json_decode($this->get_curl('https://oauth.vk.com/access_token' . '?' . urldecode(http_build_query($params))), true);
    }

    private function VKGetUserInfo($token)
    {
        $params = [
            'uids'         => $token['user_id'],
            'fields'       => 'id,first_name,last_name,screen_name,sex,bdate,photo_big',
            'v'            => '5.87',
            'access_token' => $token['access_token']
        ];
        return $userInfo = json_decode($this->get_curl('https://api.vk.com/method/users.get' . '?' . urldecode(http_build_query($params))), true);
    }

    /*EndVKAuth*/

    /* YouTube */
    private function getYouTubeChannelInfo($result)
    {
        return [
            "id" => $result['items'][0]['snippet']['channelId'],
            "login" => $result['items'][0]['snippet']['title'],
            "subs" => $result['pageInfo']['totalResults'],
            "last_sub_id" => $result['items'][0]['snippet']['channelId'],
            "avatar" => $result['items'][0]['snippet']['thumbnails']['medium']['url'],
        ];
    }
    /* EndYouTube */

    private function getUserSmiles($platform, $user_id, $login)
    {
        model("Smile");

        if($platform == "twitch") {

            $channels = json_decode($this->get_curl("https://twitchemotes.com/api_cache/v2/subscriber.json"));
            foreach($channels->channels as $name => $channel)
            {
                if($name == $login) {
                    foreach ($channel->emotes as $emote)
                    {
                        $this->SmileModel->addSmile("twitch", [
                            "user_id" => $user_id,
                            "smile_image_id" => $emote->image_id,
                            "smile_code" => $emote->code,
                        ]);
                    }
                }
            }

            $data['user_id'] = $user_id;
        } else {
            $emotes = json_decode($this->get_curl("https://api.hitbox.tv/chat/emotes/".$login));
            foreach ($emotes as $emote)
            {
                $this->SmileModel->addSmile("hitbox", [
                    "user_id" => $user_id,
                    "smile_name" => $emote->icon_name,
                    "smile_image" => "http://edge.sf.hitbox.tv".$emote->icon_path,
                ]);
            }
        }
    }

    private function createDefaultWidgets($user_id)
    {
        model("Widget");

        $this->WidgetModel->newWidget("Виджет оповещений", 1, $user_id);
        $this->WidgetModel->newWidget("Виджет сбора средств", 2, $user_id);
        $this->WidgetModel->newWidget("Виджет статистики", 3, $user_id);
        $this->WidgetModel->newWidget("Виджет голосования", 4, $user_id);
        $this->WidgetModel->newWidget("Последние действия", 5, $user_id);
    }

    public function donate($login)
    {
        model("User", "Donation", "Smile");

        $data = $this->UserModel->getUserDonatePage($login);
        $goals = 0;

        foreach ($data['goals'] as &$goal) {
            $goals++;
            $goal['widget_config'] = json_decode($goal['widget_config']);
        }

        $data['vote'] = (object) $data['vote'][0];
        $data['vote']->widget_config = json_decode($data['vote']->widget_config);

        if($data['vote']->widget_config->status != 1)
            unset($data['vote']);
        else {
            $variants_ready = [];
            $variants_sum = 0;

            foreach ($data['vote']->widget_config->variants as $key => $value) {
                $variants_ready[$key]['name'] = base64_decode($value);
                $variants_ready[$key]['balance'] = $this->DonationModel->getVotePercent($data['vote']->widget_id, $key);
                $variants_sum += $variants_ready[$key]['balance'];
            }

            foreach ($variants_ready as $key => $value) {
                if($variants_ready[$key]['balance'] != 0) {
                    $variants_ready[$key]['percent'] = round(100 / ($variants_sum / $variants_ready[$key]['balance']), 2);
                    $variants_ready[$key]['bar_percent'] = 385 - ((385 / 100) * $variants_ready[$key]['percent']);
                } else {
                    $variants_ready[$key]['percent'] = 0;
                    $variants_ready[$key]['bar_percent'] = "385";
                }
            }
            $data['vote']->widget_config->variants = $variants_ready;
        }

        $data['smiles'] = $this->SmileModel->getUserSmiles($data['user']->user_id);

        if($login == isOnline()->user_domain) {
            return view("donate/editor", $data);
        }

        return view("donate/view", $data);
    }

    public function donatePost($login)
    {
        model("User", "Donation", "Filter");

        $data = $this->UserModel->getUserDonatePage($login);

        $user = $data['user'];
        $settings = json_decode($user->user_donate_page);
        unset($data);

        if(!empty(Request::post("user_name"))) {
            if(!empty(Request::post("donate_sum"))) {
                if(Request::post("donate_sum") >= $settings->min_sum) {
                    $data = [];

                    if (!empty(Request::post("donate_text"))) {

                        if(mb_strlen(preg_replace('/<\/?[^>]+>/ui', "s", html_entity_decode(Request::post("donate_text")))) > 300)
                            return json_encode($result = ['status' => "error", "error" => "Максимальное количество символов в тексте <b>300<b>!"]);

                        if($settings->fuck_filter == 0) {
                            $data['text'] = Request::post("donate_text");
                        } else {
                            $data["text"] = $this->FilterModel->filter(Request::post("donate_text"));
                            $data["text"] = $this->FilterModel->custom_filter($data["text"], $settings->fuck_words);
                        }

                        $data['text'] = $this->FilterModel->smileFilter($data['text']);
                        $data['text'] = $this->FilterModel->url_filter($data['text']);
                        $data['text'] = $this->FilterModel->spacefilter($data['text']);
                        $data["text"] = base64_encode($data["text"]);
                    }

                    if (!empty(Request::post("goal_id")))
                        $data['goal'] = Request::post("goal_id");

                    if (!empty(Request::post("vote"))) {
                        $vote = explode("_", Request::post("vote"));
                        $data['vote'] = [$vote[0] => $vote[1]];
                    }

                    if($settings->fuck_name_filter == 0) {
                        $u_name = Request::post("user_name");
                    } else {
                        $u_name = $this->FilterModel->filter(Request::post("user_name"), "Аноним");
                        $u_name = $this->FilterModel->custom_filter($u_name, $settings->fuck_words, "Аноним");
                    }

                    $id = $this->DonationModel->addDonation(
                        $user->user_id,
                        (int)Request::post("donate_sum"),
                        $u_name,
                        $data
                    );

                    cookie("user_name", Request::post("user_name"));

                    $result = ['status' => "success", "id" => $id];
                } else {
                    $result = ['status' => "error", "error" => "Минимальная сумма пополнени <b>". $settings->min_sum ." руб.</b>!"];
                }
            } else {
                $result = ['status' => "error", "error" => "Введите сумму!"];
            }
        } else {
            $result = ['status' => "error", "error" => "Введите Ваше имя!"];
        }

        return json_encode($result);
    }

    public function editorDonatePage()
    {
        if(!($user = isOnline()))
            abort(403);

        model("User");

        $settingsR = Request::post("settings");

        $settings = json_decode($user->user_donate_page, true);
        $settings['bg_color'] = $settingsR['bg_color'];
        $settings['bg_type'] = $settingsR['bg_type'];
        $settings['bg_size'] = $settingsR['bg_size'];
        $settings['bg_image'] = $settingsR['bg_image'];
        $settings['bg_image_name'] = $settingsR['bg_image_name'];
        $settings['bg_repeat'] = $settingsR['bg_repeat'];
        $settings['bg_position'] = $settingsR['bg_position'];
        $settings['bg_header_type'] = $settingsR['bg_header_type'];
        $settings['bg_header_image'] = $settingsR['bg_header_image'];
        $settings['bg_header_size'] = $settingsR['bg_header_size'];
        $settings['bg_header_repeat'] = $settingsR['bg_header_repeat'];
        $settings['bg_header_position'] = $settingsR['bg_header_position'];
        $settings['bg_header_color'] = $settingsR['bg_header_color'];
        $settings['text_header_color'] = $settingsR['text_header_color'];
        $settings['btn_color'] = $settingsR['btn_color'];
        $settings['btn_text_color'] = $settingsR['btn_text_color'];

        if($this->UserModel->editUser(session("user_id"), ['user_donate_page' => json_encode($settings)])) {
            $result = ["status" => "success"];
        } else {
            $result = ["status" => "error", "error" => "При сохранении изменений произошла ошибка. Повторите попытку позже!"];
        }

        return json_encode($result);
    }

    public function donationPage()
    {

        if(!($user = isOnline()))
            abort(403);

        $data['user'] = $user;
        $data['settings'] = json_decode($user->user_donate_page);

        return view("user/donation-page", $data);
    }

    public function donationPagePost()
    {
        if(!($user = isOnline()))
            abort(403);

        $settingsR = Request::post("settings");

        $settings = json_decode($user->user_donate_page, true);
        $settings['min_sum'] = $settingsR['min_sum'];
        $settings['user_domain'] = $settingsR['user_domain'];
        $settings['rec_sum'] = $settingsR['rec_sum'];
        $settings['text'] = base64_encode($settingsR['text']);
        $settings['fuck_filter'] = $settingsR['fuck_filter'];
        $settings['fuck_name_filter'] = $settingsR['fuck_name_filter'];
        $settings['fuck_words'] = base64_encode($settingsR['fuck_words']);

        if($settings['min_sum'] >= 1) {
            if($settings['rec_sum'] >= 0) {

                $data['user_donate_page'] = json_encode($settings);

                if(!empty($settings['user_domain'])) {
                    if($this->UserModel->checkDomain($settings['user_domain']) != 0) {
                        $result = ["status" => "error", "error" => "Введенный вами адрес занят!"];
                        return json_encode($result);
                    } else {
                        $data['user_domain'] = $settings['user_domain'];
                    }
                }

                if ($this->UserModel->editUser(session("user_id"), $data)) {
                    $result = ["status" => "success"];
                } else {
                    $result = ["status" => "error", "error" => "При сохранении изменений произошла ошибка. Повторите попытку позже!"];
                }
            } else {
                $result = ["status" => "error", "error" => "Рекомендуемая сумма не может быть меньше 0!"];
            }
        } else {
            $result = ["status" => "error", "error" => "Минимальная сумма не может быть меньше 1 руб.!"];
        }

        return json_encode($result);
    }
}