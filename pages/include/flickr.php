<?php

//include $path.'/pages/.config.inc.php';
require_once 'dbconfig.php';

require $path . '/lib/phpFlickr.php';
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
    echo '<script>window.close();</script>';
    if(isset($_SESSION['wallflickr'])){
        $red=$_SESSION['wallflickr'];
        unset($_SESSION['wallflickr']);
        ob_clean();
        header('location:' . $red);
        exit();
        
    }
    header('location:' . $default_redirect);
} else if (isset($_SESSION['flickr_token']) && !empty($_SESSION['flickr_token'])) {
  /*  $_SESSION['user']=true;
    $_SESSION['flickr']=true;
    $params = array(
        'api_key' => FLICKR_API_KEY,
        'method' => 'flickr.people.getPublicPhotos',
        'user_id' => $_SESSION['flickr_token']['user']['nsid'],
        'format' => 'php_serial',
    );
    $encoded_params = array();

    foreach ($params as $k => $v) {

        $encoded_params[] = urlencode($k) . '=' . urlencode($v);
    }
    $url = "https://api.flickr.com/services/rest/?" . implode('&', $encoded_params);

    $rsp = file_get_contents($url);

    $rsp_obj = unserialize($rsp);

    $flphotos = array();
    foreach ($rsp_obj['photos']['photo'] as $photo) {
       // $owner = getFlusername($photo['owner']);
        $a=array();
        $a['username'] = $_SESSION['flickr_token']['user']['username'];
        $a['realname'] = $_SESSION['flickr_token']['user']['username'];
        $a['url'] = genrateImgLink($photo['farm'], $photo['server'], $photo['id'], $photo['secret']);
    
        $flphotos[]=$a;
    }*/
   
    //exit();
    $flphotos = array();
} else if (!isset($_SESSION['flickr_token'])) {
   // $f->auth($permissions);
}
//print_r($_SESSION['flickr_token']);