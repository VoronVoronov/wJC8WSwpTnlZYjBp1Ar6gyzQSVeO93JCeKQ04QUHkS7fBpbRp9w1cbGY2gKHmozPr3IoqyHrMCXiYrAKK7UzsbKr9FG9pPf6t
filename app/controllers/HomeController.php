<?php
/*
* MyUCP
*/

class HomeController extends Controller {

	public function index() {
		if(!IsOnline())
		    return view("landing");

        model("Donation", "Event");

        $data['events'] = $this->EventModel->getUserEvents(session("user_id"));
        $data['stats'] = $this->DonationModel->getGraphData(session("user_id"));

        return view("dashboard", $data);
	}

	public function redirect()
    {
        redirect(Request::get("url"));
    }

    public function test()
    {
        model("Filter");
        dd($this->FilterModel->encodeSmiles("да приветsmile[twitch_41]smile[twitch_28]"));
    }

    public function agreement()
    {
         return view("agreement");
    }

    public function oferta()
    {
         return view("oferta");
    }

    public function privacy()
    {
        return view("privacy");
    }

    public function news()
    {
        model("News");
     
        $data['news'] = $this->NewsModel->getNews();

        return view("news", $data);
    }

    function get_curl($url) {
        if(function_exists('curl_init')) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            $output = curl_exec($ch);
            echo curl_error($ch);
            curl_close($ch);
            return $output;
        } else {
            return file_get_contents($url);
        }
    }
}