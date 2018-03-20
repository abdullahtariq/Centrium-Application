<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function login()
	{
		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {

			$check_auth_client = true;

			if($check_auth_client == true){
				$params = $_REQUEST;

		        $username = $params['username'];
		        $password = $params['password'];
            $this->load->model('Model_login');

		        $response = $this->Model_login->login($username,$password);
				//echo $response;
				json_output($response['status'],$response);
			}
		}
	}

	public function logout()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = true;
			if($check_auth_client == true){
		        $response = $this->Model_login->logout();
				json_output($response['status'],$response);
			}
		}
	}

}
