<?php
include '.config.inc.php';
require '../lib/phpFlickr.php';
$api_key = FLICKR_API_KEY;
$api_secret = FLICKR_API_SECRET;
$default_redirect = 'http://sociallabels.imnwebhosting.com/';
$permissions = "write";
$f = new phpFlickr($api_key, $api_secret);
$f->auth($permissions);
