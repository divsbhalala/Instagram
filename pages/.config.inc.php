<?php
define('INSTA_API_KEY', '499ebc60d5174cc2af21396cd1d6f290');
define('INSTA_API_SECRET', '08b6a9dd74634f6881c8dc0c566ca652');
define('INSTA_API_CALLBACK', 'http://sociallabels.imnwebhosting.com/?res=insta');
define('INSTA_API_CALLBACK1', 'http://sociallabels.imnwebhosting.com/pages/doinstalogin.php/?res=insta');
define('FB_API_ID', '485247754943027');
define('FB_API_SECRET', 'e1abda0f213cc9dbe60c236c8be684ab');
define('FLICKR_API_KEY', '9eda878cb71089b94217104f00271562');
define('FLICKR_API_SECRET', '12e7430eebc2e2b6');

define('TWITTER_API_KEY', 'LW74DfTpfdfvMXSZkQSNselhE');
define('TWITTER_API_SECRET', 'bjsmot5MtvIM928uzWdrXoIHkHezV9ZMzmUpG0FYW6CmxVd7vg');
define('TWITTER_CALL_BACK','http://sociallabels.imnwebhosting.com/pages/redirect.php');
@session_set_cookie_params(1800);
@session_start();
function genrateImgLink($farm,$server,$id,$sec)
{
   return 'http://farm'.$farm.'.staticflickr.com/'.$server.'/'.$id.'_'.$sec.'.jpg'; 
}

function getFlusername($owner)
{
   $url='https://api.flickr.com/services/rest/?method=flickr.people.getInfo&api_key='.FLICKR_API_KEY.'&user_id='.$owner.'&format=php_serial&nojsoncallback=1';
   $rsp = file_get_contents($url);
   $user=array();
    $rsp_obj = unserialize($rsp);
    $user['username']=$rsp_obj['person']['username']['_content'];
    $user['realname']=$rsp_obj['person']['realname']['_content'];
    return $user;
}
