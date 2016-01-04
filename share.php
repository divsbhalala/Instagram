<?php

//ini_set("display_errors", "1");
//error_reporting(E_ALL);

@session_start();
require 'lib/instalib/Instagram.php';
require_once('./lib/twitteroauth/TwitterOAuth.php');
require_once './pages/.config.inc.php';
require_once './lib/phpFlickr.php';
require_once './pages/include/dbconfig.php';
use MetzWeb\Instagram\Instagram;

$request = json_encode($_POST);
$request = json_decode($request);
if (!isset($request->shareType, $request->shareImage) && empty($request->shareType)) {
    header('location:index.php');
    exit();
}
$shareType = $request->shareType;
$shareImage = base64_decode($request->shareImage);
$msg = @$request->msg;
$tag = @$request->tag;
$type='POST';
if(isset($request->posttype))
{
    $type=$request->posttype;
}
 else {
    
     $type='POST';
 }

//$pic = 'http://sociallabels.imnwebhosting.com/' . $shareImage;
$pic = $shareImage;
if ($shareType == 'fb') {
    if (!isset($_SESSION['fb_accesstoken'])) {
        header('location:index.php');
        exit();
    }
    require_once('lib/facebook.php');
    $facebook = new Facebook(array(
        'appId' => FB_API_ID,
        'secret' => FB_API_SECRET,
        'cookie' => false,
    ));
    $facebook->setAccessToken($_SESSION["fb_accesstoken"]);
    $toc = $facebook->getAccessToken();


    $attachment1 = array(
        'access_token' => $toc,
        'caption' => $tag . '  ' . $msg,
        'url' => 'http://sociallabels.imnwebhosting.com/'.$pic
    );
   // echo json_encode($attachment1);return;exit;
    try{
        $status = $facebook->api("/me/photos", "post", $attachment1);
        if($status)
        {
             $t=addpost($type, $_SESSION['fbusr']['id'], NULL, $pic, 'first', $msg, $tag, 'FACEBOOK');
        }
        
    echo json_encode($status);
    } catch (Exception $ex) {
    echo json_encode($ex->getMessage());
    }
    
} else if ($shareType == 'insta') {
    if (!isset($_SESSION['instatoken'])) {
        echo 'here';
        //  header('location:index.php');
        exit();
    }
// initialize class
    $instagram = new Instagram(array(
        'apiKey' => INSTA_API_KEY,
        'apiSecret' => INSTA_API_SECRET,
        'apiCallback' => INSTA_API_CALLBACK // must point to success.php
    ));
    $instagram->setAccessToken($_SESSION['instatoken']);
    $file = file_get_contents($pic);
    $data = base64_encode($file);
    $r = $instagram->updateMedia($data);
    echo json_encode($r);
} else if ($shareType == 'flickr') {
    if (isset($_SESSION['ftoken'])) {
        $api_key = FLICKR_API_KEY;
        $api_secret = FLICKR_API_SECRET;
        $f = new phpFlickr($api_key, $api_secret,true);
        $f->setToken($_SESSION['ftoken']);
        $t = $f->sync_upload($shareImage ,$title = "the title", $description = $msg, $tags = $tag);
        if(!empty($t))
        {
             $t=addpost($type, $_SESSION['flickr_token']['user']['nsid'], NULL, $pic, 'first', $msg, $tag, 'FLICKR');
        }
        echo json_encode($t);
        return;exit;
    } else {
        $st = FALSE;
        echo json_encode($st);
    }
} else if ($shareType == 'twitter') {
    $access_token = $_SESSION['twitter_access_token'];
    $twitteroauth = new TwitterOAuth(TWITTER_API_KEY, TWITTER_API_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
    $user_info = $twitteroauth->get('account/verify_credentials');
    $nm=  explode(' ', $user_info->name);
    adduser($user_info->id, null,$user_info->screen_name,'twitter',@$nm[0],@$nm[1]);
    file_put_contents('twit.json', json_encode($user_info),JSON_PRETTY_PRINT);
    $tweetmsg = $tag . '  ' . $msg;
    $file = file_get_contents($pic);
    $data = base64_encode($file);
//$response = $twitteroauth->post('https://upload.twitter.com/1.1/media/upload.json', array('media'  => $pic,'status'   => "This is a status"));
    $status = $twitteroauth->post('https://upload.twitter.com/1.1/media/upload.json', array('media_data' => $data));
    /* echo json_encode($status);
      return;
      exit; */
    $url = 'https://api.twitter.com/1.1/statuses/update.json';
    $method = 'POST';
    $params = array(
        'status' => $tweetmsg,
        'possibly_sensitive' => false,
        'media_ids' => $status->media_id
    );
    $status = $twitteroauth->post($url, $params);
    
     if(isset($status->id))
    {
        // echo json_encode('hii');
                //  return;
       $t=addpost($type, $user_info->id, NULL, $pic, 'first', $msg, $tag, 'TWITTER');
        echo json_encode($t);
         return;
    }
    echo json_encode($status->id);
}
