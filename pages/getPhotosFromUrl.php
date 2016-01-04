<?php
@session_set_cookie_params(1800);
@session_start();
$_SESSION['ext']='jpeg';
function saveThumbnail($saveToDir, $imagePath, $imageName, $max_x, $max_y) {
    preg_match("'^(.*)\.(gif|jpe?g|png)$'i", $imageName, $ext);
    switch (strtolower($ext[2])) {
        case 'jpg' : 
        case 'jpeg': $im   = imagecreatefromjpeg ($imagePath);
                     break;
       /* case 'gif' : $im   = imagecreatefromgif  ($imagePath);
                     break;*/
        case 'png' : $im   = imagecreatefrompng  ($imagePath);
                     break;
        default    : $stop = true;
                     break;
    }
    
    if (!isset($stop)) {
        $x = imagesx($im);
        $y = imagesy($im);
    
        if (($max_x/$max_y) < ($x/$y)) {
            $save = imagecreatetruecolor($x/($x/$max_x), $y/($x/$max_x));
        }
        else {
            $save = imagecreatetruecolor($x/($y/$max_y), $y/($y/$max_y));
        }
        imagecopyresized($save, $im, 0, 0, 0, 0, imagesx($save), imagesy($save), $x, $y);
        
        imagejpeg($save, "{$saveToDir}{$ext[1]}.{$_SESSION['ext']}");
        imagedestroy($im);
        imagedestroy($save);
    }
}

if(isset($_REQUEST['url']))
{
    $name=  rand(111111111, 999999999);
    $name=  base64_encode(microtime());
    //Get the file
$content = file_get_contents(base64_decode($_REQUEST['url']));
//Store in the filesystem.
$fp = fopen('../photos/'.$name.'.'.$_SESSION['ext'], "w");
fwrite($fp, $content);
fclose($fp);
  //  copy(base64_decode($_REQUEST['url']), '../photos/'.$name.'.'.$_SESSION['ext']);
    if(file_exists('../photos/'.$name.'.'.$_SESSION['ext']))
    {
        saveThumbnail('../shadminv1/uploads/images/thumb/', '../photos/'.$name.'.'.$_SESSION['ext'], $name . '.' . $_SESSION['ext'], 200, 200);
        echo $name;
    }
    else{
        echo 'false';
    }
}