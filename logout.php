<?php
session_start();

// Destroying the session clears the $_SESSION variable
session_destroy();
header("Location: ./login.php");
?>