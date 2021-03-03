<?php
class PaymentController extends Controller{

    public function index($id){
		model("Donation", "User");

        $data['payment'] = $this->DonationModel->getDonation($id);
        $payment = $this->DonationModel->getDonation($id);
        $paypal = $this->UserModel->getUser($payment['user_id'], 'user_id');
        $data['paypal'] = json_decode($paypal['user_paypal']);

        return view("payment/index", $data);
    }

    public function webmoneyp($id){
        model("Donation", "User");
        $donation = $this->DonationModel->getDonation($id);
        $data['payment'] = $this->DonationModel->getDonation($id);
        $data['desc'] = base64_encode('Оплата счета №'.$id);
        $data['webmoney'] = $this->config->webmoneyP['wallet'];
        $data['secret'] = $this->config->webmoneyP['secret_key_x20'];
        $data['sum'] = $donation['donation_ammount']/100*2 + $donation['donation_ammount'];

        return view("payment/webmoney", $data);
    }

    public function webmoneyr($id){
        model("Donation", "User");
        $donation = $this->DonationModel->getDonation($id);
        $data['payment'] = $this->DonationModel->getDonation($id);
        $data['desc'] = base64_encode('Оплата счета №'.$id);
        $data['webmoney'] = $this->config->webmoneyP['wallet'];
        $data['secret'] = $this->config->webmoneyP['secret_key_x20'];
        $data['sum'] = $donation['donation_ammount']/100*2 + $donation['donation_ammount'];

        return view("payment/webmoney", $data);
    }

    public function webmoneyb($id){
        model("Donation", "User");
        $donation = $this->DonationModel->getDonation($id);
        $data['payment'] = $this->DonationModel->getDonation($id);
        $data['desc'] = base64_encode('Оплата счета №'.$id);
        $data['webmoney'] = $this->config->webmoneyB['wallet'];
        $data['secret'] = $this->config->webmoneyB['secret_key_x20'];
        $data['sum'] = $donation['donation_ammount']/100*2 + $donation['donation_ammount'];

        return view("payment/webmoney", $data);
    }

    public function webmoneye($id){
        model("Donation", "User");
        $donation = $this->DonationModel->getDonation($id);
        $data['payment'] = $this->DonationModel->getDonation($id);
        $data['desc'] = base64_encode('Оплата счета №'.$id);
        $data['webmoney'] = $this->config->webmoneyE['wallet'];
        $data['secret'] = $this->config->webmoneyE['secret_key_x20'];
        $data['sum'] = $donation['donation_ammount']/100*2 + $donation['donation_ammount'];

        return view("payment/webmoney", $data);
    }

    public function webmoneyk($id){
        model("Donation", "User");
        $donation = $this->DonationModel->getDonation($id);
        $data['payment'] = $this->DonationModel->getDonation($id);
        $data['desc'] = base64_encode('Оплата счета №'.$id);
        $data['webmoney'] = $this->config->webmoneyK['wallet'];
        $data['secret'] = $this->config->webmoneyK['secret_key_x20'];
        $data['sum'] = $donation['donation_ammount']/100*2 + $donation['donation_ammount'];

        return view("payment/webmoney", $data);
    }


    public function webmoneyZ($id){
        model("Donation", "User");
        $donation = $this->DonationModel->getDonation($id);
        $data['payment'] = $this->DonationModel->getDonation($id);
        $data['desc'] = base64_encode('Оплата счета №'.$id);
        $data['webmoney'] = $this->config->webmoneyZ['wallet'];
        $data['secret'] = $this->config->webmoneyZ['secret_key_x20'];
        $data['sum'] = $donation['donation_ammount']/100*2 + $donation['donation_ammount'];

        return view("payment/webmoney", $data);
    }

    public function qiwi($id){
    	model("Donation");
    	$donation = $this->DonationModel->getDonation($id);
	    require_once($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php'); // Require autoload file generated by composer  
        $billPayments = new Qiwi\Api\BillPayments($this->config->qiwi["secret_key"]);
	    $customFields = ['themeCode' => 'DASTAN-ZhwIXgilMqA', 'paySourcesFilter' => 'qw'];  
            $params = [
                'amount'        => $donation['donation_ammount']/100*5 + $donation['donation_ammount'],
                'currency'      => 'RUB',
                'account'       => $id,
                'email'         => Request::post("email"),
                'phone'         => Request::post("to"),
                'comment'       => 'Оплата счета №'.$donation['donation_id'],
                'customFields'  => $customFields
                ];
                $billId = $id.'-'.hash('sha256', $id.'RUB'.$donation['donation_ammount'].$donation['donation_create_time']).'-'.$donation['user_id'];
            	$response = $billPayments->createBill($billId, $params);
                //dd($response);
                $encode = json_encode($response);
                $link = json_decode($encode);
                return header('Location: ' . $link->payUrl); 
                exit;
    }

    public function yoomoney($id){
    	model("Donation");
    	$donation = $this->DonationModel->getDonation($id);
    	$sum = $donation['donation_ammount']/100*4 + $donation['donation_ammount'];
    	$label = $id.'-'.hash('sha256', $id.$donation['donation_ammount'].$donation['donation_create_time']).'-'.$donation['user_id'];
        $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, 'https://yoomoney.ru/quickpay/confirm.xml');
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, 'receiver=' . $this->config->yoomoney["wallet"] . '&currency=643&targets=IPDonate&sum=' . $sum . '&label=' . $label . '&formcomment=IPDonate&comment=Оплата счета №' . $id . '&quickpay-form=donate&paymentType=PC');
            $out = curl_exec($curl);
            curl_close($curl);
            $link = explode('to ', $out);
        return header('Location: ' . $link[1]);
        exit;
    }

    public function card($id){
    	model("Donation");
    	$donation = $this->DonationModel->getDonation($id);              
	    require_once($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php'); // Require autoload file generated by composer
        $billPayments = new Qiwi\Api\BillPayments($this->config->qiwi["secret_key"]);
        $customFields = ['themeCode' => 'DASTAN-ZhwIXgilMqA', 'paySourcesFilter' => 'card'];            
            $params = [
                'amount'        => $donation['donation_ammount']/100*5 + $donation['donation_ammount'],
                'currency'      => 'RUB',
                'account'       => $id,
                'email'         => Request::post("email"),
                'phone'         => Request::post("to"),
                'comment'       => 'Оплата счета №'.$donation['donation_id'],
                'customFields'  => $customFields
                ];
                $billId = $id.'-'.hash('sha256', $id.'RUB'.$donation['donation_ammount'].$donation['donation_create_time']).'-'.$donation['user_id'];
                $response = $billPayments->createBill($billId, $params);
                //dd($response);
                $encode = json_encode($response);
                $link = json_decode($encode);
                return header('Location: ' . $link->payUrl); 
                exit;
    }    

    public function QiwiHandler($params = []){
        function getIP() {
            if(isset($_SERVER['HTTP_X_REAL_IP'])) return $_SERVER['HTTP_X_REAL_IP'];
            return $_SERVER['REMOTE_ADDR'];
        }
            if (!in_array(getIP(), array('78.47.129.94'))) {
            //die("hacking attempt!");
            header('Location: https://ipdonate.com/');
        }
    	model("Donation", "Alert", "Widget", "Filter");
        $params = Request::get("params");
        if(isset($params['donation_id'])){
            $donation = $this->DonationModel->getDonationInfo($params['donation_id']);
                    if ($donation['donation_status'] == 0) {
        		        if(!$this->DonationModel->editDonation($donation['donation_id'], [
        		            "donation_end_time" => "NOW()",
        		            "donation_status"   =>  1,
        		            "donation_ammount"  =>  (float) $donation['donation_ammount'],
        		        ]));       
        		        $donation['donation_json'] = json_decode($donation['donation_json']);

        		        if(!empty($donation['donation_json']->goal)){
        		            $w_goal = $this->WidgetModel->getWidgetMoney($donation['donation_json']->goal);

        		            $this->WidgetModel->editWidget($donation['donation_json']->goal, [
        		                "widget_money"  =>  $w_goal + (float) $donation['donation_ammount'],
        		            ]);

        		            $this->AlertModel->newAlert([
                                "user_id"   => $donation['user_id'],
        		                "widget_id" =>  $donation['donation_json']->goal,
        		                "user_name" => $donation['donation_name'],
        		                "sum" => (float) $donation['donation_ammount'],
        		                "curr" => "RUB",
        		                "type" => 1,
        		            ], true);
        		        }

        		        $widgets = $this->WidgetModel->getUserAlertsWidget($donation['user_id']);
        		        foreach ($widgets as $widget)
        		        {
        		            $this->AlertModel->newAlert([
                                "user_id"   => $donation['user_id'],
        		                "widget_id" =>  $widget['widget_id'],
        		                "msg" => $this->FilterModel->url_to_html_element(base64_decode($donation['donation_json']->text)),
        		                "user_name" => $donation['donation_name'],
        		                "sum" => (float) $donation['donation_ammount'],
        		                "curr" => "RUB",
        		                "type" => 3,
        		            ], true);
        		                //$name = urlencode($this->FilterModel->url_to_html_element(base64_decode($donation['donation_json']->text)));
        		                //file_get_contents("https://api.sdonate.ru/voice.php?text=".$this->FilterModel->url_to_html_element(base64_decode($donation['donation_json']->text))."&name=".$this->FilterModel->url_to_html_element(base64_decode($donation['donation_json']->text)));
        		        }	     
        	        }  
        }     
    }

    public function YoomoneyHandler($params = []){
                function getIP() {
                    if(isset($_SERVER['HTTP_X_REAL_IP'])) return $_SERVER['HTTP_X_REAL_IP'];
                    return $_SERVER['REMOTE_ADDR'];
                }
                    if (!in_array(getIP(), array('78.47.129.94'))) {
                    //die("hacking attempt!");
                    header('Location: https://ipdonate.com/');
                }
                model("Donation", "Alert", "Widget", "Filter");
                $params = Request::get("params");
                $donation = $this->DonationModel->getDonationInfo($params['donation_id']);
                if(!$this->DonationModel->editDonation($donation['donation_id'], [
                    "donation_end_time" => "NOW()",
                    "donation_status"   =>  1,
                    "donation_ammount"  =>  (float) $donation['donation_ammount'],
                ]));       
                $donation['donation_json'] = json_decode($donation['donation_json']);

                if(!empty($donation['donation_json']->goal)){
                    $w_goal = $this->WidgetModel->getWidgetMoney($donation['donation_json']->goal);

                    $this->WidgetModel->editWidget($donation['donation_json']->goal, [
                        "widget_money"  =>  $w_goal + (float) $donation['donation_ammount'],
                    ]);

                    $this->AlertModel->newAlert([
                        "user_id"   => $donation['user_id'],
                        "widget_id" =>  $donation['donation_json']->goal,
                        "user_name" => $donation['donation_name'],
                        "sum" => (float) $donation['donation_ammount'],
                        "curr" => "RUB",
                        "type" => 1,
                    ], true);
                }

                $widgets = $this->WidgetModel->getUserAlertsWidget($donation['user_id']);
                foreach ($widgets as $widget)
                {
                    $this->AlertModel->newAlert([
                        "user_id"   => $donation['user_id'],
                        "widget_id" =>  $widget['widget_id'],
                        "msg" => $this->FilterModel->url_to_html_element(base64_decode($donation['donation_json']->text)),
                        "user_name" => $donation['donation_name'],
                        "sum" => (float) $donation['donation_ammount'],
                        "curr" => "RUB",
                        "type" => 3,
                    ], true);
                        //$name = urlencode($this->FilterModel->url_to_html_element(base64_decode($donation['donation_json']->text)));
                        //file_get_contents("https://api.sdonate.ru/voice.php?text=".$this->FilterModel->url_to_html_element(base64_decode($donation['donation_json']->text))."&name=".$this->FilterModel->url_to_html_element(base64_decode($donation['donation_json']->text)));
                }        
    }

    public function WebmoneyHandler($params = []){
                function getIP() {
                    if(isset($_SERVER['HTTP_X_REAL_IP'])) return $_SERVER['HTTP_X_REAL_IP'];
                    return $_SERVER['REMOTE_ADDR'];
                }
                    if (!in_array(getIP(), array('78.47.129.94'))) {
                    //die("hacking attempt!");
                    header('Location: https://ipdonate.com/');
                }
                model("Donation", "Alert", "Widget", "Filter");
                $params = Request::get("params");
                $donation = $this->DonationModel->getDonationInfo($params['donation_id']);
                if(!$this->DonationModel->editDonation($donation['donation_id'], [
                    "donation_end_time" => "NOW()",
                    "donation_status"   =>  1,
                    "donation_ammount"  =>  (float) $donation['donation_ammount'],
                ]));       
                $donation['donation_json'] = json_decode($donation['donation_json']);

                if(!empty($donation['donation_json']->goal)){
                    $w_goal = $this->WidgetModel->getWidgetMoney($donation['donation_json']->goal);

                    $this->WidgetModel->editWidget($donation['donation_json']->goal, [
                        "widget_money"  =>  $w_goal + (float) $donation['donation_ammount'],
                    ]);

                    $this->AlertModel->newAlert([
                        "user_id"   => $donation['user_id'],
                        "widget_id" =>  $donation['donation_json']->goal,
                        "user_name" => $donation['donation_name'],
                        "sum" => (float) $donation['donation_ammount'],
                        "curr" => "RUB",
                        "type" => 1,
                    ], true);
                }

                $widgets = $this->WidgetModel->getUserAlertsWidget($donation['user_id']);
                foreach ($widgets as $widget)
                {
                    $this->AlertModel->newAlert([
                        "user_id"   => $donation['user_id'],
                        "widget_id" =>  $widget['widget_id'],
                        "msg" => $this->FilterModel->url_to_html_element(base64_decode($donation['donation_json']->text)),
                        "user_name" => $donation['donation_name'],
                        "sum" => (float) $donation['donation_ammount'],
                        "curr" => "RUB",
                        "type" => 3,
                    ], true);
                        //$name = urlencode($this->FilterModel->url_to_html_element(base64_decode($donation['donation_json']->text)));
                        //file_get_contents("https://api.sdonate.ru/voice.php?text=".$this->FilterModel->url_to_html_element(base64_decode($donation['donation_json']->text))."&name=".$this->FilterModel->url_to_html_element(base64_decode($donation['donation_json']->text)));
                } 
    }

    public function PaypalHandler($params = []){
                function getIP() {
                    if(isset($_SERVER['HTTP_X_REAL_IP'])) return $_SERVER['HTTP_X_REAL_IP'];
                    return $_SERVER['REMOTE_ADDR'];
                }
                    if (!in_array(getIP(), array('78.47.129.94'))) {
                    //die("hacking attempt!");
                    header('Location: https://ipdonate.com/');
                }
                model("Donation", "Alert", "Widget", "Filter");
                $params = Request::get("params");
                $donation = $this->DonationModel->getDonationInfo($params['donation_id']);
                if(!$this->DonationModel->editDonation($donation['donation_id'], [
                    "donation_end_time" => "NOW()",
                    "donation_status"   =>  1,
                    "donation_ammount"  =>  (float) $donation['donation_ammount'],
                ]));       
                $donation['donation_json'] = json_decode($donation['donation_json']);

                if(!empty($donation['donation_json']->goal)){
                    $w_goal = $this->WidgetModel->getWidgetMoney($donation['donation_json']->goal);

                    $this->WidgetModel->editWidget($donation['donation_json']->goal, [
                        "widget_money"  =>  $w_goal + (float) $donation['donation_ammount'],
                    ]);

                    $this->AlertModel->newAlert([
                        "user_id"   => $donation['user_id'],
                        "widget_id" =>  $donation['donation_json']->goal,
                        "user_name" => $donation['donation_name'],
                        "sum" => (float) $donation['donation_ammount'],
                        "curr" => "RUB",
                        "type" => 1,
                    ], true);
                }

                $widgets = $this->WidgetModel->getUserAlertsWidget($donation['user_id']);
                foreach ($widgets as $widget)
                {
                    $this->AlertModel->newAlert([
                        "user_id"   => $donation['user_id'],
                        "widget_id" =>  $widget['widget_id'],
                        "msg" => $this->FilterModel->url_to_html_element(base64_decode($donation['donation_json']->text)),
                        "user_name" => $donation['donation_name'],
                        "sum" => (float) $donation['donation_ammount'],
                        "curr" => "RUB",
                        "type" => 3,
                    ], true);
                        //$name = urlencode($this->FilterModel->url_to_html_element(base64_decode($donation['donation_json']->text)));
                        //file_get_contents("https://api.sdonate.ru/voice.php?text=".$this->FilterModel->url_to_html_element(base64_decode($donation['donation_json']->text))."&name=".$this->FilterModel->url_to_html_element(base64_decode($donation['donation_json']->text)));
                } 
    }

}

/*$params = array(
'receiver' => $this->config->yoomoney["wallet"],
'currency' => '643',
'short-dest' => 'IPDonate',
'sum' => $donation['donation_ammount']/100*4 + $donation['donation_ammount'],
'label' => $id.'-'.hash('sha256', $id.$donation['donation_ammount'].$donation['donation_create_time']).'-'.$donation['user_id'],
'formcomment' => 'IPDonate',
'comment' => 'Оплата счета №'.$id,
'targets' => 'IPDonate',
'quickpay-form' => 'donate',
'paymentType' => 'PC',
);
$url = 'https://yoomoney.ru/quickpay/confirm.xml?' . http_build_query($params);*/