<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ContactUs extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
         if (!$this->session->userdata('is_admin_login')) {
            redirect('home');
        }
    }

    public function index() {
        $arr['page'] = 'contact';
        $this->load->view('vwManageContactMssgs',$arr);
    }

    public function add_user() {
        $arr['page'] = 'contact';
        $this->load->view('vwAddUser',$arr);
    }

     public function edit_user() {
        $arr['page'] = 'contact';
        $this->load->view('vwEditUser',$arr);
    }
    
     public function block_user() {
        // Code goes here
    }
    
     public function delete_user() {
        // Code goes here
    }
    
    
    
    

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */