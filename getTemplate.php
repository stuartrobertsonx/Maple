<?php
session_start(); // Include at top of secured pages
if ( isset( $_SESSION['user_id'] ) ) { // If set allow access to page
    require 'mplconf.php';
    if (isset($_GET['tmp'])) {
        $filter = htmlspecialchars(str_replace("/","-",$_GET['tmp']));
        switch ($filter) {
            case "header":
                if (file_exists(HEADPATH)) {
                    $tmpName = "header";
                    $tmpContent = file_get_contents(HEADPATH);
                }            
                break;
            case "footer":
                if (file_exists(FOOTPATH)) {
                    $tmpName = "footer";
                    $tmpContent = file_get_contents(FOOTPATH);
                }    
                break;
            case "style":
                if (file_exists(STYLEPATH)) {
                    $tmpName = "style";
                    $tmpContent = file_get_contents(STYLEPATH);
                }   
                break;
            default:
                $tmpName = "";
                $tmpContent = "Not a valid choice.";
        }
    }
    ?>
<?php } else {  header("Location: ./login.php"); } // Redirect to login. ?>