<?php
/*
* MyUCP
*/

class WidgetController extends Controller {

	// Types
	// 1 - Alerts (Follower, Subs, Donate)
    // 2 - Goal
    // 3 - Stats
    // 4 - Vote
    // 5 - Event List

    public function myWidgets($type = null)
    {
        model("Widget");

        if($user = isOnline()) {

            //if($type === null)
                //redirect(route("home"));

            $data['widgets'] = $this->WidgetModel->getWidgets($user->user_id, $type);
            $data["type"] = $type;

            return view("widgets/my", $data);
        }

        return abort(403);
    }

    public function addWidget()
    {
        if(!isOnline())
            return abort(403);

        return view("widgets/add");
    }

    public function addWidgetPost()
    {
        if(!isOnline())
            return abort(403);

        model("Widget");

        if(!empty(Request::post('widget_name')) && !empty(Request::post('widget_type'))) {
            $id = $this->WidgetModel->newWidget(Request::post('widget_name'), Request::post('widget_type'));
            redirect("/widgets/edit/". $id);
        } else {
            $data['error'] = "Все поля обязательны к заполнению!";
        }

        return view("widgets/add", $data);
    }

    public function removeWidget()
    {
        if(!isOnline())
            return abort(403);

        model("Widget");

        $id = Request::get("id");

        $widget = $this->WidgetModel->getWidgetWithId((int) $id);

        if($widget['user_id'] != session("user_id"))
            return abort(403);

        if($this->WidgetModel->deleteWidget((int) $id)) {
            $result = ["status" => "success"];
        } else {
            $result = ["status" => "error", "error" => "При выполнении запроса произошла ошибка, повторите попытку позже!"];
        }

        return json_encode($result);
    }

    public function editWidget($id)
    {
        model("Widget");
        if($user = isOnline()) {

            $data['widget'] = $this->WidgetModel->getWidget($id);
            $data['widget']['widget_config'] = json_decode($data['widget']['widget_config']);
            $data['user'] = $user;

            if($data['widget']['user_id'] != $user->user_id)
                return abort(403);

            if($data['widget']['widget_type'] == 1) {
                return view("widgets/edit/alert", $data);
            } elseif($data['widget']['widget_type'] == 2) {
                return view("widgets/edit/goal", $data);
            } elseif($data['widget']['widget_type'] == 3) {
                return view("widgets/edit/stats", $data);
            } elseif($data['widget']['widget_type'] == 4) {
                return view("widgets/edit/vote", $data);
            } elseif($data['widget']['widget_type'] == 5) {
                return view("widgets/edit/event", $data);
            }
        }

        return abort(403);
    }

    public function events()
    {
        model("Widget");
        if($user = isOnline()) {

            $data['widget'] = $this->WidgetModel->getEventWidget($user->user_id);
            $data['user'] = $user;

            if($data['widget']['user_id'] != $user->user_id)
                return abort(403);

            return view("widgets/edit/event", $data);
        }

        return abort(403);
    }

    public function editWidgetPost($id)
    {
        model("Widget");
        if($user = isOnline()) {
            $widget = $this->WidgetModel->getWidget($id);

            if($widget['user_id'] != $user->user_id)
                return abort(403);

            $data = Request::post('config');
            $data['follower']['message_layout'] = base64_encode($data['follower']['message_layout']);
            $data['subscribe']['message_layout'] = base64_encode($data['subscribe']['message_layout']);
            $data['donation']['message_layout'] = base64_encode($data['donation']['message_layout']);

            $data['follower']['image_name'] = base64_encode($data['follower']['image_name']);
            $data['follower']['audio_name'] = base64_encode($data['follower']['audio_name']);

            $data['subscribe']['image_name'] = base64_encode($data['subscribe']['image_name']);
            $data['subscribe']['audio_name'] = base64_encode($data['subscribe']['audio_name']);

            $data['donation']['image_name'] = base64_encode($data['donation']['image_name']);
            $data['donation']['audio_name'] = base64_encode($data['donation']['audio_name']);

            $data['goal_title'] = base64_encode($data['goal_title']);

            $data['stats_layout'] = base64_encode($data['stats_layout']);

            $data['title'] = base64_encode($data['title']);
            if(!empty($data['variants'])) {
                for($i = 0; $i < count($data['variants']); $i++) {
                    $data['variants'][$i] = base64_encode($data['variants'][$i]);
                }
            }

            $this->WidgetModel->editWidget($id, ["widget_config" => json_encode($data)]);
            $this->updateWidget($widget['widget_token']);
            redirect("/widgets/edit/" . $id);
        }

        return abort(403);
    }

	public function widget($token)
    {
        // Codes: (Только для алертов)
        // 0 - All
        // 1 - (1) Follower & (2) Subs
        // 2 - (1) Follower & (3) Donation
        // 3 - (2) Subs && (3) Donation
        // 4 - (1) Follower
        // 5 - (2) Subs
        // 6 - (3) Donation

        model("Widget", "Donation", "Smile");

        if($token != "events") {
            $data['widget'] = $this->WidgetModel->getWidgetWithToken($token);
        } else {
            $data['widget'] = $this->WidgetModel->getEventWidget(session("user_id"));
            $data['widgets'] = $this->WidgetModel->getUserAlertsWidget(session("user_id"));
        }

		$data['widget']['widget_config'] = json_decode($data['widget']['widget_config']);
        $data['code'] = (!empty(Request::get("code"))) ? Request::get("code") : "0";
        $data['bg'] = (!empty(Request::get("bg"))) ? true : false;

        if($data['widget']['widget_type'] == 1) {
            $data['smiles_twitch'] = $this->SmileModel->getUserSmilesTwitch($data['user']->user_id);
            $data['smiles_hitbox'] = $this->SmileModel->getUserSmilesHitbox($data['user']->user_id);

            return view("widgets/alert/alert", $data);
        } elseif($data['widget']['widget_type'] == 2) {
            return view("widgets/alert/goal", $data);
        } elseif($data['widget']['widget_type'] == 3) {
            return view("widgets/alert/stats", $data);
        } elseif($data['widget']['widget_type'] == 4) {
            return view("widgets/alert/vote", $data);
        } elseif($data['widget']['widget_type'] == 5) {
            return view("widgets/alert/event", $data);
        }
	}

	public function widgetDemo($token)
    {
        //Types:
        // 1 - Follower
        // 2 - Subscriber
        // 3 - Donation

 
        $currency = [
            "RUB",
            "USD",
            "UAH",
            "EUR",
            "BYN",
            "KZT",
        ];
        if(Request::get("type") == 3){
            $message = [
                'token' =>  $token,
                'alert_type'=>  Request::get("type"),
                'user_name' =>  Request::get("name"),
                'sum'   =>  (string) rand(1, 100),
                'msg'   =>  "Сообщение оповещение",
                'curr'  =>  $currency[rand(0, 5)],
                'alert_id'=>   "0",
            ];
        }else{
            $message = [
                'token' =>  $token,
                'alert_type'=>  Request::get("type"),
                'user_name' =>  Request::get("name"),
                //'sum'   =>  (string) rand(1, 100),
                //'msg'   =>  "Сообщение оповещение",
                //'curr'  =>  $currency[rand(0, 5)],
                'alert_id'=>   "0",
            ];
        }
        $message = json_encode($message);

        if(Request::get("type") == 3){
        $name = urlencode("Сообщение оповещение");
        @file_get_contents("https://api.ipdonate.com/voice.php?text=".$name);
                /*$url = 'https://translate.google.com.vn/translate_tts?ie=UTF-8&client=tw-ob&q='.urlencode($name).'&tl=ru';

                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, $url);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
                $result = curl_exec($curl);
                curl_close($curl);

                $file = base64_encode(urldecode($name));

                file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/assets/audio/'.$file.'.mp3', $result);*/
        }

        library("class.ClientWebSocket");
        $socket = new WebsocketClient;
        $socket->connect('ipdonate.com', 9400, "/");        
        usleep(5000);

        $socket->sendData($message);
        usleep(5000);
    }

	public function control()
    {
        model("Widget");

		$data['widgets'] = $this->WidgetModel->getWidgets();

		return view("widgets/control", $data);
	}

    public function controlPost()
    {
        model("Widget", "Alert");

        $data['widget_id'] = Request::post("widget_id");
        $data['user_name'] = Request::post("user_name");
        $data['sum'] = Request::post("sum");
        $data['curr'] = Request::post("curr");
        $data['msg'] = Request::post("msg");
        $data['type'] = "3";
        $data['audio'] = 
        $this->AlertModel->newAlert($data, true);

        return redirect("/control");
    }

	public function alertShowed($id)
    {
	    model("Alert");
	    return $this->AlertModel->editAlert($id, ["alert_status" => "1"]);
    }

    //
    public function getNotShowedAlerts($id, $token)
    {
        model("Alert");

        $alerts = $this->AlertModel->getNotShowedAlerts($id);

        $message = [];

        foreach ($alerts as $alert) {
            $message[] = [
                'id' => $id,
                'token' => $token,
                'user_name' => $alert['alert_name'],
                'sum' => $alert['alert_sum'],
                'msg' => $alert['alert_text'],
                'curr' => $alert['alert_curr'],
                'alert_type' =>  $alert['alert_type'],
                'alert_id' => $alert['alert_id'],
            ];
        }

        return json_encode($message);
    }

    public function getLastMessage($id, $token)
    {
        model("Donation", "Widget");

        $widget = $this->WidgetModel->getWidgetWithToken($token);
        $widget['widget_config'] = json_decode($widget['widget_config']);

        $list = $this->DonationModel->getLastDonations(
            $widget['user_id'],
            $widget['widget_config']->stats_time,
            $widget['widget_config']->stats_elements
        );

        $to_show = [];

        foreach ($list as $item) {
            $item['json'] = json_decode($item['donation_json']);

            $to_show[] = [
                'id' => $id,
                'token' => $token,
                'user_name' => $item['donation_name'],
                'sum' => $item['donation_ammount'],
                'msg' => $item['json']->message,
                'curr' => getCurrency($item['donation_currency']),
            ];
        }

        return json_encode($to_show);
    }

    public function getCostMessage($id, $token)
    {
        model("Donation", "Widget");

        $widget = $this->WidgetModel->getWidgetWithToken($token);
        $widget['widget_config'] = json_decode($widget['widget_config']);

        $list = $this->DonationModel->getCostDonations(
            $widget['user_id'],
            $widget['widget_config']->stats_time,
            $widget['widget_config']->stats_elements
        );

        $to_show = [];

        foreach ($list as $item) {
            $item['json'] = json_decode($item['donation_json']);

            $to_show[] = [
                'id' => $id,
                'token' => $token,
                'user_name' => $item['donation_name'],
                'sum' => $item['donation_ammount'],
                'msg' => $item['json']->message,
                'curr' => getCurrency($item['donation_currency']),
            ];
        }

        return json_encode($to_show);
    }

    public function getUserCostMessage($id, $token)
    {
        model("Donation", "Widget");

        $widget = $this->WidgetModel->getWidgetWithToken($token);
        $widget['widget_config'] = json_decode($widget['widget_config']);

        $list = $this->DonationModel->getUserCostDonations(
            $widget['user_id'],
            $widget['widget_config']->stats_time,
            $widget['widget_config']->stats_elements
        );

        $to_show = [];

        foreach ($list as $item) {
            $item['json'] = json_decode($item['donation_json']);

            $to_show[] = [
                'id' => $id,
                'token' => $token,
                'user_name' => $item['donation_name'],
                'sum' => $item['donation_ammount'],
                'msg' => $item['json']->message,
                'curr' => getCurrency($item['donation_currency']),
            ];
        }

        return json_encode($to_show);
    }

    public function getBalance($id, $token)
    {
        model("Donation", "Widget");

        $widget = $this->WidgetModel->getWidgetWithToken($token);
        $widget['widget_config'] = json_decode($widget['widget_config']);

        $list = $this->DonationModel->getBalance(
            $widget['user_id'],
            $widget['widget_config']->stats_time
        );

        foreach ($list as $item) {

            $to_show = [
                'id' => $id,
                'token' => $token,
                'sum' => $item['balance'],
                'curr' => getCurrency(0),
            ];
        }

        return json_encode($to_show);
    }

    public function getVoteVariants($id, $token)
    {
        model("Donation", "Widget");

        $data['widget'] = $this->WidgetModel->getWidgetWithToken($token);
        $data['widget']['widget_config'] = json_decode($data['widget']['widget_config']);

        $variants_ready = [];
        $variants_sum = 0;

        if(isset($data['widget']['widget_config']->variants)) {
            foreach ($data['widget']['widget_config']->variants as $key => $value) {
                $variants_ready[$key]['name'] = base64_decode($value);
                $variants_ready[$key]['balance'] = $this->DonationModel->getVotePercent($data['widget']['widget_id'], $key);
                $variants_sum += $variants_ready[$key]['balance'];
            }

            foreach ($variants_ready as $key => $value) {
                if($variants_ready[$key]['balance'] != 0) {
                    $variants_ready[$key]['percent'] = round(100 / ($variants_sum / $variants_ready[$key]['balance']), 2);
                } else {
                    $variants_ready[$key]['percent'] = 0;
                }
            }
        }

        return json_encode($variants_ready);
    }
    //

    public function stopShow() {
        $message = [
            'id' => Request::get("id"),
            'token' =>  Request::get("token"),
            'command' => "stop",
        ];
        $message = json_encode($message);

        library("class.ClientWebSocket");
        $socket = new WebsocketClient;
        $socket->connect('ipdonate.com', 9400, "/");        
		usleep(5000);

        $socket->sendData($message);
        usleep(5000);
    }

    public function updateWidget($widget_token) {
        $message = [
            'token' =>  $widget_token,
            'command' => "update",
        ];
        $message = json_encode($message);

        library("class.ClientWebSocket");
        $socket = new WebsocketClient;
        $socket->connect('ipdonate.com', 9400, "/");        
		usleep(5000);

        $socket->sendData($message);
        usleep(5000);
    }
}