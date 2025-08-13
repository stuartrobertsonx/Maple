<?php
session_start();
require 'logAction.php';
if ($_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    logActivity("Invalid CSRF token");
    die("Invalid CSRF token");
} else {
    if ( ! empty( $_POST ) ) {
        if ( isset( $_POST['password'] ) && isset( $_POST['username'] )) {
            if (file_exists('../../password.txt')) {
                $savedHash = file_get_contents('../../password.txt');
            }
            // Verify user password and set $_SESSION
            if ( password_verify( $_POST['password'], $savedHash ) ) {
                if (!preg_match('/[^A-Za-z0-9]/', $_POST['username']))  {
                    $_SESSION['user_id'] = $_POST['username'];
                    session_regenerate_id();
                    logActivity("Login");
                    header('Location: ./');
                } else {
                    header('Location: ./login.php');           
                }
            } else {
                header('Location: ./login.php');           
            }
        } else {
            header('Location: ./login.php');
        } 
    }
}
?>