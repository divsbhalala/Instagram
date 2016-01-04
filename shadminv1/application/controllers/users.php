<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        if (!$this->session->userdata('is_admin_login')) {
            redirect('home');
        }
        $this->load->model('dashboardmodel', 'dashboardmodel', true);
    }

    public function index() {
        $arr['page'] = 'user';
        $arr['users'] = $this->dashboardmodel->getusers();
        $socialarray = array();
        foreach ($arr['users'] as $key) {
            $social=array();
            $social['id'] = $key->id;
            $social['user_name'] = $key->user_name;
            $social['first_name'] = $key->first_name;
            $social['last_name'] = $key->last_name;
            $social['email'] = $key->email;
            if ($key->facebookid != '') {
                $social['social'] = 'FACEBOOK';
                $social['socialid'] = $key->facebookid;
            } else if ($key->twitterid != '') {
                $social['social'] = 'TWITTER';
                $social['socialid'] = $key->twitterid;
            } else if ($key->flickrid != '') {
                $social['social'] = 'FLICKR';
                $social['socialid'] = $key->flickrid;
            } else if ($key->instagramid != '') {
                $social['social'] = 'INSTAGRAM';
                $social['socialid'] = $key->instagramid;
            }
            $socialarray[]=$social;
        }
        $arr['users']=$socialarray;
        $this->load->view('vwManageUser', $arr);
    }

    public function add_user() {
        $arr['page'] = 'user';
        $this->load->view('vwAddUser', $arr);
    }

    public function edit_user() {
        $arr['page'] = 'user';
        $this->load->view('vwEditUser', $arr);
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