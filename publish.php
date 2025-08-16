<?php
session_start(); // Include at top of secured pages
require 'logAction.php';
if ( isset( $_SESSION['user_id'] ) ) { // If set allow access to page
  require 'mplconf.php';
  require 'parsedown/Parsedown.php';
  if (isset($_POST['md'])) {
      $filterName = preg_replace("/[^A-Za-z0-9-]/", "", $_POST['md']);    
      $mdPath = MDPATH . $filterName . ".md";
      $htmlPath = HTMLPATH . $filterName . ".html";
      $mdContent = "";
      if (file_exists($mdPath)) {
        $string = file_get_contents($mdPath);
        $sEnd = strripos($string,"+++");
        $mdContent = str_replace("+++","", substr($string,$sEnd));                    
      } else {
          $mdContent = "";
      }  
      $htmlStart = "<!DOCTYPE html>\n<html>\n<head>\n<meta charset=\"utf-8\">\n";
      $htmlMid = "\n<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">\n<link href=\"" . STYLEPATH . "\" rel=\"stylesheet\">\n</head>\n<body>\n";
      $htmlEnd = "</body>\n</html>";
      $Parsedown = new Parsedown();
      $htmlContent = $Parsedown->text($mdContent);
      if (file_exists(HEADPATH)) {
          $htmlContent = file_get_contents(HEADPATH) . $htmlContent;
      }
      if (file_exists(SCRIPTPATH)) {
          $scriptContent = file_get_contents(SCRIPTPATH);
      }    
      if (file_exists(FOOTPATH)) {
          $htmlContent = $htmlContent . file_get_contents(FOOTPATH);
      }

      $file = fopen($mdPath, "r");
      $stringStart = 0;
      while(! feof($file)) {
        $line = fgets($file);
        if (str_contains($line, "+++")) {
          $stringStart++;
          if ($stringStart > 1) {
            break;
          } 
        } else {
          if (str_contains($line, "=")) {
            list($k, $v) = explode('=', $line);
            $result[ trim($k) ] = trim($v);
          }
        }
      }
      $metaContent = "";
      if (isset($result['title'])) {
        $filterTitle = preg_replace("/[^A-Za-z0-9-.,?!]/", "", $result['title']);
        $metaContent = $metaContent . "<title>" . $filterTitle . "</title>\n";
      } else {
        $metaContent = $metaContent . "<title>untitled document</title>\n";
      }
      if (isset($result)) {
        foreach ($result as $key => $value) {
          if ($key != "title") {
            $filterKey = preg_replace("/[^A-Za-z0-9-.,?!]/", "", $key);
            $filterValue = preg_replace("/[^A-Za-z0-9-.,?!]/", "", $value);
            $metaContent = $metaContent . "<meta name='$filterKey' content='$filterValue'>\n";
          }
        }
      }

      $htmlContent = $htmlStart . $metaContent . $scriptContent . $htmlMid . $htmlContent . $htmlEnd;
      $htmlFile = fopen($htmlPath, "w") or die("Unable to open html file!");
      fwrite($htmlFile, $htmlContent);
      fclose($htmlFile);
      logActivity("HTML published: $htmlPath");
      header('Location: ./');
  } else {
      echo "Did not update...";
  }

  function getMeta($mdPath) {
    $file = fopen($mdPath, "r");
    $stringStart = 0;
    while(! feof($file)) {
      $line = fgets($file);
      if (str_contains($line, "+++")) {
        $stringStart++;
        if ($stringStart > 1) {
            break;
        } 
      } else {
        if (str_contains($line, "=")) {
          list($k, $v) = explode('=', $line);
          $result[ trim($k) ] = trim($v);
        }
      }
    }
    $metaContent = "";
    if (isset($result['title'])) {
        $filterTitle = preg_replace("/[^A-Za-z0-9-.,?!]/", "", $result['title']);
        $metaContent = $metaContent . "<title>" . $filterTitle . "</title>\n";
    } else {
        $metaContent = $metaContent . "<title>untitled document</title>\n";
    }
    if (isset($result)) {
      foreach ($result as $key => $value) {
        if ($key != "title") {
          $filterKey = preg_replace("/[^A-Za-z0-9-.,?!]/", "", $key);
          $filterValue = preg_replace("/[^A-Za-z0-9-.,?!]/", "", $value);
          $metaContent = $metaContent . "<meta name='$filterKey' content='$filterValue'>\n";
        }
      }
    }
    return $metaContent;
  }
  ?>
<?php } else {  header("Location: ./login.php"); } // Redirect to login. ?>