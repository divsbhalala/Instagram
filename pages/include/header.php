<?php
/*ini_set("display_errors", "0");
//error_reporting(E_ALL);
@session_set_cookie_params(1800);
@session_start();
require 'instalogin.php';
require 'flickr.php';
$_SESSION['ext'] = 'jpeg';
$loginbtn = '';
$logoutbtn = '';
$btninstalogin = '';
$InstaPhotos = array();
/* --------------------Start Instagram Login-------------------- */
/*if ((isset($_GET['res'], $_GET['code']) && !empty($_GET['res']) && !empty($_GET['code'])) || isset($_SESSION['instatoken'])) {
    $code = @$_GET['code'];
    if (!isset($_SESSION['instatoken'])) {
        $instaData = $instagram->getOAuthToken($code);
        $_SESSION['instatoken'] = $instaData;
        $_SESSION['user'] = true;
        $_SESSION['insta'] = true;
        adduser($instaData->user->id, NULL, $instaData->user->username,'instagram',$instaData->user->full_name);
         echo '<script>window.close();</script>';
    } else {
        $instaData = $_SESSION['instatoken'];
    }
    $username = $instaData->user->username;
    //echo '<pre>';
   // print_r($instaData);
    // store user access token
    $instagram->setAccessToken($instaData);
    if(isset($_SESSION['instaphoto']) && !empty($_SESSION['instaphoto']))
    {
        $InstaPhotos=$_SESSION['instaphoto'];
    }
 else {
        $InstaPhotos = $instagram->getUserMedia();
    $_SESSION['instaphoto']=$InstaPhotos;
    }
    
}
if (!isset($_SESSION['insta'])) {
    $btninstalogout = 'display:none;';
    $istyle = 'display:none;';
    $btninstalogin = '';
} else {
    $btninstalogout = '';
    $istyle = 'display:block;';
    $btninstalogin = 'display:none;';
}
$fblogoutbtn = '';
$fbloginbtn = '';
/* --------------------stop Instagram Login-------------------- */
/*if (!isset($_SESSION["fb_accesstoken"])) {
    $fblogoutbtn = 'display:none;';
} else {
    $fbloginbtn = 'display:none;';
}
$fblimit = '200';
$fboffset = '0';
$fcall = 'Y';
$fbphotos = array();
if (isset($_SESSION['fb_accesstoken'])) {
    $_SESSION['user'] = true;
    $_SESSION['fb'] = true;
    //include $path.'/pages/.config.inc.php';
    require $path . '/lib/facebook.php';
    $facebook = new Facebook(array(
        'appId' => FB_API_ID,
        'secret' => FB_API_SECRET,
        'cookie' => false,
    ));
    $facebook->setAccessToken($_SESSION["fb_accesstoken"]);
    $uid = $facebook->getUser();
    if(isset($_SESSION['bfadduser']) && $_SESSION['bfadduser']==true)
    {
       
    }
    else
    {
        $_SESSION['bfadduser']=TRUE;
         $fbuser = $facebook->api("/me" );
         $_SESSION['fbusr']=$fbuser;
        adduser($fbuser['id'], @$fbuser['email'], $fbuser['name'],'facebook',$fbuser['first_name'],$fbuser['last_name']);
    }

    // print_r($uid);
    $fbphotos = $facebook->api("/me/photos/?offset=" . $fboffset . "&limit=" . $fblimit);
    $fboffset = $fblimit;
    $fcall = 'N';
}
$fbphotos=array();*/

?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Social</title>

        <!-- Bootstrap Core CSS -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/css/font-awesome.css" rel="stylesheet">
        <link href="assets/css/bootstrap-social.css" rel="stylesheet">

        <link rel='stylesheet' href='assets/css/tooltips.css'>
        <link href="assets/css/styles.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" type="text/css" media="screen" />
        <link href="assets/css/Icomoon/style.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/animate.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/animated-notifications.css" rel="stylesheet" type="text/css" />
                        <link href="assets/theme/theme.css" rel="stylesheet" type="text/css" />

        <!-- Custom CSS -->

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <!-- jQuery -->


    </head>
