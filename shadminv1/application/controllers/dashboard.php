<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('dashboardmodel', 'dashboardmodel', true);
        $this->load->library('form_validation');
        if (!$this->session->userdata('is_admin_login')) {
            redirect('home');
        }
    }

    public function index() {
        $arr['page'] = 'dash';
        $post = 'All';
        $user = 'user';
        $arr['total_usr'] = $this->dashboardmodel->total_user();
        $fb = 'FACEBOOK';
        $in = 'INSTAGRAM';
        $tw = 'TWITTER';
        $flick = 'FLICKR';

        $arr['total_fb'] = $this->dashboardmodel->total_post('aa', $fb);
        $arr['total_twitter'] = $this->dashboardmodel->total_post('aa', $tw);
        $arr['total_flicker'] = $this->dashboardmodel->total_post('aa', $flick);
        $arr['total_insta'] = $this->dashboardmodel->total_post('aa', $in);
        $ppost = $this->dashboardmodel->getpostbytype();

        $cnt = 0;
        foreach ($ppost as $p) {
            $ppost[$cnt]->created_at = $this->time_elapsed_string($ppost[$cnt]->created_at);
            $cnt++;
        }
        $wpost = $this->dashboardmodel->getpostbytype('WALL');
        $cnt = 0;
        foreach ($wpost as $p) {
            $wpost[$cnt]->created_at = $this->time_elapsed_string($wpost[$cnt]->created_at);
            $cnt++;
        }
        $arr['ppost'] = $ppost;
        $arr['wpost'] = $wpost;
        $this->load->view('vwDashboard', $arr);
    }

    public function time_elapsed_string($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full)
            $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */