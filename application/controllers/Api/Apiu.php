<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/RestController.php';
use chriskacerguis\RestServer\RestController;

class Apiu extends RestController{

    public function __construct(){
        parent::__construct();
        $this->load->model('MainM'); 
    }

    public function index_get(){ 
        $users = $this->MainM->get_all('users',array('status' => '1'));
        $trashed_users = $this->MainM->get_all('users',array('status' => '2'));
        if(!empty($users)){ 
            $this->response(array('status' => 'ok', 'users' => $users,'trashed_users' => $trashed_users,'msg' => 'users found'));  
        }else{            
            $this->response(array('status' => 'error', 'users' => [],'msg' => 'users not found'));  
        }
    }



    public function createUser_post(){
 
        $this->form_validation->set_rules('fname', 'Username', 'required');
        $this->form_validation->set_rules('lname', 'Password', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('phone', 'Email', 'required|min_length[10]|max_length[10]');
        $this->form_validation->set_rules('skills', 'Email', 'required');

        // set custom error messages
        $this->form_validation->set_message('required', 'The %s field is required.');
        $this->form_validation->set_message('min_length', 'The %s field must be at least %s characters in length.');
        $this->form_validation->set_message('max_length', 'The %s field cannot exceed %s characters in length.');
        $this->form_validation->set_message('valid_email', 'The %s field must contain a valid email address.');

        if ($this->form_validation->run() == FALSE) {
            $errors = $this->form_validation->error_array();
            $this->response(array('status' => 'ok', 'errors' => $errors,'msg' => 'REQUIRED FIELDS'));  
        }else{
           $data = array(
               'fname' => $this->input->post('fname'),
               'lname' => $this->input->post('lname'),
               'email' => $this->input->post('email'),
               'phone' => $this->input->post('phone'),
               'skills' => $this->input->post('skills'),
               'status' => 1,
           );
           $insert = $this->MainM->create_user('users',$data);
           if($insert > 0){
              $this->response(array('status' => 'ok', 'errors' => [],'msg' => 'users found'));  
           }else{            
              $this->response(array('status' => 'error', 'errors' => [],'msg' => 'users found'));  
           }
        }


    }

 
}

?>