<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Dashboardmodel extends CI_Model{
    
    public function __construct() {
        parent::__construct();
    }
    
    
    public function total_user(){
        $this->db->select('id');        
        $result=$this->db->get('users');
        return $result->num_rows();
        
        
    }
     public function total_post($user_id='All',$post){
        $this->db->select('post_id');
       if($user_id =='All'){
        $this->db->where("user_id",$user_id);   
       }
       $this->db->where("post_sfor",$post);
       $result=$this->db->get('tbl_post');
       return $result->num_rows();
    }
    
    public function total_type($type){
       $this->db->select('count(post_id) as totaltype');
       $this->db->where("post_sfor",$type);
       $result=$this->db->get('tbl_post');
       return $result->result();
    }
    public function getusers()
    {
        $this->db->select('*');   
        $this->db->from('users');
        $this->db->order_by('id','DESC');
        $result=$this->db->get()->result();
        return $result;
    }
     public function getpost($post='all')
    {
        $this->db->select('tbl_post.*,users.user_name');  
        $this->db->join('users','tbl_post.user_id=users.commonid');
       if($post !='all'){
         $this->db->where("post_sfor",$post);
       }
       $this->db->order_by('post_id','DESC');
       $result=$this->db->get('tbl_post')->result();
       return $result;
    }
    public function getpostbyid($id) {
        $this->db->where('post_id',$id);
         $this->db->join('users','tbl_post.user_id=users.commonid');
        return $this->db->get('tbl_post')->result();
    }
    public function getpostbytype($type='POST') {
         $this->db->where('post_type',$type);
         $this->db->join('users','tbl_post.user_id=users.commonid');
         $this->db->order_by('post_id','DESC');
         $this->db->limit(10);
        return $this->db->get('tbl_post')->result();
    }
    
    
}

?>
