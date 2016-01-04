<?php 
//require_once('../lib/twitteroauth/TwitterOAuth.php');
//require_once '.config.inc.php';
//
////echo 'here';
//if (!isset($_SESSION['twitter'])) {
//    if (!isset($_REQUEST['oauth_verifier'])) {
//        try {
//            $twitteroauth = new TwitterOAuth(TWITTER_API_KEY, TWITTER_API_SECRET);
//// Requesting authentication tokens, the parameter is the URL we will be redirected to
//            $request_token = $twitteroauth->getRequestToken(TWITTER_CALL_BACK);
//
//// Saving them into the session
//            $_SESSION['back']=$_SERVER['HTTP_REFERER'];
//            $_SESSION['t_oauth_token'] = $request_token['oauth_token'];
//            $_SESSION['t_oauth_token_secret'] = $request_token['oauth_token_secret'];
//
//            switch ($twitteroauth->http_code) {
//                case 200:
//                    //Build authorize URL and redirect user to Twitter.
//                    ob_start();
//                    $url = $twitteroauth->getAuthorizeURL($_SESSION['t_oauth_token']);
//                   // echo $url;
//                    header('Location: ' . $url);
//                   // echo 'here';
//                    break;
//                default:
//                    //Error
//                    echo "some error occured";
//            }
//        } catch (Exception $exc) {
//            header('location:index.php');
//        }
//    } else {
//        echo '2';
//        $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['t_oauth_token'], $_SESSION['t_oauth_token_secret']);
//        $access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);
//        $_SESSION['twitter_access_token'] = $access_token;
//       // print_r($access_token);
//// remove no longer needed request tokens that were set in the login page
//        unset($_SESSION['t_oauth_token']);
//        unset($_SESSION['t_oauth_token_secret']);
//        $bck=$_SESSION['back'];
//        unset($_SESSION['t_oauth_token_secret']);
//        
//        header('location:'.$_SERVER['HTTP_REFERER']);
//    }
//}
//else
//{
//    echo '1';
//    $access_token = $_SESSION['twitter_access_token'];
//// create a TwitterOauth object with tokens.
//$twitteroauth = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
//
//// get the current user's info
//$user_info = $twitteroauth->get('account/verify_credentials');
//print_r($user_info);
//
//}
//
