<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Share extends CI_Controller {
    public $dta;
    public function __construct() {
        parent::__construct();
        $this->load->model('dashboardmodel', 'dashboardmodel', true);
        $this->load->library('form_validation');
        if (!$this->session->userdata('is_admin_login')) {
            redirect('home');
        }
        $this->dta=$this->session->userdata;
        
    }
    
    
    public function facebook() {
        
        echo '<pre>';
        print_r($this->dta);
        echo '</pre>';
    }
}
