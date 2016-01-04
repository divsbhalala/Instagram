<?php

mysql_connect('localhost', 'socialla_social', 'sociallabelsimnw') or die('Could not Connect to database');
mysql_select_db('socialla_share')or die('Could not select database');
define('TBLPOST', 'tbl_post');
define('TBLUSER', 'users');

function addpost($type, $userid, $useremail, $img, $title, $msg, $hastag, $social) {
    $sql = 'Insert INTO ' . TBLPOST . ' (user_id,user_email,post_type,post_title,post_msg,post_hashtag,post_sfor,post_img) VALUES ('
            . '"' . $userid . '",'
            . '"' . $useremail . '",'
            . '"' . $type . '",'
            . '"' . $title . '",'
            . '"' . $msg . '",'
            . '"' . $hastag . '",'
            . '"' . $social . '",'
            . '"' . $img . '"'
            . ')';
//return $sql;exit;
    mysql_query($sql);
    return mysql_affected_rows();
}

function adduser($userid, $email, $username, $with, $fname = NULL, $lname = NULL) {
    $sel = 'select id from ' . TBLUSER . '  where ' . $with . 'id="' . $userid.'"';
    $result = mysql_query($sel);
    $num_rows= mysql_num_rows($result);
    if ($num_rows > 0) {
        return $result;
    } else {
        $sql = 'INSERT INTO ' . TBLUSER . ' (user_name,first_name,last_name,email,commonid,' . $with . 'id) VALUES ('
                . ' "' . $username . '" ,'
                . ' "' . $fname . '" ,'
                . ' "' . $lname . '" ,'
                . ' "' . $email . '" ,'
                . ' "' . $userid . '",'
                . ' "' . $userid . '"'
                . ')';
        mysql_query($sql);
        return mysql_affected_rows();
    }
}
