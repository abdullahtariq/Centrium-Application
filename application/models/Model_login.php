<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_login extends CI_Model {
    protected $_table = 'users';
  
    public function login($username,$password)
    {
        $q  = $this->db->select('password,id')->from('users')->where('username',$username)->get()->row();

        if($q == ""){
            return array('status' => 204,'message' => 'Username not found.');
        } else {
            $hashed_password = $q->password;
            $id              = $q->id;
             //echo $hashed_password ." ".$password;
        //exit;
            if (hash_equals($hashed_password, crypt($password, $hashed_password))) {
               $last_login = date('Y-m-d H:i:s');
               $token = crypt(substr( md5(rand()), 0, 7),'$1$somethin$');
               $expired_at = date("Y-m-d H:i:s", strtotime('+12 hours'));
               $this->db->trans_start();
               $this->db->where('id',$id)->update('users',array('last_login' => $last_login));
               $this->db->insert('users_authentication',array('users_id' => $id,'token' => $token,'expired_at' => $expired_at));
               if ($this->db->trans_status() === FALSE){
                  $this->db->trans_rollback();
                  return array('status' => 500,'message' => 'Internal server error.');
               } else {
                  $this->db->trans_commit();
                  return array('status' => 200,'message' => 'Successfully login.','id' => $id, 'token' => $token);
               }
            } else {
                echo "Wrong password";
                exit();
               return array('status' => 204,'message' => 'Wrong password.');
            }
        }
    }


}
