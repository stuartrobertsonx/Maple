<?php
require 'mplconf.php';
if (isset($_GET['md'])) {
    $filter = MDPATH . htmlspecialchars(str_replace("/","-",$_GET['md'])) . ".md";
    if (file_exists($filter)) {
        $mdName = $_GET['md'];
        $mdContent = file_get_contents($filter);
    }
}
?>