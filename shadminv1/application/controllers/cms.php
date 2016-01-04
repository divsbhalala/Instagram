<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cms extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
         if (!$this->session->userdata('is_admin_login')) {
            redirect('home');
        }
    }

    public function index() {
        $arr['page'] = 'cms';
        
        $qry ='Select * from tbl_cms'; // select data from db
        $arr['cms'] = $this->db->query($qry)->result_array();        
        $this->load->view('vwManageCMS',$arr);
    }

     public function edit_cms($id='') {
        $arr['page'] = 'cms';
        if($id!=''){
          $qry ='Select id,label,`content` from tbl_cms where id='.$id ; // select data from db
        $arr['cms'] = $this->db->query($qry)->result_array();
        
        $this->load->view('vwEditCMS',$arr);
        }else{
            redirect('cms');
        }
    }
   
    
       public function update_cms() {
          
           
           
           $id = $_POST['pst_id'];
           $new_content = $_POST['tst_content'];
            
        if(isset($id) && !empty($id) ){
             $sql = "update tbl_cms set `content`='".$new_content."' where id=".$id;
             $val = $this->db->query($sql,array($new_content ,$id ));
             redirect('cms/edit_cms/'.$id);
        }
        
        $arr['page'] = 'cms';
        $this->load->view('vwEditCMS',$arr);
    }
    

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */