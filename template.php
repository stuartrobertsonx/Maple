<?php
session_start(); // Include at top of secured pages
if ( isset( $_SESSION['user_id'] ) ) { // If set allow access to page
    include 'templates/header.php';
    include 'getTemplate.php';
    ?>
    <aside><p id="logout"><a class="boxbutton" href="logout.php">Logout</a></p></aside>
    <main>
        <p><?php 
        echo $tmpName; 
        if ($tmpName == 'style') {
            echo ".css";
        } else {
            echo ".html";
        }
        ?></p>
    <form action="updateTemplate.php" method="post">
        <textarea id="tmpContent" name="tmpContent"><?php echo $tmpContent; ?></textarea>
        <input type="hidden" id="tmpName" name="tmpName" value="<?php echo $tmpName; ?>">
        <input class="boxbutton" type="submit" value="Submit">
        <a class="boxbutton" href="./">Cancel</a>
    </form>
    </main>
    <?php include "templates/footer.php"; ?>
<?php } else {  header("Location: ./login.php"); } // Redirect to login. ?>