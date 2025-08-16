<?php
require 'mplconf.php';
$mdName = "";
if (isset($_GET['md'])) {
    $filter = MDPATH . preg_replace("/[^A-Za-z0-9-]/", "", $_GET['md']) . ".md";
    if (file_exists($filter)) {
        $mdName = preg_replace("/[^A-Za-z0-9-]/", "", $_GET['md']);
        $mdContent = file_get_contents($filter);
    }
}
?>