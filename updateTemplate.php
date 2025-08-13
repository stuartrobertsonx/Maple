<?php
session_start(); // Include at top of secured pages
require 'logAction.php';
if ( isset( $_SESSION['user_id'] ) ) { // If set allow access to page
    require 'mplconf.php';
    if (isset($_POST['tmpName']) && isset($_POST['tmpContent'])) {
        $tmpName = $_POST['tmpName'];
        $tmpContent = $_POST['tmpContent'];
        switch ($tmpName) {
            case "header":
                $templatePath = HEADPATH;
                break;
            case "footer":
                $templatePath = FOOTPATH;
                break;
            case "style":
                $templatePath = STYLEPATH;
                break;
            default:
                header('Location: ./');
        }
        $tmpFile = fopen($templatePath, "w") or die("Unable to open file!");
        fwrite($tmpFile, $tmpContent);
        fclose($tmpFile);
        logActivity("Template updated: $templatePath");
        header('Location: ./');
    } else {
        echo "Did not update...";
    }
    ?>
<?php } else {  header("Location: ./login.php"); } // Redirect to login. ?>