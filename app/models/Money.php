<?php

class MoneyModel extends Model
{
    /*
     * Методы:
     * 1 - Qiwi
     * 2 - WM
     * 3 - Yandex
     * 4 - Bank
     */

    /*
     * Статусы:
     * 0 - Ожидает
     * 1 - Выплачено
     * 2 - Отменено
     */

    public $table = "money_back";

    public function addRequest($user_id, $sum, $back, $type, $wallet, $curr = 0)
    {
        return $this->create([
            "user_id" => $user_id,
            "money_sum" => (float)$sum,
            "money_back" => (float)$back,
            "money_method" => $type,
            "money_curr" => $curr,
            "money_wallet" => $wallet,
            "money_status" => 0,
            "money_time" => "NOW()"
        ]);
    }

    public function getAllPayOuts()
    {
        return $this->order("money_time", "desc")
            ->get();
    }

    public function getCountRequestsMoney($user_id)
    {
        return $this->where("user_id", $user_id)->count();
    }

    public function editMoney($id, $data = []) {
        return $this->where("money_id", $id)->set($data)->update();
    }

    public function getRequests($user_id, $options = [])
    {
        return $this->where("user_id", $user_id)
            ->select(DB::raw("*"))
            ->order("money_time", "desc")
            ->limit($options['start'], $options['limit'])
            ->get();
    }

    public function getSuccessedMoney($user_id)
    {
        return $this->select(DB::raw("SUM(`money_sum`) as balance"))
            ->where("user_id", $user_id)
            ->where(DB::raw("(`money_status` = 1 OR `money_status` = 0)"))
            ->first();
    }
}