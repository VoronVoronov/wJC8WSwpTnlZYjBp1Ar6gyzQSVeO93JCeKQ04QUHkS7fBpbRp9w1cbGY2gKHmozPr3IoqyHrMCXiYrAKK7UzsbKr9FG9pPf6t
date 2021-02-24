<?php

class MessageModel extends Model
{
    public $table = "messages";

    public function addMessage($user_id, $text)
    {
        return $this->create([
            "user_id" => $user_id,
            "message_text" => $text,
            "message_time" => "NOW()",
        ]);
    }

    public function getUserMessages($user_id, $options = [])
    {
        return $this->where("user_id", $user_id)
            ->select(DB::raw("*"))
            ->order("message_time", "desc")
            ->limit($options['start'], $options['limit'])
            ->get();
    }

    public function getCountUserMessages($user_id)
    {
        return $this->where("user_id", $user_id)->count();
    }
}