<?php
/*define('INSTA_API_KEY11', '499ebc60d5174cc2af21396cd1d6f290');
define('INSTA_API_SECRET11', '08b6a9dd74634f6881c8dc0c566ca652');
define('INSTA_API_CALLBACK11', 'http://sociallabels.imnwebhosting.com/?res=insta');
define('INSTA_API_CALLBACK11', 'http://vendor.rise.wearefly.com/media/pages/doinstalogin.php/?res=insta');
define('FB_API_ID1', '485247754943027');
define('FB_API_SECRET2', 'e1abda0f213cc9dbe60c236c8be684ab');
define('FLICKR_API_KEY1', '9eda878cb71089b94217104f00271562');
define('FLICKR_API_SECRET1', '12e7430eebc2e2b6');

define('TWITTER_API_KEY1', 'LW74DfTpfdfvMXSZkQSNselhE');
define('TWITTER_API_SECRET1', 'bjsmot5MtvIM928uzWdrXoIHkHezV9ZMzmUpG0FYW6CmxVd7vg');
define('TWITTER_CALL_BACK1','http://sociallabels.imnwebhosting.com/pages/redirect.php');*/
/*-------------------------------------------------*/
define('INSTA_API_KEY', 'd36be3c1ca4c43b397861effe176a27c');
define('INSTA_API_SECRET', '07b74953118c41c4a5e4cd787b95b87e');
define('INSTA_API_CALLBACK', 'http://risetowin.org/media/pages/doinstalogin.php/?res=insta');


define('FB_API_ID', '731708976959489');
define('FB_API_SECRET', '20401d00457703bbf5fbd712ef30c66a');

define('FLICKR_API_KEY', '9d1198627612e00fd53a150e1aaae9ca');
define('FLICKR_API_SECRET', '081c23a79ff9c15a');
define('FLICKR_CALLBACK', 'http://vendor.rise.wearefly.com/media/pages/doflickrlogin.php');


define('TWITTER_API_KEY', 'H4099ggj4ASmJ1ev1Ol4SsKnf');
define('TWITTER_API_SECRET', 'sqyuFi0Col48lj8XLdwEnGO5iURqN4jMgI3gfeGDja8C9kL3md');
define('TWITTER_CALL_BACK','http://vendor.rise.wearefly.com/media/auth/redirect.php');
define('MY_SITE_URL', 'http://vendor.rise.wearefly.com/');
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
