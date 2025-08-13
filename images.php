<?php 
session_start(); // Include at top of secured pages
if ( isset( $_SESSION['user_id'] ) ) { // If set allow access to page
    include 'templates/header.php'; 
    ?>
    <aside><p id="logout"><a class="boxbutton" href="logout.php">Logout</a></p></aside>
    <main>
        <nav>
            <ul>
                <li><a class="active" href="#">Images</a></li>
                <li><a href="./">Pages</a></li>
            </ul>
        </nav>
    <table>
        <thead>
            <tr>
                <th>Image File</th>
                <th>Date</th>
                <th>Size</th>
            </tr>
        </thead>
        <tbody>
        <?php
        include 'getImages.php';
        foreach ($imgScan as $row) { 
            echo "<tr>";
            echo "<td><a href=\"../img/{$row["name"]}\">{$row["name"]}</a></td>";
            echo "<td>{$row["date"]}</a></td>";
            echo "<td>{$row["size"]}</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
    <form class="upload" action="upload.php" method="post" enctype="multipart/form-data">
    <label for="fileToUpload">Select image to upload:</label>
    <input type="file" name="fileToUpload" id="fileToUpload" required>
    <input class="boxbutton" type="submit" value="Upload Image" name="submit">
    </form>
    </main>
    <?php include "templates/footer.php"; ?>
<?php } else {  header("Location: ./login.php"); } // Redirect to login. ?>