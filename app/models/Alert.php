<?php

class AlertModel extends Model
{
    public $table = "alerts";

    public function getAlert($id)
    {
        return $this->where("alert_id", $id)->first();
    }

    public function editAlert($id, $data = [])
    {
        return $this->where("alert_id", $id)->set($data)->update();
    }

    public function getNotShowedAlerts($id)
    {
        return $this->where("widget_id", $id)->where("alert_status", "0")->order("alert_id", "desc")->get();
    }

    public function newAlert($data = [], $show = false)
    {
        if($data['type'] == 3) {
            $alert_id = $this->create([
                'user_id' => $data['user_id'],
                'widget_id' => $data['widget_id'],
                'alert_text' => $data['msg'],
                'alert_name' => $data['user_name'],
                'alert_sum' => $data['sum'],
                'alert_curr' => $data['curr'],
                'alert_type' => $data['type'],
            ]);
                //@file_get_contents("https://api.sdonate.ru/voice.php?text=".$data['msg']."&name=".$data['msg']);

                $url = 'https://translate.google.com.vn/translate_tts?ie=UTF-8&client=tw-ob&q=' . urlencode($data['msg']) . '&tl=ru';

                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, $url);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                $result = curl_exec($curl);
                curl_close($curl);


                file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/assets/audio/' . urldecode($data['msg']) . '.mp3', $result);
        }else{
            $alert_id = $this->create([
                'user_id' => $data['user_id'],
                'widget_id' => $data['widget_id'],
                'alert_text' => $data['msg'],
                'alert_name' => $data['user_name'],
                //'alert_sum' => $data['sum'],
                //'alert_curr' => $data['curr'],
                'alert_type' => $data['type'],
            ]);
        }
        if($show) {
            $this->showAlert($alert_id);
        }

        return $alert_id;
    }

    private function showAlert($alert_id)
    {
        model("Alert", "Widget", "Filter");

        $alert = $this->AlertModel->getAlert($alert_id);
        $widget = $this->WidgetModel->getWidget($alert['widget_id']);

        $no_filtered = $alert['alert_text'];
        $alert['alert_text'] = $this->FilterModel->encodeSmiles($alert['alert_text']);
        if($alert['alert_type'] == 3) {
            $message = [
                'id' => $widget['widget_id'],
                'token' => $widget['widget_token'],
                'user_name' => $alert['alert_name'],
                'sum' => $alert['alert_sum'],
                'msg' => $alert['alert_text'],
                'no_filter' => $no_filtered,
                'curr' => $alert['alert_curr'],
                'alert_type' => $alert['alert_type'],
                'alert_id' => $alert_id,
            ];
        }else{
            $message = [
                'id' => $widget['widget_id'],
                'token' => $widget['widget_token'],
                'user_name' => $alert['alert_name'],
                //'sum' => $alert['alert_sum'],
                'msg' => $alert['alert_text'],
                //'no_filter' => $no_filtered,
                //'curr' => $alert['alert_curr'],
                'alert_type' => $alert['alert_type'],
                'alert_id' => $alert_id,
            ];
        }
        $message = json_encode($message);

        library("class.ClientWebSocket");
        $socket = new WebsocketClient;
        $socket->connect('ipdonate.com', 9400, "/");        
		usleep(5000);

        $socket->sendData($message);
        usleep(5000);
    }
}