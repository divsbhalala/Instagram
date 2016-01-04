<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Socialpost extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        if (!$this->session->userdata('is_admin_login')) {
            redirect('home');
        }
        $this->load->model('dashboardmodel', 'dashboardmodel', true);
    }
    
    public function index() {
         $arr['page'] = 'post';
         $arr['ptitile']='<i class="fa fa-share-alt"></i> All';
        $arr['users'] = $this->dashboardmodel->getpost();
        $this->load->view('vwUserspost', $arr);
    }
     public function facebook() {
         $arr['page'] = 'fbpost';
         $arr['ptitile']='<i class="fa fa-facebook"></i> Facebook';
        $arr['users'] = $this->dashboardmodel->getpost('FACEBOOK');
        $this->load->view('vwUserspost', $arr);
    }
     public function flickr() {
         $arr['page'] = 'flickrpost';
         $arr['ptitile']='<i class="fa fa-flickr"></i> Flickr';
        $arr['users'] = $this->dashboardmodel->getpost('FLICKR');
        $this->load->view('vwUserspost', $arr);
    }
     public function Twitter() {
         $arr['page'] = 'twitterpost';
         $arr['ptitile']='<i class="fa fa-twitter"></i> Twitter';
        $arr['users'] = $this->dashboardmodel->getpost('TWITTER');
        $this->load->view('vwUserspost', $arr);
    }
    
    public function share($id){
        $id=  base64_decode($id);
        $arr=array();
        $arr['page'] = 'post';
        $arr['postdata']=$this->dashboardmodel->getpostbyid($id);
        $this->load->view('vwSocialpost', $arr);
    }
}
