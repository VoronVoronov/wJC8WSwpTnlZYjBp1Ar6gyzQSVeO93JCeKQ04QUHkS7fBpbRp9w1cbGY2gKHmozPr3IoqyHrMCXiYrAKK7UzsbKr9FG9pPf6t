<?php


class DonationModel extends Model
{
    public $table = "donations";

    //Статусы:
    // 0 - Неоплачен (неотправлен)
    // 1 - Оплачен
    // 2 - Error

    public function addDonation($user_id, $sum, $user_name, $data = [])
    {
        return $this->create([
            "user_id" => $user_id,
            "donation_name" => $user_name,
            "donation_ammount" => $sum,
            "donation_json" => json_encode($data),
            "donation_create_time" => "NOW()",
            "donation_ip" => $_SERVER['REMOTE_ADDR'],
        ]);
    }

    public function getAllDonations()
    {
        return $this->order("donation_create_time", "desc")
            ->get();
    }


    public function getLastDonations($user_id, $time, $limit)
    {
        switch ($time) {
            case 1: // За текущий стрим
                $time = "`donation_end_time` != 0";
                break;

            case 2: // За прошлый стрим
                $time = "`donation_end_time` != 0";
                break;

            case 3: // За все время
                $time = "`donation_end_time` != 0";
                break;

            case 4: //За текущий день
                $time = "`donation_end_time` LIKE '%". date("Y") ."-". date("m") ."-". date("d") ." %'";
                break;

            case 5: //За текущую неделю
                $time = "`donation_end_time` >= NOW()-INTERVAL 7 DAY";
                break;

            case 6: //За текущий месяц
                $time = "`donation_end_time` LIKE '%". date("Y") ."-". date("m") ."-%'";
                break;

            case 7: //За год
                $time = "`donation_end_time` LIKE '%". date("Y") ."-%'";
                break;
        }

        return $this->where("user_id", $user_id)
            ->where("donation_status", 1)
            ->where(DB::raw($time))
            ->order("donation_end_time", "desc")
            ->limit($limit)
            ->get();
    }

    public function getCostDonations($user_id, $time, $limit)
    {
        switch ($time) {
            case 1: // За текущий стрим
                $time = "`donation_end_time` != 0";
                break;

            case 2: // За прошлый стрим
                $time = "`donation_end_time` != 0";
                break;

            case 3: // За все время
                $time = "`donation_end_time` != 0";
                break;

            case 4: //За текущий день
                $time = "`donation_end_time` LIKE '%". date("Y") ."-". date("m") ."-". date("d") ." %'";
                break;

            case 5: //За текущую неделю
                $time = "`donation_end_time` >= NOW()-INTERVAL 7 DAY";
                break;

            case 6: //За текущий месяц
                $time = "`donation_end_time` LIKE '%". date("Y") ."-". date("m") ."-%'";
                break;

            case 7: //За год
                $time = "`donation_end_time` LIKE '%". date("Y") ."-%'";
                break;
        }

        return $this->where("user_id", $user_id)
            ->where("donation_status", 1)
            ->where(DB::raw($time))
            ->order("donation_ammount", "desc")
            ->limit($limit)
            ->get();
    }

    public function getUserCostDonations($user_id, $time, $limit)
    {
        switch ($time) {
            case 1: // За текущий стрим
                $time = "`donation_end_time` != 0 ";
                break;

            case 2: // За прошлый стрим
                $time = "`donation_end_time` != 0 ";
                break;

            case 3: // За все время
                $time = "`donation_end_time` != 0 ";
                break;

            case 4: //За текущий день
                $time = "`donation_end_time` LIKE '%". date("Y") ."-". date("m") ."-". date("d") ." %' ";
                break;

            case 5: //За текущую неделю
                $time = "`donation_end_time` >= NOW()-INTERVAL 7 DAY ";
                break;

            case 6: //За текущий месяц
                $time = "`donation_end_time` LIKE '%". date("Y") ."-". date("m") ."-%' ";
                break;

            case 7: //За год
                $time = "`donation_end_time` LIKE '%". date("Y") ."-%' ";
                break;
        }

        return $this->where("user_id", $user_id)
            ->select(DB::raw("SUM(`donation_ammount`) as donation_ammount, donation_name, donation_currency, donation_json"))
            ->where("donation_status", 1)
            ->where(DB::raw($time))
            ->groupBy("donation_name")
            ->order("donation_ammount", "desc")
            ->limit($limit)
            ->get();
    }

    public function getBalance($user_id, $time)
    {
        switch ($time) {
            case 1: // За текущий стрим
                $time = "`donation_end_time` != 0";
                break;

            case 2: // За прошлый стрим
                $time = "`donation_end_time` != 0";
                break;

            case 3: // За все время
                $time = "`donation_end_time` != 0";
                break;

            case 4: //За текущий день
                $time = "`donation_end_time` LIKE '%". date("Y") ."-". date("m") ."-". date("d") ." %'";
                break;

            case 5: //За текущую неделю
                $time = "`donation_end_time` >= NOW()-INTERVAL 7 DAY";
                break;

            case 6: //За текущий месяц
                $time = "`donation_end_time` LIKE '%". date("Y") ."-". date("m") ."-%'";
                break;

            case 7: //За год
                $time = "`donation_end_time` LIKE '%". date("Y") ."-%'";
                break;
        }

        return $this->where("user_id", $user_id)
            ->select(DB::raw("SUM(`donation_ammount`) as balance"))
            ->where("donation_status", 1)
            ->where(DB::raw($time))
            ->first();
    }


    public function getDonations($user_id, $time)
    {
        switch ($time) {
            case 1: // За текущий стрим
                $time = "`donation_end_time` != 0";
                break;

            case 2: // За прошлый стрим
                $time = "`donation_end_time` != 0";
                break;

            case 3: // За все время
                $time = "`donation_end_time` != 0";
                break;

            case 4: //За текущий день
                $time = "`donation_end_time` LIKE '%". date("Y") ."-". date("m") ."-". date("d") ." %'";
                break;

            case 5: //За текущую неделю
                $time = "`donation_end_time` >= NOW()-INTERVAL 7 DAY";
                break;

            case 6: //За текущий месяц
                $time = "`donation_end_time` LIKE '%". date("Y") ."-". date("m") ."-%'";
                break;

            case 7: //За год
                $time = "`donation_end_time` LIKE '%". date("Y") ."-%'";
                break;
        }

        return $this->where("user_id", $user_id)->where(DB::raw($time))->count();
    }

    public function getGraphData($user_id)
    {
        return $this->where("user_id", $user_id)
            ->select(DB::raw("SUM(`donation_ammount`) as sum, donation_end_time"))
            ->groupBy("DATE(donation_end_time)")
            ->where("donation_status", 1)
            ->get();
    }


    public function getAllGraphData()
    {
        return $this->
            ->select(DB::raw("SUM(`donation_ammount`) as sum, SUM(`donation_ammount`) as amount, donation_end_time"))
            ->groupBy("DATE(donation_end_time)")
            ->where("donation_status", 1)
            ->get();
    }

    public function getVotePercent($w_id, $v_id)
    {
        return $this->where(DB::raw("`donation_json` LIKE '%\"vote\":{\"". $w_id ."\":\"". $v_id ."\"}%'"))
            ->where("donation_status", 1)
            ->sum("donation_ammount");
    }

    public function getUserDonations($user_id, $options = [])
    {
        return $this->where("user_id", $user_id)
            ->select(DB::raw("*"))
            ->where("donation_status", 1)
            ->order("donation_end_time", "desc")
            ->limit($options['start'], $options['limit'])
            ->get();
    }

    public function getCountUserDonations($user_id)
    {
        return $this->where("user_id", $user_id)->where("donation_status", 1)->count();
    }

    public function getDonationInfo($value, $row = "donation_id")
    {
        return $this->where($row, $value)->first();
    }

    public function getDonation($id)
    {
        return $this->where("donation_id", $id)->first();
    }

    public function editDonation($id, $data = [])
    {
        return $this->where("donation_id", $id)->set($data)->update();
    }

    public function getDonationHashInfo($value, $row = "donation_hash")
    {
        return $this->where($row, $value)->first();
    }

    public function getDonationHash($hash)
    {
        return $this->where("donation_hash", $hash)->first();
    }
}