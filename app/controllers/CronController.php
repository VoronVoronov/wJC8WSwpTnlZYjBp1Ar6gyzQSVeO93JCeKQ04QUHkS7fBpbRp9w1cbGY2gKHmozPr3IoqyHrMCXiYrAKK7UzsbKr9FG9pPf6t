<?php

/**
 * Created by PhpStorm.
 * User: Максим
 * Date: 10.03.2017
 * Time: 17:55
 */
class CronController extends Controller
{
    public function updateStreamStatus()
    {
        model("User");

        foreach((object) $this->UserModel->getUsers() as $user)
        {

            if(!empty($user->user_youtube)){
                $url = 'https://www.googleapis.com/youtube/v3/liveBroadcasts?part=status&broadcastStatus=active';
                $headers = array('Authorization: Bearer ' . $user->user_youtube_token,
                    'Accept: application/json');
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, $url);
                curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($curl, CURLOPT_ENCODING, 'gzip');
                $result = curl_exec($curl);
                curl_close($curl);
                $obj = json_decode($result, true);
                if ($obj['items'][0]['status']['recordingStatus'] == "recording") {
                    $this->UserModel->editUser($user['user_id'], ["user_stream_status" => "1"]);
                } else {
                    $this->UserModel->editUser($user['user_id'], ["user_stream_status" => "1"]);;
                }
            }elseif(!empty($user->user_twitch)) {
                $url = 'https://api.twitch.tv/helix/streams?user_id=' . $user['user_id'];
                $headers = array('Authorization: Bearer ' . $user->user_twitch_token,
                    'Accept: application/json');
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, $url);
                curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($curl, CURLOPT_ENCODING, 'gzip');
                $result = curl_exec($curl);
                curl_close($curl);
                $obj = json_decode($result, true);
                if ($obj->data[0]->type == "live") {
                    $this->UserModel->editUser($user['user_id'], ["user_stream_status" => "1"]);
                } else {
                    $this->UserModel->editUser($user['user_id'], ["user_stream_status" => "1"]);
                }
            }


        }
    }


    public function updateTwitchFollows($params = [])
    {
        model("User", "Widget", "Alert", "Event");
        $params = Request::get("params");
        $user = $this->UserModel->getUser($params['user_id'], "user_id");
        $widgets = $this->WidgetModel->getUserAlertsWidget($user['user_id']);
        $event_json = array(
            'user_name' =>  $params['followername']
        );
        $event = json_encode($event_json);
        $this->EventModel->addEvent([
            "user_id"       => $donation['user_id'],
            "event_type"    => 2,
            "event_json"    => $event,
            "event_time"    => "NOW()",
        ], true);
        foreach ($widgets as $widget)
        {
            $this->AlertModel->newAlert([
                "user_id"   => $user['user_id'],
                "widget_id" => $widget['widget_id'],
                "msg"       => 'Подписался',
                "user_name" => $params['followername'],
                //"sum"       => '0',
                //"curr"      => 'RUB',
                "type"      => 1,
            ], true);
        }

    }

    public function updateTwitchSubscribe($params = [])
    {
        model("User", "Widget", "Alert", "Event");
        $params = Request::get("params");
        $user = $this->UserModel->getUser($params['user_id'], "user_id");
        $widgets = $this->WidgetModel->getUserAlertsWidget($user['user_id']);
        $event_json = array(
            'user_name' =>  $params['followername']
        );
        $event = json_encode($event_json);
        $this->EventModel->addEvent([
            "user_id"       => $donation['user_id'],
            "event_type"    => 2,
            "event_json"    => $event,
            "event_time"    => "NOW()",
        ], true);
        foreach ($widgets as $widget)
        {
            $this->AlertModel->newAlert([
                "user_id"   => $user['user_id'],
                "widget_id" => $widget['widget_id'],
                "msg"       => 'Подписался',
                "user_name" => $params['followername'],
                //"sum"       => '0',
                //"curr"      => 'RUB',
                "type"      => 2,
            ], true);
        }

    }

    private function updateHitboxFollows($user)
    {
        $userInfo = json_decode($this->get_curl("https://api.hitbox.tv/user/".$user['user_hitbox']));
        if($userInfo->followers != $user['user_hitbox_follows']) {

            $followers = json_decode($this->get_curl("https://api.hitbox.tv/followers/user/".$user['user_hitbox']));

            foreach ($followers->followers as $follower)
            {
                echo "[UID: ".$user['user_id']."][HitBox] New Follower: ".$follower->user_name."<br>";

                $widgets = $this->WidgetModel->getUserAlertsWidget($user['user_id']);
                foreach ($widgets as $widget)
                {
                    $this->AlertModel->newAlert([
                        "widget_id" => $widget['widget_id'],
                        "msg" => null,
                        "user_name" => $follower->user_name,
                        "sum" => null,
                        "curr" => null,
                        "type" => 1,
                    ], true);
                }
            }

            $this->UserModel->editUser($user['user_id'], ["user_hitbox_follows" => $userInfo->followers]);
        }
    }

    private function updateHitboxSubs($user)
    {

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
}