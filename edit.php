<?php
session_start(); // Include at top of secured pages
if ( isset( $_SESSION['user_id'] ) ) { // If set allow access to page
    include 'templates/header.php';
    include 'getContent.php';
    ?>
    <aside><p id="logout"><a class="boxbutton" href="logout.php">Logout</a></p></aside>
    <main>
        <form action="updateContent.php" method="post">
            <?php if (isset($_GET['md'])) { ?>
                <p><?php echo $_GET['md']; ?>.md</p>
                <textarea id="mdContent" name="mdContent" required><?php echo $mdContent; ?></textarea>
                <input type="hidden" id="mdName" name="mdName" value="<?php echo $mdName ?>">
            <?php } else { ?>
        <input class="mdtitle" type="text" id="mdName" name="mdName" placeholder="filename" required>.md
        <textarea id="mdContent" name="mdContent" required 
placeholder="+++
title = Example
description = This section converts to meta tags
+++
#Markdown Text
This section will be converted from Markdown to HTML
Note: < and > will be converted to &amp;lt; and &amp;gt;
        "></textarea>
            <?php } ?>    
            <input class="boxbutton" type="submit" value="Submit">
            <a class="boxbutton" href="./">Cancel</a>
        </form>
    </main>
    <?php include "templates/footer.php"; ?>
<?php } else {  header("Location: ./login.php"); } // Redirect to login. ?>