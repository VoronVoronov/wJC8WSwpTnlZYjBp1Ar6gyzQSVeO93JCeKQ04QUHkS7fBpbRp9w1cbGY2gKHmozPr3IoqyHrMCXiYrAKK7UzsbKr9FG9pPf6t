<?php

class UserModel extends Model 
{
	public $table = "users";

	public function addUser($data = [])
	{
		return $this->create($data);
	}

	public function getUserDonatePage($domain)
    {
        model("Widget");

        $user = (object) $this->where("user_domain", $domain)->firstOrError();

        $goal = $this->WidgetModel->getWidgets($user->user_id, "goals");
        $vote = $this->WidgetModel->getWidgets($user->user_id, "votes");
        $settings = json_decode($user->user_donate_page);

        return ["user" => $user, "goals" => $goal, "vote" => $vote, "settings" => $settings];
    }

	public function getUser($value, $row = "user_id") {
		return $this->where($row, $value)->first();
	}

	public function getUsers()
    {
        return $this->get();
    }

	public function editUser($id, $data = []) {
        return $this->where("user_id", $id)->set($data)->update();
    }

    public function getBalance($user_id)
    {
        model("Donation", "Money");

        $balance = $this->DonationModel->getBalance($user_id, 3)['balance'];
        $money = $this->MoneyModel->getSuccessedMoney($user_id)['balance'];

        return $balance - $money;
    }

    public function getDonations($user_id)
    {
        model("Donation");

        return $this->DonationModel->getDonations($user_id, 3);
    }

    public function getLastStreamEndTime($user_id)
    {
        return Builder::table("streams")->where("user_id", $user_id)->where("stream_status", 2)->value("stream_end");
    }

    public function getStreamTime($user_id)
    {
        return Builder::table("streams")->where("user_id", $user_id)->where("stream_status", 2)->sum("stream_time");
    }

    public function checkDomain($url)
    {
        return $this->where("user_domain", $url)->count();
    }

    public function sendMailTo($userid) {
        $user = $this->getUser($userid);
        $code = strrev(md5($user['user_login']));
        $body = view("email/verify", ["userid" => $userid, "code" => $code]);
        $headers = "From: ".$this->config->mail["mail_from"]."\r\nReply-To: ".$this->config->mail["mail_from"]."\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=utf-8;";
        $mbody .= $body."\r\n\r\n";
        $result = mail($user['user_email'], "Подтверждение аккаунта", $mbody, $headers);
    }

    public function sendChangeMail($user_id, $action_id)
    {
        $user = $this->getUser($userid);
        $code = strrev(md5($user['user_login']));
        $body = view("email/update", ["userid" => $userid, "code" => $code]);
        $headers = "From: ".$this->config->mail["mail_from"]."\r\nReply-To: ".$this->config->mail["mail_from"]."\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=utf-8;";
        $mbody .= $body."\r\n\r\n";
        $result = mail($user['user_email'], "Смена E-Mail", $mbody, $headers);
    }

	public function trackIP($id,$action)
	{
		Builder::table($this->table)->where('user_id', $id)
             	->set(['user_last_ip' => $_SERVER["REMOTE_ADDR"],'user_last_login_time' => 'NOW()'])
             	->update();  

	    Builder::table('log_connections')->insert(
		  ['user_id' => $id, 'ip' => $_SERVER["REMOTE_ADDR"], 'log_time'  => 'NOW()',  'log_action'	=>	$action]
		);
	}

	public function getLog($user_id)
	{
        //Builder::table("log_connections")->where("user_id", $user_id)->where("log_action", 0)->value("log_time");
        return $this->table("log_connections")
            ->where("user_id", $user_id)
            ->select(DB::raw("*"))
            ->where("log_action", 1)
            ->order("log_time", "desc")
            ->limit("0", "3")
            ->get();        
	}	
} 
