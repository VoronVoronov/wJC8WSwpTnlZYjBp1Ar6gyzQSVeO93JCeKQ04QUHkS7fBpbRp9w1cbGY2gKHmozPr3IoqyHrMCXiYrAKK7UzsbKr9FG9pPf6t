<?php
/*
* MyUCP
*/

class ApiController extends Controller {


	public function tokenActions($action) {
		model('User','Widget');
		$token = 'OitQDh8fwQIO0ZaFJZwXuz5R';
		$login = 'info@zholdas.icu';
		$api_key = '7637382C26D-987D9DF2877-4EBEEDD0F4';

		if ($action == 'version') {
				$version_json[] = array( 
					'version' => 0.1, 
					'type' => 'b');
				$version = json_encode($version_json);
				return $version;
		}elseif ($action == 'status') {
			@file_get_contents('https://ipdonate.com/api/v1/api/?token='.$token);
		}elseif ($action == 'api') {
			$api_json[] = array(
				'status' => 'OK',
			);
			$api = json_encode($api_json);
			return $api;
		}elseif ($action == 'moneyin') {
			$money_in_json_url = @file_get_contents('https://ipdonate.com/unitpay/handler');
			$money_in_json = json_decode($money_in_json_url, true);
			if ($money_in_json['jsonrpc'] == '2.0') {
				$api_money_in_json[] = array(
					'status' => 'OK',
				);
			}else{
				$api_money_in_json[] = array(
					'status' => 'ERROR',
				);
			}
			$api_money_in = json_encode($api_money_in_json);
			return $api_money_in;
		}elseif ($action == 'moneyout') {
			$money_out_json_url = @file_get_contents('https://unitpay.ru/api?method=getPartner&params[login]='.$login.'&params[secretKey]='.$api_key);
			$money_out_json = json_decode($money_out_json_url, true);
			if ($money_out_json['result']['balance'] >= 1) {
				$api_money_out_json[] = array(
					'status' => 'OK',
				);
			}else{
				$api_money_out_json[] = array(
					'status' => 'ERROR',
				);
			}
			$api_money_out = json_encode($api_money_out_json);
			return $api_money_out;
		}
	}
}