<?php

// Set the content-type
header('Content-Type: image/png');


// Create the image
#$im = imagecreatetruecolor(400, 30);
$im = imagecreatefromjpeg('public/fb-background.jpg');

// Create some colors
$white = imagecolorallocate($im, 255, 255, 255);
$grey = imagecolorallocate($im, 128, 128, 128);
$black = imagecolorallocate($im, 0, 0, 0);
imagefilledrectangle($im, 0, 0, 0, 0, $black);

// The text to draw
#$text = 'Chiến Phạm';
#$text = 'DQ Lambo Nguyễn Văn Quang';
#$text = 'Mymy Nguyen';
$text = 'Lê Vũ Ba';
// Replace path by your own font path
$font = 'public/fonts/UVFDartangnonITCStd.ttf';
$font_size = 38;
#$font_size = 25;
$angle = 0;

$splittext = explode ( "\n" , $text );
$lines = count($splittext);

foreach ($splittext as $text) {
  $text_box = imagettfbbox($font_size,$angle,$font,$text);
  $text_width = abs(max($text_box[2], $text_box[4]));
  $text_height = abs(max($text_box[5], $text_box[7]));
  $x = (imagesx($im) - $text_width)/2;
  $y = ((imagesy($im) + $text_height)/2)-($lines-2)*$text_height;
  $lines=$lines-1;
  imagettftext($im, $font_size, $angle, $x+1, $y+2, $black, $font, $text);
  imagettftext($im, $font_size, $angle, $x, $y, $white, $font, $text);
}

// Add some shadow to the text


// Add the text
//imagettftext($im, $font_size, 0, 232, 220, $white, $font, $text);

// Using imagepng() results in clearer text compared with imagejpeg()
imagepng($im);
imagedestroy($im);
die;
