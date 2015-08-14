<?php
session_start();
header('Content-type: image/jpeg');
$text=$_SESSION['secure1'];

$font_size=30;

$image_width = 200;

$image_height= 40;

$image=imagecreate($image_width, $image_height);

imagecolorallocate($image, 255, 255, 255);

 $text_color=imagecolorallocate($image, 0,0,0);

 imagettftext($image, $font_size, 0, 15, 30, $text_color ,'font1.ttf' ,$text );

 imagejpeg($image);

?>