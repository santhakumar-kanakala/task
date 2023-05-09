<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 
class MainM extends CI_Model
{


    public function create_user($table,$data){
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    public function check_user($table,$where){
       $query = $this->db->get_where($table, $where);
       $result = $query->result_array(); 
       if(count($result) > 1){return false; }else{ return true; }
    }
    public function update($data, $table, $where){
        $this->db->update($table, $data, $where);
        return $this->db->affected_rows();
    } 

    public function delete($table, $where){
        $this->db->delete($table, $where);
        return $this->db->affected_rows();
    } 

    public function get_row($table, $where) {
       $query = $this->db->get_where($table, $where);
       return $query->row_array();
    }

    public function get_all($table, $where) {
       $query = $this->db->get_where($table, $where);
       return $query->result_array();
    }
    

    public function get_lists($type){
        if($type == 'lists'){
           $query = $this->db->get_where('users', array('status' => '1'));
           return $query->result_array();
        }elseif($type == 'trash'){
           $query = $this->db->get_where('users', array('status' => '2'));
           return $query->result_array();
        }
    }
 





}