<?php
session_start(); // Include at top of secured pages
require 'logAction.php';
if ( isset( $_SESSION['user_id'] ) ) { // If set allow access to page
    require 'mplconf.php';
    if (isset($_POST['mdName']) && isset($_POST['mdContent'])) {
        $filterPath = MDPATH . preg_replace("/[^A-Za-z0-9-]/", "", $_POST['mdName']) . ".md";    
        $mdContent = htmlspecialchars($_POST['mdContent']);
        $mdFile = fopen($filterPath, "w") or die("Unable to open file!");
        fwrite($mdFile, $mdContent);
        fclose($mdFile);
        logActivity("Content updated: $filterPath");
        header('Location: ./');
    } else {
        echo "Did not update...";
    }
    ?>
<?php } else {  header("Location: ./login.php"); } // Redirect to login. ?>

