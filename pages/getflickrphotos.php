<?php
require_once './.config.inc.php';

require '../lib/phpFlickr.php';
@session_set_cookie_params(1800);
@session_start();
$api_key = FLICKR_API_KEY;
$api_secret = FLICKR_API_SECRET;
$default_redirect = 'http://sociallabels.imnwebhosting.com/';
$permissions = "write";
$rsp_obj = array();
$f = new phpFlickr($api_key, $api_secret);

 if (isset($_SESSION['flickr_token']) && !empty($_SESSION['flickr_token'])) {
    $_SESSION['user']=true;
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
    }
   
   echo json_encode($flphotos);
}