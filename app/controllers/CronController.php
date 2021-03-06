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

            if(empty($user->user_youtube)){

            }else{
                $url = 'https://www.googleapis.com/youtube/v3/liveBroadcasts?part=status&broadcastStatus=active';

                $headers = array('Authorization: Bearer '.$user['user_youtube_token'],
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

                if($obj['items'][0]['status']['recordingStatus'] == "recording"){
                    $this->UserModel->editUser($user['user_id'], ["user_stream_status" => "1"]);
                }else{
                    $this->UserModel->editUser($user['user_id'], ["user_stream_status" => "0"]);                
            }
            }


        }
    }

    public function updateSubs() { //Доработать для всех юзеров
        library("TwitchSDK");
        model("User", "Alert", "Widget");

        $twitch = new TwitchSDK(config()->twitch);

        foreach ($this->UserModel->getUsers() as $user)
        {
            if(!empty($user['user_twitch']))
            {
                //dd($user);
                $follows = $this->updateTwitchFollows($twitch, $user);
                dd($follows);
                $this->updateTwitchSubs($twitch, $user);
            }

            if(!empty($user['user_hitbox']))
            {
                $this->updateHitboxFollows($user);
                $this->updateHitboxSubs($user);
            }
        }
    }

    private function updateTwitchFollows(TwitchSDK $twitch, $user)
    {
        $followers = $twitch->channelFollows($user['user_twitch']);
        if($followers->_total > $user['user_twitch_follows']){
            $limit = $followers->_total - $user['user_twitch_follows'];

            if($limit != 0) {
                for($i = 0; $i < $limit; $i++) {
                    echo "[UID: ".$user['user_id']."][Twitch] New Follower: ".$followers->follows[$i]->user->name."<br>";

                    $widgets = $this->WidgetModel->getUserAlertsWidget($user['user_id']);
                    foreach ($widgets as $widget)
                    {
                        $this->AlertModel->newAlert([
                            "widget_id" =>  $widget['widget_id'],
                            "msg" => null,
                            "user_name" => $followers->follows[$i]->user->name,
                            "sum" => null,
                            "curr" => null,
                            "type" => 1,
                        ], true);
                    }
                }
            }

            $this->UserModel->editUser($user['user_id'], ["user_twitch_follows" => $followers->_total]);
        } else {
            if($user['user_twitch_follows'] != $followers->_total) {
                $this->UserModel->editUser($user['user_id'], ["user_twitch_follows" => $followers->_total]);
            }
        }
    }

    private function updateTwitchSubs(TwitchSDK $twitch, $user)
    {
        $subscribers = $twitch->authChannelSubscriptions($user['user_twitch_token'], $user['user_twitch']);
        if($subscribers->_total > $user['user_twitch_subs']){
            $limit = $subscribers->_total - $user['user_twitch_subs'];

            if($limit != 0) {
                for($i = 0; $i < $limit; $i++) {
                    echo "[UID: ".$user['user_id']."][Twitch] New Subscriber: ".$subscribers->follows[$i]->user->name."<br>";

                    $widgets = $this->WidgetModel->getUserAlertsWidget($user['user_id']);
                    foreach ($widgets as $widget)
                    {
                        $this->AlertModel->newAlert([
                            "widget_id" =>  $widget['widget_id'],
                            "msg" => null,
                            "user_name" => $subscribers->follows[$i]->user->name,
                            "sum" => null,
                            "curr" => null,
                            "type" => 2,
                        ], true);
                    }
                }
            }

            $this->UserModel->editUser($user['user_id'], ["user_twitch_subs" => $subscribers->_total]);
        } else {
            if($user['user_twitch_subs'] != $subscribers->_total) {
                $this->UserModel->editUser($user['user_id'], ["user_twitch_subs" => $subscribers->_total]);
            }
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