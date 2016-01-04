<?php
require_once '.config.inc.php';
require_once '../lib/instalib/Instagram.php';

use MetzWeb\Instagram\Instagram;

// initialize class
$instagram = new Instagram(array(
    'apiKey' => INSTA_API_KEY,
    'apiSecret' => INSTA_API_SECRET,
    'apiCallback' => INSTA_API_CALLBACK // must point to success.php
));
if (isset($_SESSION['instatoken'])) {
        $instaData = $_SESSION['instatoken'];
        $instagram->setAccessToken($instaData);
        $InstaPhotos = $instagram->getUserMedia();
        echo json_encode($InstaPhotos);
    } else {
       $d=array('data'=>'not found');
       echo json_encode($d);
    }

