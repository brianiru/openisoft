<?php
// if session is not set start session
if (!isset($_SESSION)) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "head.php"; ?>
    <title>Admin - register - Garbage collection system</title>
</head>

<body>
    <!-- header -->
    <?php include "header.php"; ?>
    <div class="admin-container">
        <!-- register page -->
        <form action="../reg_exe.php" method="post">
            <div class="form-control">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" placeholder="Enter your name">
            </div>
            <div class="form-control">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Enter your email">
            </div>
            <!-- username -->
            <div class="form-control">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" placeholder="Enter your username">
            </div>
            <!-- <div class="form-control">
                <label for="phone">Phone</label>
                <input type="text" name="phone" id="phone" placeholder="Enter your phone">
            </div>
            <div class="form-control">
                <label for="address">Address</label>
                <input type="text" name="address" id="address" placeholder="Enter your address">
            </div> -->
            <div class="form-control">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Enter your password">
            </div>
            <div class="form-control">
                <label for="confirm-password">Confirm password</label>
                <input type="password" name="confirm-password" id="confirm-password" placeholder="Confirm your password">
            </div>
            <div class="form-control register">
                <button type="submit" name="submit" class="btn btn-primary" id="register">Register</button>
            </div>
        </form>
    </div>


    <script src="../js/index.js"></script>
</body>

</html>