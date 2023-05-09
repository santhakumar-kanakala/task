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
            $this->response(array('status' => 'ok', 'users' => $users,'trashed_users' => $trashed_users,'msg' => 'users found'),RestController::HTTP_OK);  
        }else{            
            $this->response(array('status' => 'error', 'users' => [],'msg' => 'users not found'),RestController::HTTP_BAD_REQUEST);  
        }
    }



    public function createUser_post(){
 
        $this->form_validation->set_rules('fname', 'First Name', 'required');
        $this->form_validation->set_rules('lname', 'Last Name', 'required');
        $this->form_validation->set_rules('email', 'Email Id', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('phone', 'Phone Number', 'required|min_length[10]|max_length[10]|is_unique[users.phone]');
        $this->form_validation->set_rules('skills', 'Skills', 'required');

        // set custom error messages
        $this->form_validation->set_message('required', 'The %s is required.');
        $this->form_validation->set_message('min_length', 'The %s must be at least %s characters in length.');
        $this->form_validation->set_message('max_length', 'The %s cannot exceed %s characters in length.');
        $this->form_validation->set_message('valid_email', 'The %s must contain a valid email address.');
        $this->form_validation->set_message('is_unique', 'The %s already registerd.');

        if ($this->form_validation->run() == FALSE) {
            $errors = $this->form_validation->error_array();
            $this->response(array('status' => 'ok', 'errors' => $errors,'msg' => 'Required Fields'),RestController::HTTP_BAD_REQUEST);  
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
              $info[] = $this->MainM->get_row('users',array('id' => $insert));
              $this->response(array('status' => 'ok', 'errors' => [],'info' => $info,'msg' => 'USER CREATED SUCCESSFULY'),RestController::HTTP_OK);  
           }else{            
              $this->response(array('status' => 'error', 'errors' => [],'info' => [],'msg' => 'FAILED TO CREATE'),RestController::HTTP_BAD_REQUEST);  
           }
        }


    }



    public function editUser_get($id){ 
        $info[] = $this->MainM->get_row('users',array('id' => $id)); 
        if(!empty($info)){ 
            $this->response(array('status' => 'ok', 'info' => $info,'msg' => 'user found'),RestController::HTTP_OK);  
        }else{            
            $this->response(array('status' => 'error', 'info' => [],'msg' => 'user not found'),RestController::HTTP_BAD_REQUEST);  
        }
    }




    public function updateUser_post($id){
 
        $this->form_validation->set_rules('fname', 'First Name', 'required');
        $this->form_validation->set_rules('lname', 'Last Name', 'required');
        $this->form_validation->set_rules('email', 'Email Id', 'required|valid_email');
        $this->form_validation->set_rules('phone', 'Phone Number', 'required|min_length[10]|max_length[10]');
        $this->form_validation->set_rules('skills', 'Skills', 'required');

        // set custom error messages
        $this->form_validation->set_message('required', 'The %s is required.');
        $this->form_validation->set_message('min_length', 'The %s must be at least %s characters in length.');
        $this->form_validation->set_message('max_length', 'The %s cannot exceed %s characters in length.');
        $this->form_validation->set_message('valid_email', 'The %s must contain a valid email address.');
        $this->form_validation->set_message('is_unique', 'The %s already registerd.');

        if ($this->form_validation->run() == FALSE) {
            $errors = $this->form_validation->error_array();
            $this->response(array('status' => 'error', 'errors' => $errors,'msg' => 'Required Fields'),RestController::HTTP_BAD_REQUEST);  
        }else{
           $data = array(
               'fname' => $this->input->post('fname'),
               'lname' => $this->input->post('lname'),
               'email' => $this->input->post('email'),
               'phone' => $this->input->post('phone'),
               'skills' => $this->input->post('skills')
           );
           $update = $this->MainM->update($data,'users',array('id' => $id)); 
           $info[] = $this->MainM->get_row('users',array('id' => $id));
           $this->response(array('status' => 'ok', 'errors' => [],'info' => $info,'msg' => 'USER UPDATED SUCCESSFULY'),RestController::HTTP_OK);   
        }

    }

    public function userDelete_post(){ 
       $type = $this->input->post('type');
       $id = $this->input->post('id');
       if($type == 'delete'){
           $data = array('status' => '2');           
           $info[] = $this->MainM->get_row('users',array('id' => $id));
           $delete = $this->MainM->update($data,'users',array('id' => $id));  
           if($delete > 0){
              $this->response(array('status' => 'ok','info' => $info,'msg' => 'USER DELETED TEMPORARILY'),RestController::HTTP_OK);
           }else{
            $this->response(array('status' => 'error', 'info' => $info,'msg' => 'USER ALREADY DELETED'),RestController::HTTP_BAD_REQUEST); 
           }
       }elseif($type == 'permanent-delete'){           
           $delete = $this->MainM->delete('users',array('id' => $id));   
           $this->response(array('status' => 'ok','msg' => 'USER DELETED TEMPORARILY'),RestController::HTTP_OK); 
       }
    }


 
}

?>