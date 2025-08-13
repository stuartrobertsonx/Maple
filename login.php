<?php 
session_start(); // Include for CSRF token
include './templates/header.php';
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
?>
<main>
    <form id="login" action="verify.php" method="post">
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">        
        <label for="username">Name</label>
        <input type="text" name="username" placeholder="Enter username" required>
        <label for="password">Password</label>
        <input type="password" name="password" placeholder="Enter password" required>
        <input class="submit" type="submit" value="Submit">
    </form>
</main>
<?php include "./templates/footer.php"; ?>