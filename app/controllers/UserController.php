<?php
/*
* MyUCP
*/

class UserController extends Controller {

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
			Builder::table('secure_actions')->where('user_id', $user['user_id'])
	             	->set(['action_status' => 1])
	             	->update();
	        redirect(route("user.profile"));
			header('Location: https://sdonate.ru/user/');

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
                        "qiwi"      =>  Request::post('value'),
                        "webmoney"  =>  $user->user_wallets->webmoney,
                        "yamoney"   =>  $user->user_wallets->yamoney,
                        "bank"      =>  $user->user_wallets->bank,
                        "paypal"    =>  $user->user_wallets->paypal,
                    ];
                    break;
                case "webmoney":
                    if(empty(Request::post('value')))
                        return json_encode(["status" => "error", "error" => "Введите номер кошелька WebMoney!"]);

                    $data = [
                        "qiwi"      =>  $user->user_wallets->qiwi,
                        "webmoney"  =>  Request::post('value'),
                        "yamoney"   =>  $user->user_wallets->yamoney,
                        "bank"      =>  $user->user_wallets->bank,
                        "paypal"    =>  $user->user_wallets->paypal,
                    ];
                    break;
                case "yamoney":
                    if(empty(Request::post('value')))
                        return json_encode(["status" => "error", "error" => "Введите номер кошелька Яндекс.Деньги!"]);

                    $data = [
                        "qiwi"      =>  $user->user_wallets->qiwi,
                        "webmoney"  =>  $user->user_wallets->webmoney,
                        "yamoney"   =>  Request::post('value'),
                        "bank"      =>  $user->user_wallets->bank,
                        "paypal"    =>  $user->user_wallets->paypal,
                    ];
                    break;
                case "bank":
                    if(empty(Request::post('value')))
                        return json_encode(["status" => "error", "error" => "Введите номер банковского счета!"]);

                    $data = [
                        "qiwi"      =>  $user->user_wallets->qiwi,
                        "webmoney"  =>  $user->user_wallets->webmoney,
                        "yamoney"   =>  $user->user_wallets->yamoney,
                        "bank"      =>  Request::post('value'),
                        "paypal"    =>  $user->user_wallets->paypal,
                    ];
                    break;
                 case "paypal":
                    if(empty(Request::post('value')))
                        return json_encode(["status" => "error", "error" => "Укажите Paypal кошелек!"]);

                    $data = [
                        "qiwi"      =>  $user->user_wallets->qiwi,
                        "webmoney"  =>  $user->user_wallets->webmoney,
                        "yamoney"   =>  $user->user_wallets->yamoney,
                        "bank"      =>  $user->user_wallets->bank,
                        "paypal"    =>  Request::post('value'),
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
        $data['ip']  = $this->UserModel->getLog(session("user_id"));

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

        $limit = 10;
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

    public function faq()
    {
        model("Faq");
        library('pagination');

        $limit = 10;
        $page = (!empty(Request::get("page"))) ? Request::get("page") : 1;

        $paginationLib = new paginationLibrary;
        $total = $this->FaqModel->getCountFaq(session("user_id"));
        $options = array(
            'start'     =>  ($page - 1) * $limit,
            'limit'     =>  $limit
        );

        $paginationLib->total = $total;
        $paginationLib->page = $page;
        $paginationLib->limit = $limit;
        $paginationLib->url = '/faq?page={page}';

        $pagination = $paginationLib->render();

        $data['pagination'] = $pagination;

        if ($options['start'] < 0) {
            $options['start'] = 0;
        }
        if ($options['limit'] < 1) {
            $options['limit'] = $limit;
        }
        $data['faq'] = $this->FaqModel->getFaq($options);

        return view("user/faq", $data);
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
        //$block_start = $user['user_reg_time'];
        //$block_end = date("now") - date("Y-m-d H:i:s", strtotime($user['user_reg_time']. " + 3 days"));

        if(Request::post("request_money")) {
            if(strtotime(date("now")) >= strtotime($user['user_block_time'])){
            //if( $block_start < $block_end ){            
                if(Request::post("money_system") >= 1 && Request::post("money_system") <= 4) {
                    if(Request::post("money_sum") >= 50 && Request::post("money_sum") <= 14999) {
                        if(isOnline()->user_balance >= Request::post("money_sum")) {
                            $wallets = json_decode(isOnline()->user_wallets, true);
                            if(!empty($wallets[$money_systems[Request::post("money_system")]])) {
    							if(Request::post("money_system") == 1){
    								$system = "qiwi";
    								$wallet = $wallets["qiwi"];
                                
                                $percent = Request::post("money_sum") * 0.055;
                                $sum = Request::post("money_sum") - $percent;

                                $code = $this->MoneyModel->addRequest(
                                    session("user_id"),
                                    (float)Request::post("money_sum"),
                                    (float)$sum,
                                    (int)Request::post("money_system"),
                                    $wallet
                                );

    							$json_money = @file_get_contents('https://unitpay.ru/api?method=massPayment&params[sum]='.(float)$sum.'&params[purse]='.$wallet.'&params[login]='.$this->config->masspayment["login"].'&params[transactionId]='.$code.'&params[secretKey]='.$this->config->masspayment["secret_key"].'&params[paymentType]='.$system);
                                $info_money = json_deocde($json_money);
                                if($info_money['result']['status'] == 'success'){
                                $update = $this->MoneyModel->editMoney($code, ['money_status' => '1']);
                                $this->MessageModel->addMessage(session("user_id"), "Вы запросили " . Request::post("money_sum") . " руб. на выплату.");
                                $result = ['status' => "success"];
                                }
    							}elseif(Request::post("money_system") == 2){
    								$system = "webmoney";
    								$wallet = $wallets["webmoney"];
                                
                                $percent = Request::post("money_sum") * 0.045;
                                $sum = Request::post("money_sum") - $percent;

                                $code = $this->MoneyModel->addRequest(
                                    session("user_id"),
                                    (float)Request::post("money_sum"),
                                    (float)$sum,
                                    (int)Request::post("money_system"),
                                    $wallet
                                );
    							@file_get_contents('https://unitpay.ru/api?method=massPayment&params[sum]='.(float)$sum.'&params[purse]='.$wallet.'&params[login]='.$this->config->masspayment["login"].'&params[transactionId]='.$code.'&params[secretKey]='.$this->config->masspayment["secret_key"].'&params[paymentType]='.$system);

                                $this->MessageModel->addMessage(session("user_id"), "Вы запросили " . Request::post("money_sum") . " руб. на выплату.");
                                $result = ['status' => "success"];

    							}elseif(Request::post("money_system") == 3){
    								$system = "yandex";
    								$wallet = $wallets["yamoney"];
                                
                                $percent = Request::post("money_sum") * 0.055;
                                $sum = Request::post("money_sum") - $percent;

                                $code = $this->MoneyModel->addRequest(
                                    session("user_id"),
                                    (float)Request::post("money_sum"),
                                    (float)$sum,
                                    (int)Request::post("money_system"),
                                    $wallet
                                );
    							@file_get_contents('https://unitpay.ru/api?method=massPayment&params[sum]='.(float)$sum.'&params[purse]='.$wallet.'&params[login]='.$this->config->masspayment["login"].'&params[transactionId]='.$code.'&params[secretKey]='.$this->config->masspayment["secret_key"].'&params[paymentType]='.$system);

                                $this->MessageModel->addMessage(session("user_id"), "Вы запросили " . Request::post("money_sum") . " руб. на выплату.");
                                $result = ['status' => "success"];

    							}elseif(Request::post("money_system") == 4){
                                if(Request::post("money_sum") >= 1000){
                                    $system = "card";
                                    $wallet = $wallets["bank"];     

                                $percent = Request::post("money_sum") * 0.05;

                                if($percent < 180 ){
                                $sum = Request::post("money_sum") - '180';
                                $code = $this->MoneyModel->addRequest(
                                    session("user_id"),
                                    (float)Request::post("money_sum"),
                                    (float)$sum,
                                    (int)Request::post("money_system"),
                                    $wallet
                                );
    							@file_get_contents('https://unitpay.ru/api?method=massPayment&params[sum]='.(float)$sum.'&params[purse]='.$wallet.'&params[login]='.$this->config->masspayment["login"].'&params[transactionId]='.$code.'&params[secretKey]='.$this->config->masspayment["secret_key"].'&params[paymentType]='.$system);
                                }else{
                                $sum = Request::post("money_sum") - $percent;
                                $code = $this->MoneyModel->addRequest(
                                    session("user_id"),
                                    (float)Request::post("money_sum"),
                                    (float)$sum,
                                    (int)Request::post("money_system"),
                                    $wallet
                                );
                                @file_get_contents('https://unitpay.ru/api?method=massPayment&params[sum]='.(float)$sum.'&params[purse]='.$wallet.'&params[login]='.$this->config->masspayment["login"].'&params[transactionId]='.$code.'&params[secretKey]='.$this->config->masspayment["secret_key"].'&params[paymentType]='.$system);
                                }
                                $this->MessageModel->addMessage(session("user_id"), "Вы запросили " . Request::post("money_sum") . " руб. на выплату.");
                                $result = ['status' => "success"];
    							}else{
                                $result = ["status" => "error", "error" => "Минимальная сумма вывода 1000 рублей!"];                                
                                }
                            }
                            } else {
                                $result = ["status" => "error", "error" => "В личных настройках укажите реквизиты для выбранной системы!"];
                            }
                        } else {
                            $result = ["status" => "error", "error" => "На вашем балансе недостаточно денег!"];
                        }
                    } else {
                        $result = ["status" => "error", "error" => "Минимальная сумма для запроса выплаты 50 руб. Максимальная - 14 999 руб.!"];
                    }
                } else {
                    $result = ["status" => "error", "error" => "Выберите платежную систему для выплаты!"];
                }
            }else{
                    $result = ["status" => "error", "error" => "Новые пользователи не могут выводить средства первые 3 дня с момента регистраций!"];                
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
                $userInfo = file_get_contents("https://www.googleapis.com/youtube/v3/subscriptions?part=snippet&maxResults=1&myRecentSubscribers=true&access_token=".$tokenInfo['access_token']);
                //$userInfo = file_get_contents("https://www.googleapis.com/youtube/v3/channels?part=snippet&mine=true&access_token=".$tokenInfo['access_token']);
                //$userInfo = $this->getYouTubeChannelInfo($userInfo);
                dd($userInfo);
                if(!($user = $this->UserModel->getUser($userInfo['id'], "user_youtube"))) {
                    $data = [
                        "user_login" 	            =>	"youtube_" . $userInfo['id'],
                        "user_login_show"           =>	$userInfo['login'],
                        'user_email'                =>  $userInfo['email'],
                        "user_domain"               =>  "youtube_" . $userInfo['id'],
                        "user_avatar"	            =>	(!empty($userInfo['avatar'])) ? $userInfo['avatar'] : "/assets/images/no_avatar.png",
                        "user_youtube"	            =>	$userInfo['id'],
                        "user_reg_ip"	            =>  $_SERVER["REMOTE_ADDR"],
                        "user_youtube_token"        =>  $tokenInfo['access_token'],
                        "user_youtube_subs"         =>  $userInfo['subs'],
                        "user_donate_page"          =>  "{\"min_sum\":\"1\",\"rec_sum\":\"50\",\"text\":\"\",\"fuck_filter\":\"0\",\"fuck_name_filter\":\"0\",\"fuck_words\":\"\",\"bg_color\":\"#e0e0e0\",\"bg_type\":\"1\",\"bg_size\":\"auto\",\"bg_image\":\"\",\"bg_image_name\":\"\",\"bg_repeat\":\"no-repeat\",\"bg_position\":\"center\",\"bg_header_type\":\"1\",\"bg_header_image\":\"\",\"bg_header_size\":\"auto\",\"bg_header_repeat\":\"no-repeat\",\"bg_header_position\":\"center\",\"bg_header_color\":\"#f2f2f2\",\"text_header_color\":\"#000000\",\"btn_color\":\"#ff5400\",\"btn_text_color\":\"#ffffff\"}",
                        "user_reg_time" => "NOW()",
                    ];
                    $id = $this->UserModel->addUser($data);
                    $this->UserModel->trackIP($id, 1);
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
		model("User");
        if(empty(Request::get("code"))) {

            $url = 'https://id.twitch.tv/oauth2/authorize';

            $params = array(
                'client_id'     => config()->twitch['client_id'],
                'redirect_uri'  => config()->twitch['redirect_uri'],
                'response_type' => 'code',
                'force_verify'  => 'true',
                'scope'         => 'user%3Aread%3Aemail+channel_subscriptions+user_subscriptions+user_read+bits%3Aread+channel%3Aread%3Aredemptions+chat%3Aread'
            );

            redirect($url . '?' . urldecode(http_build_query($params)));
        } else {
            $result = false;

            $ch = curl_init('https://id.twitch.tv/oauth2/token');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, array(
                'client_id' => config()->twitch['client_id'],
                'client_secret' => config()->twitch['client_secret'],
                'code' => Request::get('code'),
                'grant_type' => 'authorization_code',
                'redirect_uri' => config()->twitch['redirect_uri']
            ));

            // fetch the data
            $r = curl_exec($ch);
            // get the information about the result
            $i = curl_getinfo($ch);
            // close the request
            curl_close($ch);

            $token = json_decode($r);

            $ch1 = curl_init('https://id.twitch.tv/oauth2/validate');
            curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch1, CURLOPT_HTTPHEADER, array(
                'Authorization: OAuth ' . $token->access_token
            ));

            $r1 = curl_exec($ch1);
            $i1 = curl_getinfo($ch1);

            curl_close($ch1);
            $validation = json_decode($r1);
            $ch2 = curl_init('https://api.twitch.tv/helix/users');
            curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch2, CURLOPT_HTTPHEADER, array(
                'Client-ID: ' . config()->twitch['client_id'],
                'Authorization: Bearer ' . $token->access_token
            ));

            $r2 = curl_exec($ch2);
            $i2 = curl_getinfo($ch2);

            curl_close($ch2);
            $userInfo = json_decode($r2);

            $ch3 = curl_init('https://api.twitch.tv/helix/users/follows?to_id='.$userInfo->data[0]->id);
            curl_setopt($ch3, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch3, CURLOPT_HTTPHEADER, array(
                'Client-ID: ' .config()->twitch['client_id'],
                'Authorization: Bearer '.$token->access_token
            ));

            $r3 = curl_exec($ch3);
            $i3 = curl_getinfo($ch3);

            curl_close($ch3);
            $userInfoFollows = json_decode($r3);

            if (!($user = $this->UserModel->getUser($userInfo->data[0]->id, "user_twitch_id"))) {
                $data = [
                    "user_login"            => "twitch_" . $userInfo->data[0]->login,
                    "user_login_show"       => $userInfo->data[0]->display_name,
                    "user_domain"           => "twitch_" . $userInfo->data[0]->display_name,
                    "user_avatar"           => (!empty($userInfo->data[0]->profile_image_url)) ? $userInfo->data[0]->profile_image_url : "/assets/images/no_avatar.png",
                    "user_twitch"           => $userInfo->data[0]->display_name,
                    "user_reg_ip"           => $_SERVER["REMOTE_ADDR"],
                    "user_twitch_token"     => $token->access_token,
                    "user_twitch_follows"   => $userInfoFollows->total,
                    "user_twitch_id"        => $userInfo->data[0]->id,
                    "user_donate_page"      => "{\"min_sum\":\"1\",\"rec_sum\":\"50\",\"text\":\"\",\"fuck_filter\":\"0\",\"fuck_name_filter\":\"0\",\"fuck_words\":\"\",\"bg_color\":\"#e0e0e0\",\"bg_type\":\"1\",\"bg_size\":\"auto\",\"bg_image\":\"\",\"bg_image_name\":\"\",\"bg_repeat\":\"no-repeat\",\"bg_position\":\"center\",\"bg_header_type\":\"1\",\"bg_header_image\":\"\",\"bg_header_size\":\"auto\",\"bg_header_repeat\":\"no-repeat\",\"bg_header_position\":\"center\",\"bg_header_color\":\"#f2f2f2\",\"text_header_color\":\"#000000\",\"btn_color\":\"#ff5400\",\"btn_text_color\":\"#ffffff\"}",
                    "user_reg_time"         => "NOW()",
                ];
                $id = $this->UserModel->addUser($data);
                //$this->getUserSmiles("twitch", $id, "twitch_" . $userInfo->name);
                $this->UserModel->trackIP($id, 1);
                $this->createDefaultWidgets($id);
                $this->ToOnline($id);
            }

            $this->UserModel->editUser($user['user_id'], ['user_twitch_token' => $token->access_token, 'user_login' => 'twitch_' . $userInfo->data[0]->login,
                'user_login_show' => $userInfo->data[0]->display_name, 'user_twitch' => $userInfo->data[0]->display_name, 'user_avatar' => $userInfo->data[0]->profile_image_url,
                'user_twitch_follows' => $userInfoFollows->total]);
            return $this->ToOnline($user['user_id']);
        }
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
        		"user_reg_ip"	=>		$_SERVER["REMOTE_ADDR"],
                "user_donate_page"      =>  "{\"min_sum\":\"1\",\"rec_sum\":\"50\",\"text\":\"\",\"fuck_filter\":\"0\",\"fuck_name_filter\":\"0\",\"fuck_words\":\"\",\"bg_color\":\"#e0e0e0\",\"bg_type\":\"1\",\"bg_size\":\"auto\",\"bg_image\":\"\",\"bg_image_name\":\"\",\"bg_repeat\":\"no-repeat\",\"bg_position\":\"center\",\"bg_header_type\":\"1\",\"bg_header_image\":\"\",\"bg_header_size\":\"auto\",\"bg_header_repeat\":\"no-repeat\",\"bg_header_position\":\"center\",\"bg_header_color\":\"#f2f2f2\",\"text_header_color\":\"#000000\",\"btn_color\":\"#ff5400\",\"btn_text_color\":\"#ffffff\"}",
                "user_reg_time" => "NOW()",
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
				//dd($userInfo);
		        if (isset($userInfo['response'][0]['id'])) {
		            $userInfo = $userInfo['response'][0];
		            if(!($user = $this->UserModel->getUser($userInfo['id'], "user_vk")))
		            {
		            	$data = [
		            		"user_login" 	  =>		"vkid".$userInfo["id"],
                            "user_login_show" =>     $userInfo['first_name']. " " . $userInfo['last_name'],
                            "user_domain"   =>      "vkid".$userInfo["id"],
		            		//"user_avatar"	=>		"/assets/images/no_avatar.png",
		            		"user_avatar"	    =>		(!empty($userInfo["photo_big"])) ? $userInfo["photo_big"] : "/assets/images/no_avatar.png",
		            		"user_vk"		=>		$userInfo['id'],
		            		"user_reg_ip"	=>		$_SERVER["REMOTE_ADDR"],
                            "user_donate_page"          =>  "{\"min_sum\":\"1\",\"rec_sum\":\"50\",\"text\":\"\",\"fuck_filter\":\"0\",\"fuck_name_filter\":\"0\",\"fuck_words\":\"\",\"bg_color\":\"#e0e0e0\",\"bg_type\":\"1\",\"bg_size\":\"auto\",\"bg_image\":\"\",\"bg_image_name\":\"\",\"bg_repeat\":\"no-repeat\",\"bg_position\":\"center\",\"bg_header_type\":\"1\",\"bg_header_image\":\"\",\"bg_header_size\":\"auto\",\"bg_header_repeat\":\"no-repeat\",\"bg_header_position\":\"center\",\"bg_header_color\":\"#f2f2f2\",\"text_header_color\":\"#000000\",\"btn_color\":\"#ff5400\",\"btn_text_color\":\"#ffffff\"}",
                            "user_reg_time" => "NOW()",
		            	];
		            	$id = Builder::table('users')->insert($data);
		            	$this->UserModel->trackIP($id, 1);
                        $this->createDefaultWidgets($id);
		            	$this->ToOnline($id);
		            }else {
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

    public function connect($type) {

        switch($type)
        {
            case "twitch":
                $this->ConnectTwitch();
                break;
            case "vk":
                $this->ConnectVk();
                break;

            default:
                abort(404);
                break;
        }
    }

    private function ConnectVk()
    {
        model("User");
        if (isset($this->request->get["code"])) {
            $token = $this->VKGetConnectToken($this->request->get["code"]);
            if (isset($token['access_token'])) {
                $userInfo = $this->VKGetUserInfo($token);
                //dd($userInfo);
                if (isset($userInfo['response'][0]['id'])) {
                    $userInfo = $userInfo['response'][0];
                    if(!($user = $this->UserModel->getUser($userInfo['id'], "user_vk"))) {
                        $this->UserModel->editUser(session("user_id"), ['user_vk' => $userInfo['id']]);
                        header('Location: '.config()->url.'/profile/');
                    }else {
                        header('Location: '.config()->url.'/profile/');
                    }

                }
            }
        }else{
            $this->VKRedirectToConnect();
        }

    }

    private function ConnectTwitch()
    {
        model("User");
        if(empty(Request::get("code"))) {

            $url = 'https://id.twitch.tv/oauth2/authorize';

            $params = array(
                'client_id'     => config()->twitch['client_id'],
                'redirect_uri'  => config()->twitch['connect_uri'],
                'response_type' => 'code',
                'force_verify'  => 'true',
                'scope'         => 'user%3Aread%3Aemail+channel_subscriptions+user_subscriptions+user_read+bits%3Aread+channel%3Aread%3Aredemptions+chat%3Aread'
            );

            redirect($url . '?' . urldecode(http_build_query($params)));
        } else {
            $result = false;

            $ch = curl_init('https://id.twitch.tv/oauth2/token');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, array(
                'client_id' => config()->twitch['client_id'],
                'client_secret' => config()->twitch['client_secret'],
                'code' => Request::get('code'),
                'grant_type' => 'authorization_code',
                'redirect_uri' => config()->twitch['connect_uri']
            ));

            // fetch the data
            $r = curl_exec($ch);
            // get the information about the result
            $i = curl_getinfo($ch);
            // close the request
            curl_close($ch);

            $token = json_decode($r);

            $ch1 = curl_init('https://id.twitch.tv/oauth2/validate');
            curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch1, CURLOPT_HTTPHEADER, array(
                'Authorization: OAuth ' . $token->access_token
            ));

            $r1 = curl_exec($ch1);
            $i1 = curl_getinfo($ch1);

            curl_close($ch1);
            $validation = json_decode($r1);
            $ch2 = curl_init('https://api.twitch.tv/helix/users');
            curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch2, CURLOPT_HTTPHEADER, array(
                'Client-ID: ' . config()->twitch['client_id'],
                'Authorization: Bearer ' . $token->access_token
            ));

            $r2 = curl_exec($ch2);
            $i2 = curl_getinfo($ch2);

            curl_close($ch2);
            $userInfo = json_decode($r2);

            $ch3 = curl_init('https://api.twitch.tv/helix/users/follows?to_id=' . $userInfo->data[0]->id);
            curl_setopt($ch3, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch3, CURLOPT_HTTPHEADER, array(
                'Client-ID: ' . config()->twitch['client_id'],
                'Authorization: Bearer ' . $token->access_token
            ));

            $r3 = curl_exec($ch3);
            $i3 = curl_getinfo($ch3);

            curl_close($ch3);
            $userInfoFollows = json_decode($r3);

            if (!($user = $this->UserModel->getUser($userInfo->data[0]->id, "user_twitch_id"))) {
                $this->UserModel->editUser(session("user_id"), ["user_twitch_id" => $userInfo->data[0]->id, 'user_twitch_token' => $token->access_token, 'user_twitch' => $userInfo->data[0]->display_name,
                    'user_twitch_follows' => $userInfoFollows->total]);
            }else {
                header('Location: '.config()->url.'/profile/');
            }
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
    private function VKRedirectToConnect()
    {
        $url = 'http://oauth.vk.com/authorize';
        $params = array(
            'client_id'     => config()->vk["client_id"],
            'redirect_uri'  => config()->vk["connect_uri"],
            'response_type' => 'code'
        );
        redirect($url.'?'.urldecode(http_build_query($params)));
    }

    private function VKGetConnectToken($code)
    {
        $params = [
            'client_id'     => config()->vk["client_id"],
            'client_secret' => config()->vk["client_secret"],
            'code' => $code,
            'redirect_uri'  => config()->vk["connect_uri"],
        ];
        return json_decode($this->get_curl('https://oauth.vk.com/access_token' . '?' . urldecode(http_build_query($params))), true);
    }

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
            'fields'       => 'uid,first_name,last_name,photo',
            'access_token' => $token['access_token'],
			'v'            => '5.103'
        ];
    	return $userInfo = json_decode($this->get_curl('https://api.vk.com/method/users.get' . '?' . urldecode(http_build_query($params))), true);
	}

	/*EndVKAuth*/

	/* YouTube */
	private function getYouTubeChannelInfo($result)
    {
        return [
            "id" => $result['items'][0]['id'],
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

            $channels = json_decode($this->get_curl("https://twitchemotes.com/api_cache/v3/global.json"));
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
        $user_domain = explode(".", $settingsR['user_domain']);
        $settings['user_domain'] = $user_domain[0];
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


    public function Paypal()
    {

        if(!($user = isOnline()))
            abort(403);

        $data['user'] = $user;
        $data['paypal'] = json_decode($user->user_paypal);

        return view("user/paypal", $data);
    }

    public function PaypalPost()
    {
        if(!($user = isOnline()))
            abort(403);

        $paypalR = Request::post("paypal");

        $paypal = json_decode($user->paypal, true);
        $paypal['clientid'] = $paypalR['clientid'];
        $paypal['secret'] = $paypalR['secret'];
        $paypal['email'] = $paypalR['email'];
        $paypal['on'] = $paypalR['on'];
        $data['user_paypal'] = json_encode($paypal);
        
        if ($this->UserModel->editUser(session("user_id"), $data)) {
            $result = ["status" => "success"];
        }

        return json_encode($result);
    }    
}