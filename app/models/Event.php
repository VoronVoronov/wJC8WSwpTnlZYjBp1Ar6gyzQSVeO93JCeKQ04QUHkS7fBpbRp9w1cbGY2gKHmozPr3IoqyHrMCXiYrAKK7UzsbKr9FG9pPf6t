<?php

class EventModel extends Model
{
    public $table = "events";

    public function addEvent($data = [])
    {
        return $this->create($data);
    }

    public function getUserEvents($user_id)
    {
        $events = $this->where("user_id", $user_id)->order("event_id", "desc")->get();

        foreach ($events as &$event) {
            $event['event_json'] = json_decode($event['event_json']);
            switch ($event['event_type']) {
                case 1: //Донат
                    $event['action'] = "Донат на сумму ". $event['event_json']->sum . " ". getCurrency($event['event_json']->curr);
                    break;
                case 2: //Подписка (НЕ платно)
                    $event['action'] = "Подписался";
                    break;
                case 3: //Подписка (Платно)
                    $event['action'] = "Платная подписка";
                    break;
            }
        }

        return $events;
    }

    public function getAllUserEvents()
    {
        $events = $this->order("event_id", "desc")->get();

        foreach ($events as &$event) {
            $event['event_json'] = json_decode($event['event_json']);
            switch ($event['event_type']) {
                case 1: //Донат
                    $event['action'] = "Донат на сумму ". $event['event_json']->sum . " ". getCurrency($event['event_json']->curr);
                    break;
                case 2: //Подписка (НЕ платно)
                    $event['action'] = "Подписался";
                    break;
                case 3: //Подписка (Платно)
                    $event['action'] = "Платная подписка";
                    break;
            }
        }

        return $events;
    }
}