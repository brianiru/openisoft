<?php
// if session is not set start session
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
}
/* echo "<pre>";
print_r($_SESSION);
echo "</pre>"; */
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "head.php"; ?>
    <title>Profile - Garbage collection system</title>
</head>

<body>
    <!-- header -->
    <?php include "header.php"; ?>
    <div class="admin-container">

        <div class="left">
            <?php include "sidebar.php"; ?>
        </div>
        <div class="right">
            <!-- requests -->
            <div class="requests">
                <h3>Profile settings</h3>
                <div class="profile">
                    <?php
                    include "../dbh.php";
                    // get user id from session
                    $user_id = $_SESSION['user_id'];
                    // query to get user details
                    $sql = "SELECT * FROM admins WHERE id = '$user_id'";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $name = $row['name'];
                    $email = $row['email'];
                    $username = $row['username'];
                    $image = $row['image'];
                    if ($image == "") {
                        $image = "default_profile.jpg";
                    }
                    ?>
                    <!-- form for profile settings -->
                    <form action="../reg_exe.php" method="post">
                        <!-- name -->
                        <div class="form-control">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" placeholder="Your name" value="<?php echo $name; ?>">
                        </div>
                        <!-- email -->
                        <div class="form-control">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" placeholder="Your email" value="<?php echo $email; ?>">
                        </div>
                        <!-- username -->
                        <div class="form-control">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" placeholder="Your username" value="<?php echo $username; ?>" readonly>
                        </div>
                        <!-- password -->
                        <div class="form-control">
                            <label for="password">Current Password</label>
                            <input type="password" name="password" id="password" placeholder="Driver's password">
                        </div>
                        <!-- new password -->
                        <div class="form-control">
                            <label for="new-password">New password</label>
                            <input type="password" name="new-password" id="new-password" placeholder="Driver's new password">
                        </div>
                        <!-- confirm new password -->
                        <div class="form-control">
                            <label for="confirm-new-password">Confirm new password</label>
                            <input type="password" name="confirm-new-password" id="confirm-new-password" placeholder="Driver's new password">
                        </div>
                        <!-- image -->
                        <div class="preview">
                            <img id="profile_pic_preview" src="../resources/images/<?php echo $image; ?>">
                        </div>
                        <div class="form-control">
                            <label for="image">Image</label>
                            <input type="file" name="image" id="image" onchange="showPreview(event);">
                        </div>
                        <!-- submit -->
                        <div class="form-control profile-rqst">
                            <input type="submit" name="update" value="Update" class="btn btn-primary update-profile-admin">
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>


    <script src="../js/index.js"></script>
</body>

</html>