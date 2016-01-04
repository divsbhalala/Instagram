<?php
include $path.'/pages/.config.inc.php';
require $path.'/lib/instalib/Instagram.php';

use MetzWeb\Instagram\Instagram;

// initialize class
$instagram = new Instagram(array(
    'apiKey' => INSTA_API_KEY,
    'apiSecret' => INSTA_API_SECRET,
    'apiCallback' => INSTA_API_CALLBACK // must point to success.php
));

// create login URL
$instaloginUrl = $instagram->getLoginUrl();
