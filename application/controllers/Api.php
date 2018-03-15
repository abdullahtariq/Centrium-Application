<?php
defined('BASEPATH') OR exit('No direct script access allowed.');

require APPPATH.'/libraries/REST_Controller.php';

class Api extends REST_Controller{

      /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */

     function __construct(){
       parent::__construct();
       $this->load->helper('my_api');
     }

     function customerlogin_post(){
       $this->load->library('form_validation');
       $data = remove_unkown_fields(
                             $this->post(),
                             $this->form_validation->get_field_names('customerlogin_post'));
        $this->form_validation->set_data($data);

        if($this->form_validation->run('customerlogin_post') != false){
          $this->load->model('Model_customer');
          $exists = $this->Model_customer->get_by(
                                                  array(
                                                    'user_name'=>$this->post('user_name'),
                                                    'cust_pass'=>md5($this->post('cust_pass'))
                                                  )
                                                );
          if($exists){
            $this->response(
                  array(
                    'status'=>true,
                    'message'=>'Username and Password verified',
                    'user_name'=>$exists['user_name']
                  )
              );
          }else{
            $this->response(
                  array(
                    'status'=>false,
                    'message'=>'login fails'
                  )
              );
          }
        }else{
          $this->response(array('status'=>false,'message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
        }
     }
}



?>
