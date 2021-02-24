<?php

class FaqModel extends Model
{
    public $table = "faq";
    public $status = "1";
    public function getFaq($options = [])
    {
        return $this->where("faq_status", $status)
            ->select(DB::raw("*"))
            ->order("faq_id", "ASC")
            ->limit($options['start'], $options['limit'])
            ->get();
    }

    public function getCountFaq($user_id)
    {
        return $this->where("faq_status", $status)->count();
    }
}