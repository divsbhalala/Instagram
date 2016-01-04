<?php
session_start();
if(isset($_REQUEST['f']))
{
    if($_REQUEST['f']=='insta')
    {
        unset($_SESSION['instatoken']);
        unset($_SESSION['insta']);
    }
    else if($_REQUEST['f']=='flickr')
    {
        unset($_SESSION['flickr']);
        unset($_SESSION['flickr_token']); 
    }
    else if($_REQUEST['f']=='twitter')
    {
        unset($_SESSION['twitter_access_token']);
        unset($_SESSION['twitter']); 
    }
}
//session_destroy();
header('location:index.php');