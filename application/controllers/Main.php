<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Main extends CI_Controller {

    function __construct() {
        parent::__construct(); 
         $this->load->helper('common');
          $this->load->model('MainM');
    } 
    
    //REGISTRATION FORM PAGE 
    function home(){
        $seg = $this->uri->segment(3);
        if(!$seg){
           $data['title'] = 'USER REGISTRATION';
           $this->load->view('front/home',$data);
        }elseif($seg === 'register'){  //REGISTRATION STARTS
            $fields = array('required' => 'YOU MUST PROVIDE <span class="text-danger">%s</span>');
            $this->form_validation->set_rules('fname','FIRST NAME','trim|required',$fields); 
            $this->form_validation->set_rules('lname','LAST NAME','trim|required',$fields); 
            $this->form_validation->set_rules('email','EMAIL ID','trim|required|valid_email',$fields); 
            $this->form_validation->set_rules('phone','PHONE NUMBER','trim|required|min_length[10]|max_length[10]',$fields); 
            $this->form_validation->set_rules('skills','SKILLS','trim|required',$fields); 
            
            /*============= CHECKING THE EMAIL ID IS ALREADY EXISTS OR NOT =========*/
            $check_email = $this->MainM->check_user('users',array('email' => $this->input->post('email')));
            if($check_email == false){ $msg = 'EMAIL ALREADY REGISTERED';}

            /*============= CHECKING THE PHONE NUMBER IS ALREADY EXISTS OR NOT =========*/
            $check_phone = $this->MainM->check_user('users',array('phone' => $this->input->post('phone')));
            if($check_phone == false){ $msg = 'PHONE NUMBER ALREADY REGISTERED';}
           
            $csrf_token = $this->input->post($this->security->get_csrf_token_name()); 
            if ($csrf_token !== null && !hash_equals($csrf_token, $this->security->get_csrf_hash())){ $cvalid = false; $msg = 'The action you requested is not allowed.';}else{$cvalid = true;}



            $fvalid = $this->form_validation->run();
            if(!$fvalid){ $msg = validation_errors(); }
            if($fvalid){ $valid = true; }else{ $valid = false; }
            if($valid && $check_email && $check_phone && $cvalid){ 
                $data = array(
                   'fname' => $this->input->post('fname'),
                   'lname' => $this->input->post('lname'),
                   'email' => $this->input->post('email'),
                   'phone' => $this->input->post('phone'),
                   'skills' => $this->input->post('skills'),
                   'status' => '1'
                );

                $insert = $this->MainM->create_user('users',$data);
                if($insert > 0){
                  echo json_encode(array("status" => TRUE, "msg" => 'USER REGISTERED SUCCESSFULLY....!!!'));
                }else{
                  echo json_encode(array("status" => FALSE, "msg" => 'FAILED TO REGISTER....!!!'));
                }                 
            }else{ 
               echo json_encode(array("status" => FALSE, "msg" => $msg));  
            }
           // END OF REGISTRATION
        }
    }
    // END OF REGISTRATION FORM PAGE


  // LIST OF USERS, UPDATE USER & DELETE TEMPORARILY 
  function list(){
      $seg = $this->uri->segment(3);
      $seg2 = $this->uri->segment(4);
      if(!$seg){
         $data['title'] = 'REGISTERED USERS LIST';
         $data['listings'] = $this->MainM->get_lists('lists'); 
         $this->load->view('front/list', $data);
      }elseif($seg === 'get-user'){
        if(!$seg2){ redirect(base_url('main/list')); }
        else{
            $user_id= $seg2;
            $data = $this->MainM->get_row('users',array('id' => $user_id));
            echo json_encode($data);
        }
      }elseif($seg === 'edit-user'){
         $data['title'] = 'EDIT USER DATA';
         $data['detail'] = $this->MainM->get_row('users',array('id' => $seg2));
         $this->load->view('front/edit',$data);
      }elseif($seg === 'update-user'){

            $fields = array('required' => 'YOU MUST PROVIDE %s');
            $this->form_validation->set_rules('fname','FIRST NAME','trim|required',$fields); 
            $this->form_validation->set_rules('lname','LAST NAME','trim|required',$fields); 
            $this->form_validation->set_rules('email','EMAIL ID','trim|required|valid_email',$fields); 
            $this->form_validation->set_rules('phone','PHONE NUMBER','trim|required|min_length[10]|max_length[10]',$fields); 
            $this->form_validation->set_rules('skills','SKILLS','trim|required',$fields); 
            
            /*============= CHECKING THE EMAIL ID IS ALREADY EXISTS OR NOT =========*/
            $check_email = $this->MainM->check_user('users',array('email' => $this->input->post('email')));
            if($check_email == false){ $msg = 'EMAIL ALREADY REGISTERED';}

            /*============= CHECKING THE PHONE NUMBER IS ALREADY EXISTS OR NOT =========*/
            $check_phone = $this->MainM->check_user('users',array('phone' => $this->input->post('phone')));
            if($check_phone == false){ $msg = 'PHONE NUMBER ALREADY REGISTERED';}

            $fvalid = $this->form_validation->run();
            if(!$fvalid){ $msg = validation_errors(); }
            if($fvalid){ $valid = true; }else{ $valid = false; }
            if($valid && $check_email && $check_phone){ 

                $data['fname'] = $this->input->post('fname');
                $data['lname'] = $this->input->post('lname');
                $data['email'] = $this->input->post('email');
                $data['phone'] = $this->input->post('phone');
                $data['skills'] = $this->input->post('skills');

                $update = $this->MainM->update($data,'users',array('id' => $this->input->post('id'))); 
                echo json_encode(array("status" => TRUE, "msg" => 'USER UPDATED SUCCESSFULLY....!!!'));                 
            }else{ 
               echo json_encode(array("status" => FALSE, "msg" => $msg));  
            }
      }elseif($seg === 'delete-temporarily'){
         $data = array( 'status' => '2'); 
         $delete = $this->MainM->update($data,'users',array('id' => $seg2));
         echo json_encode(array('status' => true,'msg' => 'USER RECORD TEMPORTAILY DELETED....!!'));
      }
  }

  // END OF LIST OF USERS & DELETE TEMPORARILY 



 // LIST OF TRAHED USERS & DELETE PERMANENTLY 
  function trash(){
      $seg = $this->uri->segment(3);
      $seg2 = $this->uri->segment(4);
      if(!$seg){
         $data['title'] = 'REGISTERED USERS LIST';
         $data['trashlists'] = $this->MainM->get_lists('trash');
         $this->load->view('front/trash',$data);
      }elseif($seg === 'get-user'){
        if(!$seg2){ redirect(base_url('main/trash')); }
        else{
            $user_id= $seg2;
            $data = $this->MainM->get_row('users',array('id' => $user_id));
            echo json_encode($data);
        }
      }elseif($seg === 'restore'){
         $data = array( 'status' => '1'); 
         $delete = $this->MainM->update($data,'users',array('id' => $seg2));
         echo json_encode(array('status' => true,'msg' => 'USER RECORD RESTORED SUCCESSFULLY....!!'));
      }elseif($seg === 'delete-permanently'){
         $where = array( 'id' => trim($this->input->post('id')) ); 
         $delete = $this->MainM->delete('users',$where);
         echo json_encode(array('status' => true,'msg' => 'USER RECORD PERMANENTLY DELETED....!!'));
      }
  }

  // END OF LIST OF TRAHED USERS & DELETE PERMANENTLY 




}