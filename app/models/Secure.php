<?php

class SecureModel extends Model
{
    public $table = "secure_actions";

    //Типы:
    // 1 - Смена почты

    public function addAction($user_id, $type, $json)
    {
        return $this->create([
            "user_id" => $user_id,
            "action_json" => $json,
            "action_type" => $type,
            "action_code" => md5(time().config()->app_key)
        ]);
    }
}