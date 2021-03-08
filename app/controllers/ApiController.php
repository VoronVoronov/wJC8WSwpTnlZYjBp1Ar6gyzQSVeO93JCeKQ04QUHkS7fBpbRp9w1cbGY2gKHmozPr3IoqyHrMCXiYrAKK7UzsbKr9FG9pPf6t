<?php
/*
* MyUCP
*/

class ApiController extends Controller {


	public function tokenActions($action) {
		model('User','Widget');

		if ($action == 'version') {
				$version_json[] = array( 
					'version'   => 0.1,
					'type'      => 'b',
                    'server'    => $_SERVER['Content-Type']);
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
		}
	}
}