<?php
require_once '.config.inc.php';
require_once './include/dbconfig.php';
require_once '../lib/instalib/Instagram.php';
@session_start();
use MetzWeb\Instagram\Instagram;

// initialize class
$instagram = new Instagram(array(
    'apiKey' => INSTA_API_KEY,
    'apiSecret' => INSTA_API_SECRET,
    'apiCallback' => INSTA_API_CALLBACK1 // must point to success.php
));
if ((isset($_GET['res'], $_GET['code']) && !empty($_GET['res']) && !empty($_GET['code']))) {
    $code = @$_GET['code'];
    if (!isset($_SESSION['instatoken'])) {
         unset($_SESSION['instatoken']);
        unset($_SESSION['insta']);
        $instaData = $instagram->getOAuthToken($code);
        $_SESSION['instatoken'] = $instaData;
        $_SESSION['user'] = true;
        $_SESSION['insta'] = true;
        adduser($instaData->user->id, NULL, $instaData->user->username,'instagram',$instaData->user->full_name);
         
    }
   echo '<script>window.close();</script>'; 
}
else{
    $instaloginUrl = $instagram->getLoginUrl();
    header('location:'.$instaloginUrl);
}