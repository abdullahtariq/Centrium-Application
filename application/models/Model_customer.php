<?php
defined('BASEPATH') OR exist('No direct script access allowed');

class Model_customer extends MY_Model{
    protected $_table = 'Customer_Login';
    protected $return_type = 'array';

    protected $after_get = array('remove_sesitive_data');
  	protected $before_create = array('prep_data');

  	protected function remove_sesitive_data($employee){
  		unset($employee['cust_pass']);
  		return $employee;
  	}
  	protected function prep_data($user){
  		$user['cust_pass'] = md5($user['cust_pass']);
  		return $user;
  	}
}
