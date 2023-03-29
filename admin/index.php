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
    <title>Admin - Garbage collection system</title>
</head>

<body>
    <!-- header -->
    <?php include "header.php"; ?>
    <div class="admin-container">

        <div class="left">
            <?php include "sidebar.php"; ?>
        </div>
        <div class="right">
            <div class="requests">
                <div class="request-header">
                    <h1>Garbage collection system: Dashboard</h1>
                </div>
                <!-- dashboard cards -->
                <div class="cards">
                    <div class="card-single">
                        <div class="card-single-head">
                            <?php
                            include "../dbh.php";
                            $sql = "SELECT * FROM requests";
                            $result = mysqli_query($conn, $sql);
                            $requests = mysqli_num_rows($result);
                            ?>
                            <h4>Requests</h4>
                            <span><?php echo $requests; ?></span>
                        </div>
                        <div class="card-single-footer">
                            <span class="las la-clipboard-list"></span>
                        </div>
                    </div>
                    <!-- nw -->
                    <div class="card-single">
                        <div class="card-single-head">
                            <?php
                            $sql2 = "SELECT * FROM drivers";
                            $result2 = mysqli_query($conn, $sql2);
                            $drivers = mysqli_num_rows($result2);
                            ?>
                            <h4>Drivers</h4>
                            <span><?php echo $drivers; ?></span>
                        </div>
                        <div class="card-single-footer">
                            <span class="las la-clipboard-list"></span>
                        </div>
                    </div>
                    <!-- nw -->
                    <div class="card-single">
                        <div class="card-single-head">
                            <?php
                            $sql4 = "SELECT * FROM requests WHERE status = 'accepted'";
                            $result4 = mysqli_query($conn, $sql4);
                            $accepted = mysqli_num_rows($result4);
                            ?>
                            <h4>Confirmed requests</h4>
                            <span><?php echo $accepted; ?></span>
                        </div>
                        <div class="card-single-footer">
                            <span class="las la-clipboard-list"></span>
                        </div>
                    </div>
                    <!-- nw -->
                    <div class="card-single">
                        <div class="card-single-head">
                            <?php
                            $sql3 = "SELECT * FROM ratings";
                            $result3 = mysqli_query($conn, $sql3);
                            $ratings = mysqli_num_rows($result3);
                            ?>
                            <h4>Ratings</h4>
                            <span><?php echo $ratings ?></span>
                        </div>
                        <div class="card-single-footer">
                            <span class="las la-clipboard-list"></span>
                        </div>
                    </div>
                    <!-- nw -->
                    <div class="card-single">
                        <div class="card-single-head">
                            <?php
                            $sql5 = "SELECT * FROM contacts";
                            $result5 = mysqli_query($conn, $sql5);
                            $contacts = mysqli_num_rows($result5);
                            ?>
                            <h4>Contacts</h4>
                            <span><?php echo $contacts; ?></span>
                        </div>
                        <div class="card-single-footer">
                            <span class="las la-clipboard-list"></span>
                        </div>
                    </div>
                    <!-- nw -->
                    <div class="card-single">
                        <div class="card-single-head">
                            <?php
                            $sql6 = "SELECT * FROM requests WHERE status = 'cancelled'";
                            $result6 = mysqli_query($conn, $sql6);
                            $cancelled = mysqli_num_rows($result6);
                            ?>
                            <h4>Cancelled requests</h4>
                            <span><?php echo $cancelled; ?></span>
                        </div>
                        <div class="card-single-footer">
                            <span class="las la-clipboard-list"></span>
                        </div>
                    </div>
                    <!-- nw -->

                </div>
            </div>
        </div>

        <!-- request modal -->
        <div class="modal" id="request">
            <div class="modal-header">
                <h3>Request garbage collection</h3>
            </div>
            <div class="modal-body">
                <form action="/reg_exe.php" method="POST">
                    <!-- name -->
                    <div class="form-control">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" placeholder="Enter your name">
                    </div>
                    <!-- email -->
                    <div class="form-control">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" placeholder="Enter your email">
                    </div>
                    <!-- phone -->
                    <div class="form-control">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" id="phone" placeholder="Enter your phone">
                    </div>
                    <!-- address -->
                    <div class="form-control">
                        <label for="address">Address</label>
                        <input type="text" name="address" id="address" placeholder="Enter your address">
                        <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d8171113.99594693!2d33.4087042871386!3d0.16510130764820577!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182780d08350900f%3A0x403b0eb0a1976dd9!2sKenya!5e0!3m2!1sen!2ske!4v1678802809823!5m2!1sen!2ske" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> -->
                    </div>
                    <!-- date of garbage request -->
                    <div class="form-control">
                        <label for="date">Date</label>
                        <input type="date" name="date" id="date" placeholder="Enter date">
                    </div>
                    <!-- submit -->
                    <div class="form-control snd-rqst">
                        <button type="submit" name="submit" class="btn btn-primary" id="send-request">Send request</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <!-- <p>Modal Footer</p> -->
            </div>
        </div>
        <script src="../js/index.js"></script>

</body>

</html>