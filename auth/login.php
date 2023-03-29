<?php
// if session is not set start session
if (!isset($_SESSION)) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "../admin/head.php"; ?>
    <!-- icon -->
    <link rel="icon" href="../resources/images/garbage-icon.png">
    <link rel="stylesheet" href="../css/style.css?v=<?php echo rand(); ?>">
    <title>Driver login - Garbage collection system</title>
</head>

<body>
    <div class="admin-container">
        <!-- login modal -->
        <div class="login-div">
            <h3>Login to Garbage collection system</h3>
            <form action="../reg_exe.php" method="post">
                <!-- username -->
                <div class="form-control">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" placeholder="Enter your username">
                </div>
                <!-- password -->
                <div class="form-control">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Enter your password">
                    <input type="hidden" name="driver" value="driver" id="driver">
                </div>
                <div class="form-control login">
                    <button type="submit" name="submit" class="btn btn-primary" id="login">Login</button>
                </div>

            </form>
        </div>
    </div>
    <script src="../js/index.js"></script>
</body>

</html>