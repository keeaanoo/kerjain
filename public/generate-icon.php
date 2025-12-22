<?php
$size = isset($_GET['size']) ? (int)$_GET['size'] : 192;
header('Content-Type: image/png');
$image = imagecreate($size, $size);
$bgColor = imagecolorallocate($image, 13, 110, 253); // Bootstrap primary color
$textColor = imagecolorallocate($image, 255, 255, 255);
imagestring($image, 5, $size/2-10, $size/2-10, "K", $textColor);
imagepng($image);
imagedestroy($image);
?>