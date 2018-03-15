<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$config = array(
	'customer_post' => array(
			array('field' => 'user_email','label'=>'user_email','rules'=>'trim|required|valid_email'),
			array('field' => 'user_password','label'=>'user_password','rules'=>'trim|required'),
			array('field' => 'user_name','label'=>'user_name','rules'=>'trim|required'),
			array('field' => 'type_id','label'=>'type_id','rules'=>'trim|required')
		),
	'customer_put' => array(
			array('field' => 'user_email','label'=>'user_email','rules'=>'trim|valid_email'),
			array('field' => 'user_name','label'=>'user_name','rules'=>'trim'),
			array('field' => 'type_id','label'=>'type_id','rules'=>'trim')
		),
	'customerlogin_post' => array(
			array('field' => 'user_name','label'=>'user_name','rules'=>'trim|required'),
			array('field' => 'cust_pass','label'=>'cust_pass','rules'=>'trim|required')
		),
	'customer_post'=>array(
			array('field' => 'answer_value','label'=>'answer_value','rules'=>'trim|required'),
			array('field' => 'question_id','label'=>'question_id','rules'=>'trim|required')
		)
	);
?>
