<?php

class WidgetModel extends Model
{
    public $table = "widgets";
    private $types = [
        "alerts" => 1,
        "goals" => 2,
        "stats" => 3,
        "votes" => 4,
        "event" => 5,
    ];

    public function newWidget($name, $type, $user_id = null)
    {
        $default_config = $this->getDefaultConfig($type);
        return $this->create([
            'widget_name' => $name,
            "widget_type" => $type,
            "widget_config" => $default_config,
            "user_id"   => ($user_id !== null) ? $user_id : session("user_id"),
            "widget_status" =>  1,
            "widget_time"   =>  "NOW()",
            "widget_token"  =>  md5(time().config()->app_key.$name.$type.$user_id),
        ]);
    }

    public function deleteWidget($id)
    {
        return $this->where("widget_id", (int) $id)->delete();
    }

    public function getWidgets($user_id = null, $type = null)
    {
        if($type === null)
            return $this->where("user_id", $user_id)->get();

        return $this->where("user_id", $user_id)->where("widget_type", $this->types[$type])->get();
    }

    public function getWidgetWithId($id)
    {
        return $this->where("widget_id", $id)->firstOrError();
    }

    public function getWidgetWithToken($token)
    {
        return $this->where("widget_token", $token)->first();
    }

    public function getWidget($value, $row = "widget_id")
    {
        return $this->where($row, $value)->first();
    }

    public function getEventWidget($user_id)
    {
        return $this->where("widget_type", 5)->where("user_id", $user_id)->firstOrError();
    }

    public function getUserAlertsWidget($user_id)
    {
        return $this->select("widget_token, widget_id")->where("widget_type", 1)->where("user_id", $user_id)->get();
    }

    public function getWidgetMoney($id)
    {
        return $this->where("widget_id", $id)->value("widget_money");
    }

    public function editWidget($id, $data = []){
        return $this->set($data)->where("widget_id", $id)->update();
    }

    private function getDefaultConfig($type)
    {
        switch ($type) {
            case "1":
                return "{\"background\":\"#00ff00\",\"alert_time\":\"8\",\"next_alert_time\":\"10\",\"follower\":{\"status\":\"1\",\"layout\":\"1\",\"image\":\"/assets/files/1486749146.gif\",\"image_name\":\"cGVuZ2l1bi5naWY=\",\"audio\":\"/assets/files/audio/1486755309.ogg\",\"audio_name\":\"Ym9udXMtMi5vZ2c=\",\"message_layout\":\"Om5hbWUg0L/QvtC00L/QuNGB0LDQu9GB0Y8h\",\"font_family\":\"Roboto Condensed\",\"font_size\":\"66\",\"color\":\"#32c3a6\",\"weight\":\"true\",\"transformation\":\"none\",\"shadow_size\":\"0\",\"shadow_color\":\"#000000\",\"animation\":\"none\",\"animation_object\":\"animated-letter\",\"aling\":\"center\"},\"subscribe\":{\"status\":\"1\",\"layout\":\"2\",\"image\":\"/assets/files/1486749131.gif\",\"image_name\":\"em9tYmllLmdpZg==\",\"audio\":\"/assets/files/audio/1486751205.mp3\",\"audio_name\":\"cG9pbnQubXAz\",\"message_layout\":\"Om5hbWUg0L/QvtC00L/QuNGB0LDQu9GB0Y8=\",\"font_family\":\"Open Sans\",\"font_size\":\"40\",\"color\":\"#32c3a6\",\"weight\":\"true\",\"transformation\":\"none\",\"shadow_size\":\"0\",\"shadow_color\":\"#000000\",\"animation\":\"bounce\",\"animation_object\":\"animated-letter\",\"aling\":\"center\"},\"donation\":{\"status\":\"1\",\"layout\":\"3\",\"image\":\"/assets/files/1486754931.gif\",\"image_name\":\"Mk9CNDNkay5naWY=\",\"audio\":\"/assets/files/audio/1486760124.ogg\",\"audio_name\":\"bWFnaWMtY29pbnMub2dn\",\"min_sum\":\"0\",\"message_layout\":\"Om5hbWUg0L/RgNC40YHQu9Cw0LsgOmFtbW91bnQ=\",\"message\":{\"status\":\"1\",\"font_family\":\"Open Sans\",\"font_size\":\"45\",\"color\":\"#ffffff\",\"weight\":\"true\",\"transformation\":\"none\",\"shadow_size\":\"1\",\"shadow_color\":\"#000000\",\"animation\":\"none\",\"animation_object\":\"animated-letter\",\"aling\":\"center\"},\"title\":{\"font_family\":\"Open Sans\",\"font_size\":\"57\",\"color\":\"#32c3a6\",\"weight\":\"true\",\"transformation\":\"none\",\"shadow_size\":\"2\",\"shadow_color\":\"#000000\",\"animation\":\"swing\",\"animation_object\":\"animated-letter\",\"aling\":\"center\"}},\"goal_title\":\"\"}";
                break;

            case "2":
                return "{\"goal_title\":\"0KbQtdC70Ywg0YHQsdC+0YDQsA==\",\"goal_sum_end\":\"1000\",\"goal_sum_start\":\"0\",\"goal_time_end\":\"01.01.2020\",\"background\":\"#00ff00\",\"bar_color\":\"#46e65a\",\"bar_color_bg\":\"#dddddd\",\"bar_size\":\"48\",\"goal\":{\"sum\":{\"font_family\":\"Open Sans\",\"font_size\":\"21\",\"color\":\"#ffffff\",\"weight\":\"true\",\"transformation\":\"none\",\"shadow_size\":\"1\",\"shadow_color\":\"#000000\"},\"title\":{\"font_family\":\"Open Sans\",\"font_size\":\"27\",\"color\":\"#ffffff\",\"weight\":\"true\",\"transformation\":\"none\",\"shadow_size\":\"1\",\"shadow_color\":\"#000000\"}},\"follower\":{\"message_layout\":\"\",\"image_name\":\"\",\"audio_name\":\"\"},\"subscribe\":{\"message_layout\":\"\",\"image_name\":\"\",\"audio_name\":\"\"},\"donation\":{\"message_layout\":\"\",\"image_name\":\"\",\"audio_name\":\"\"},\"stats_layout\":\"\",\"title\":\"\"}";
                break;

            case "3":
                return "{\"stats_layout\":\"Om5hbWUgLSAgOmFtbW91bnQ=\",\"stats_type\":\"4\",\"stats_time\":\"4\",\"stats_view_type\":\"1\",\"stats_elements\":\"100\",\"stats\":{\"text\":{\"font_family\":\"Open Sans\",\"font_size\":\"50\",\"color\":\"#ff2626\",\"weight\":\"true\",\"transformation\":\"none\",\"shadow_size\":\"1\",\"shadow_color\":\"#000000\",\"aling\":\"center\"}},\"follower\":{\"message_layout\":\"\",\"image_name\":\"\",\"audio_name\":\"\"},\"subscribe\":{\"message_layout\":\"\",\"image_name\":\"\",\"audio_name\":\"\"},\"donation\":{\"message_layout\":\"\",\"image_name\":\"\",\"audio_name\":\"\"},\"goal_title\":\"\",\"title\":\"\"}";
                break;

            case "4":
                return "{\"status\":\"0\",\"title\":\"0J3QsNC30LLQsNC90LjQtSDQs9C+0LvQvtGB0L7QstCw0L3QuNGP\",\"type\":\"1\",\"time\":\"6\",\"time_show\":\"5\",\"variants\":[\"0JLQsNGA0LjQsNC90YIgMQ==\",\"0JLQsNGA0LjQsNC90YIgMg==\"],\"background\":\"#00ff00\",\"bar_color\":\"#b81818\",\"bar_color_bg\":\"#dddddd\",\"bar_size\":\"40\",\"style\":{\"title\":{\"font_family\":\"Open Sans\",\"font_size\":\"36\",\"color\":\"#ffffff\",\"weight\":\"true\",\"transformation\":\"none\",\"shadow_size\":\"2\",\"shadow_color\":\"#000000\"},\"variant\":{\"font_family\":\"Open Sans\",\"font_size\":\"22\",\"color\":\"#ffffff\",\"weight\":\"true\",\"transformation\":\"none\",\"shadow_size\":\"2\",\"shadow_color\":\"#000000\"}},\"follower\":{\"message_layout\":\"\",\"image_name\":\"\",\"audio_name\":\"\"},\"subscribe\":{\"message_layout\":\"\",\"image_name\":\"\",\"audio_name\":\"\"},\"donation\":{\"message_layout\":\"\",\"image_name\":\"\",\"audio_name\":\"\"},\"goal_title\":\"\",\"stats_layout\":\"\"}";
                break;
        }
    }
}