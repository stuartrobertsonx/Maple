<?php
    require 'mplconf.php';
    date_default_timezone_set(TIMEZONE);
    $files = array_diff(scandir(MDPATH), array('.', '..'));
    $dirScan = [];
    foreach($files as $result) {
        if (str_ends_with ($result, '.md')) {
            $resultName = substr($result, 0, -3);
            $mdDate = date("F d Y H:i:s", filemtime(MDPATH . $result));
            $htmlFile = HTMLPATH ."{$resultName}.html";
            if (file_exists($htmlFile)) {
                $htmlDate = date("F d Y H:i:s", filemtime($htmlFile));
                if ($mdDate > $htmlDate) {
                    $mdUpdate = "Update";
                }
                else {
                    $mdUpdate = "Published";
                }                
            } 
            else {
                $htmlFile = "";
                $htmlDate = "Not published";
                $mdUpdate = "Publish";
            }            
            $fileScan = array(
                "name" => $resultName,
                "mdDate" => $mdDate,
                "htmlFile" => $htmlFile,
                "htmlDate" => $htmlDate,
                "mdUpdate" => $mdUpdate
            );
            $dirScan[] = $fileScan;
        }
    }