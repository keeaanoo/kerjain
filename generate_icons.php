<?php
$sizes = [72, 96, 128, 144, 152, 192, 384, 512];
foreach ($sizes as $size) {
    $image = imagecreate($size, $size);
    $bgColor = imagecolorallocate($image, 13, 110, 253); // Bootstrap primary color
    $textColor = imagecolorallocate($image, 255, 255, 255);
    imagestring($image, 5, $size/2-10, $size/2-10, 'K', $textColor);
    imagepng($image, "public/icon-{$size}x{$size}.png");
    imagedestroy($image);
    echo "Created icon-{$size}x{$size}.png\n";
}
echo 'All icons generated successfully!\n';
?>
