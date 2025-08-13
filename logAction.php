<?php
require 'mplconf.php';
function logActivity($message) {
    date_default_timezone_set(TIMEZONE);
    $logtext = $_SERVER['REMOTE_ADDR'] . " - ";
    if ( isset( $_SESSION['user_id'] ) ) {
        $logtext = $logtext . $_SESSION['user_id'] . " ";
    }
    $logtext = $logtext . date("[d/M/Y:H:i:s O]") . ' "' . $message . '"' . "\n";
    $logfile = fopen("../../maple.log", "a");
    fwrite($logfile, $logtext);
    fclose($logfile);
}
?>