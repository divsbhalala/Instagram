<?php

include $path.'.config.inc.php';
require_once 'include/dbconfig.php';

require $path . '../lib/phpFlickr.php';
@session_set_cookie_params(1800);
@session_start();
$api_key = FLICKR_API_KEY;
$api_secret = FLICKR_API_SECRET;
$default_redirect = 'http://sociallabels.imnwebhosting.com/';
$permissions = "write";
$rsp_obj = array();
$f = new phpFlickr($api_key, $api_secret);
    $flphotos = array();
if (!empty($_GET['frob'])) {
    $toc = $f->auth_getToken($_GET['frob']);
    $_SESSION['flickr_token'] = $toc;
    $_SESSION['ftoken']=$_SESSION['flickr_token']['token']['_content'];
     $_SESSION['user']=true;
    $_SESSION['flickr']=true;
    $nm=  explode(' ',$toc['user']['fullname']) ;
    $r=adduser($toc['user']['nsid'], null,$toc['user']['username'],'flickr',@$nm[0],@$nm[1]);
    ob_start();
   // print_r($toc);exit;
    echo '<script>window.close();</script>';
} 