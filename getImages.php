<?php
require 'mplconf.php';
date_default_timezone_set(TIMEZONE);
$files = array_diff(scandir(IMGPATH), array('.', '..'));
$imgScan = [];
foreach($files as $result) {
    $imageFileType = strtolower(pathinfo($result,PATHINFO_EXTENSION));
    if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg" || $imageFileType == "gif" ) {
    // if (str_ends_with ($result, '.md')) {
        $imgName = $result;
        $imgDate = date("F d Y H:i:s", filemtime(IMGPATH . $result));
        $imgSize = formatFileSize(IMGPATH . $result);         
        $fileScan = array(
            "name" => $imgName,
            "date" => $imgDate,
            "size" => $imgSize
        );
        $imgScan[] = $fileScan;
    }
}
function formatFileSize($filename) {
    $size = filesize($filename);
    $units = array('B', 'KB', 'MB', 'GB', 'TB');
    $formattedSize = $size;
    for ($i = 0; $size >= 1024 && $i < count($units) - 1; $i++) {
        $size /= 1024;
        $formattedSize = round($size, 1);
    }
    return $formattedSize . ' ' . $units[$i];
}