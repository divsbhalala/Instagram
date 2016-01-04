<?php
require_once('../lib/twitteroauth/TwitterOAuth.php');
require_once '.config.inc.php';
if (isset($_REQUEST['oauth_token']) && $_SESSION['t_oauth_token'] !== $_REQUEST['oauth_token']) {
    $_SESSION['t_oauth_status'] = 'expired_token';
    header('Location: clearsession.php');
}
 $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['t_oauth_token'], $_SESSION['t_oauth_token_secret']);
$access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);
$_SESSION['twitter_access_token'] = $access_token;
$_SESSION['twitter']=true;
unset($_SESSION['t_oauth_token']);
unset($_SESSION['t_oauth_token_secret']);

// proceed furhter is HTTP response is 200 or else send to error page 
if (200 == $connection->http_code) {
     $bck=$_SESSION['back'];
        unset($_SESSION['back']);
        header('location:'.$bck);

} else {
//error page
print_r($connection);exit;
   // header('Location: error.html');
}
