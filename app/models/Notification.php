<?php

class NotificationModel extends Model
{
    public $table = "notifications";

    public function SendNotification($data)
    {
    	$this->insert($data);
    }

    public function getNotifications($id)
    {
    	return $this->where('not_showed', '>=', 1);
    }
}