<?php 
session_start(); // Include at top of secured pages
if ( isset( $_SESSION['user_id'] ) ) { // If set allow access to page
    include 'templates/header.php'; 
    include 'getPages.php';
    ?>
    <aside><p id="logout"><a class="boxbutton" href="logout.php">Logout</a></p></aside>
    <main>
        <nav>
            <ul>
                <li><a href="images.php">Images</a></li>
                <li><a class="active" href="#">Pages</a></li>
            </ul>
        </nav>
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>.md Modified</th>
                    <th>.html Published</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            foreach ($dirScan as $row) { 
                echo "<tr>";
                echo "<td><a href=\"edit.php?md={$row["name"]}\">{$row["name"]}</a></td>";
                echo "<td>{$row["mdDate"]}</td>";
                if (empty($row["htmlFile"])) { 
                    echo "<td>Not published</td>";
                } else { 
                    echo "<td><a href=\"{$row["htmlFile"]}\">{$row["htmlDate"]}</a></td>"; 
                }
                if ($row["mdUpdate"] == "Published") { 
                    echo "<td>Published</td>";
                } else { 
                    echo "<td><form action=\"publish.php\" method=\"post\"><input type=\"hidden\" name=\"md\" value=\"{$row["name"]}\"><input class=\"button\" type=\"submit\" value=\"{$row["mdUpdate"]}\"></form></td>";
                }
                echo "</tr>";
            }
            ?>
            <tr><td colspan="4"><a href="edit.php">+ New Page</a></td></tr>
        </table>
        <p id="templateLinks"><strong>Templates:</strong> <a href="template.php?tmp=header">Header</a> / <a href="template.php?tmp=footer">Footer</a> / <a href="template.php?tmp=style">Style</a></p>
    </main>
    <?php include "templates/footer.php"; ?>
<?php } else {  header("Location: ./login.php"); } // Redirect to login. ?>