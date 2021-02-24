<?php
               
    function getIP() {
        if(isset($_SERVER['HTTP_X_REAL_IP'])) return $_SERVER['HTTP_X_REAL_IP'];
        return $_SERVER['REMOTE_ADDR'];
    }
        if (!in_array(getIP(), array('31.186.100.49', '178.132.203.105', '52.29.152.23', '52.19.56.234'))) {
        //die("hacking attempt!");
        header('Location: https://ipdonate.com/');
    }

class UnitPayController extends Controller
{
    public function handler()
    {
        if (empty(Request::get("method"))
            || empty(Request::get("params"))
            || !is_array(Request::get("params"))
        ) {
            return $this->getResponseError('Invalid request');
        }

        $method = Request::get("method");
        $params = Request::get("params");

        if($params['signature'] != $this->getSignature($method, $params, config()->unitpay['secret_key'])) {
            return $this->getResponseError('Incorrect digital signature');
        }

        if($method == "check")
            return $this->check($params);

        if($method == "pay")
            return $this->pay($params);

        if($method == "error")
            return $this->error($params);

        return $this->getResponseError('Invalid request');
    }

    private function check($params = [])
    {
        model("Donation");

        if(!($donation = $this->DonationModel->getDonationInfo($params['account']))) {
            return $this->getResponseError('Платеж не найден в базе данных! (#41)');
        }

        if($donation['donation_status'] != 0)
        {
            return $this->getResponseError('Платеж уже оплачен или отменён! (#42)');
        }

        if($params['orderSum'] != $donation['donation_ammount'])
        {
            return $this->getResponseError('Сумма платежа неккоректная! (#43)');
        }

        if(!$this->DonationModel->editDonation($donation['donation_id'], [
            "unitpayId" => $params['unitpayId'],
        ]))
        {
            return $this->getResponseError('Произошла неизвестная ошибка! (#44)');
        }

        return $this->getResponseSuccess('CHECK is successful');
    }

    private function pay($params = [])
    {
        model("Donation", "Alert", "Widget", "Filter");

        if(!($donation = $this->DonationModel->getDonationInfo($params['account']))) {
            return $this->getResponseError('Платеж не найден в базе данных! (#51)');
        }

        if($donation['donation_status'] == 1)
        {
            return $this->getResponseError('Платеж уже оплачен или отменён! (#52)');
        }

        if($params['orderSum'] != $donation['donation_ammount'])
        {
            return $this->getResponseError('Сумма платежа неккоректная! (#53)');
        }

        if(!$this->DonationModel->editDonation($donation['donation_id'], [
            "donation_end_time" => "NOW()",
            "donation_status"   =>  1,
            "donation_ammount"  =>  (float) $params['profit'],
        ]))
        {
            return $this->getResponseError('Произошла неизвестная ошибка! (#54)');
        }

        $donation['donation_json'] = json_decode($donation['donation_json']);

        if(!empty($donation['donation_json']->goal)){
            $w_goal = $this->WidgetModel->getWidgetMoney($donation['donation_json']->goal);

            $this->WidgetModel->editWidget($donation['donation_json']->goal, [
                "widget_money"  =>  $w_goal + $params['orderSum'],
            ]);

            $this->AlertModel->newAlert([
                "widget_id" =>  $donation['donation_json']->goal,
                "user_name" => $donation['donation_name'],
                "sum" => (float)$params['profit'],
                "curr" => "RUB",
                "type" => 1,
            ], true);
        }

        $widgets = $this->WidgetModel->getUserAlertsWidget($donation['user_id']);
        foreach ($widgets as $widget)
        {
            $this->AlertModel->newAlert([
                "widget_id" =>  $widget['widget_id'],
                "msg" => $this->FilterModel->url_to_html_element(base64_decode($donation['donation_json']->text)),
                "user_name" => $donation['donation_name'],
                "sum" => (float)$params['profit'],
                "curr" => "RUB",
                "type" => 3,
            ], true);
                //$name = urlencode($this->FilterModel->url_to_html_element(base64_decode($donation['donation_json']->text)));
                //file_get_contents("https://api.sdonate.ru/voice.php?text=".$this->FilterModel->url_to_html_element(base64_decode($donation['donation_json']->text))."&name=".$this->FilterModel->url_to_html_element(base64_decode($donation['donation_json']->text)));
        }

        return $this->getResponseSuccess('PAY is successful');
    }

    private function error($params = [])
    {
        model("Donation");

        if(!($donation = $this->DonationModel->getDonationInfo($params['account']))) {
            return $this->getResponseError('Платеж не найден в базе данных! (#51)');
        }

        if($donation['donation_status'] == 1)
        {
            return $this->getResponseError('Платеж уже оплачен или отменён! (#52)');
        }

        if($params['orderSum'] != $donation['donation_ammount'])
        {
            return $this->getResponseError('Сумма платежа неккоректная! (#53)');
        }

        if(!$this->DonationModel->editDonation($donation['donation_id'], [
            "donation_status"   =>  2,
        ]))
        {
            return $this->getResponseError('Произошла неизвестная ошибка! (#54)');
        }

        return $this->getResponseError('PAY is canceled');
    }

    private function getResponseSuccess($message)
    {
        return json_encode(array(
            "jsonrpc" => "2.0",
            "result" => array(
                "message" => $message
            ),
            'id' => 1,
        ));
    }

    private function getResponseError($message)
    {
        return json_encode(array(
            "jsonrpc" => "2.0",
            "error" => array(
                "code" => -32000,
                "message" => $message
            ),
            'id' => 1
        ));
    }

	function getSignature($method, array $params, $secretKey) {
		ksort($params);
		unset($params['sign']);
		unset($params['signature']);
		array_push($params, $secretKey);
		array_unshift($params, $method);
		return hash('sha256', join('{up}', $params));
	}	
}