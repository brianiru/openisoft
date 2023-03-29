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
                    <h1>Garbage collection system: Drivers</h1>
                </div>
                <!-- drivers -->
                <div class="drivers">
                    <!-- header -->
                    <div class="drivers-header">
                        <h3>Drivers</h3>
                        <a href="#add-driver" rel="modal:open" class="btn btn-primary">Add driver</a>
                        <?php
                        // if session message is set
                        if (isset($_SESSION['message'])) {
                            // get session message
                            $message = $_SESSION['message'];
                            // display session message
                            echo "<p class='message success'>$message</p>";
                            // unset session message
                            unset($_SESSION['message']);
                        }
                        ?>
                    </div>
                    <!-- table -->
                    <div class="drivers-table" id="driver-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Driver ID</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>License</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // include database connection
                                include "../dbh.php";
                                // select all drivers
                                $sql = "SELECT * FROM drivers";
                                $result = mysqli_query($conn, $sql);
                                // if there are drivers
                                if (mysqli_num_rows($result) > 0) {
                                    // loop through drivers
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        // get driver id
                                        $driver_id = $row['id'];
                                        // get driver name
                                        $driver_name = $row['name'];
                                        // get driver phone
                                        $driver_phone = $row['phone'];
                                        // get driver address
                                        $driver_address = $row['address'];
                                        // get driver license
                                        $driver_license = $row['license'];
                                        // display driver
                                        echo "
                                        <tr>
                                            <td>$driver_id</td>
                                            <td>$driver_name</td>
                                            <td>$driver_phone</td>
                                            <td>$driver_address</td>
                                            <td>$driver_license</td>
                                            <td> 
                                                <button class='btn btn-primary edit-driver-btn' id='$driver_id'>Edit</button>
                                                <button class='btn btn-danger delete-driver' id='$driver_id'>Delete</button>
                                                <button class='btn btn-primary send-login-details' id='$driver_id'>Send login details</button>
                                            </td>
                                        </tr>
                                        ";
                                    }
                                } else {
                                    echo "
                                    <tr>
                                        <td colspan='6'>No drivers found</td>
                                    </tr>
                                    ";
                                }
                                ?>
                                <!-- <tr>
                                    <td>1</td>
                                    <td>John Doe</td>
                                    <td>1234567890</td>
                                    <td>123, abc street, xyz city</td>
                                    <td>1234567890</td>
                                    <td>
                                        <button class="btn btn-primary">Edit</button>
                                        <button class="btn btn-danger">Delete</button>
                                    </td>
                                </tr> -->

                            </tbody>
                        </table>
                    </div>
                    <!-- nw -->
                </div>
            </div>
        </div>
        <!-- add-driver modal -->
        <div class="modal" id="add-driver">
            <div class="modal-header">
                <h3>Add driver</h3>
            </div>
            <div class="modal-body">
                <form action="/reg_exe.php" method="POST">
                    <!-- name -->
                    <div class="form-control">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" placeholder="Driver's name">
                    </div>
                    <!-- national id -->
                    <div class="form-control">
                        <label for="national_id">National ID</label>
                        <input type="text" name="national_id" id="national_id" placeholder="Driver's national ID">
                    </div>
                    <!-- email -->
                    <div class="form-control">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" placeholder="Driver's email">
                    </div>
                    <!-- phone -->
                    <div class="form-control">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" id="phone" placeholder="Driver's phone">
                    </div>
                    <!-- address -->
                    <div class="form-control">
                        <label for="address">Address</label>
                        <input type="text" name="address" id="address" placeholder="Driver's address">
                    </div>
                    <!-- license -->
                    <div class="form-control">
                        <label for="license">License</label>
                        <input type="text" name="license" id="license" placeholder="Driver's license">
                    </div>
                    <!-- submit -->
                    <div class="form-control add-driver-rqst">
                        <button type="submit" name="submit" class="btn btn-primary" id="add-driver-rqst">Add driver</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <!-- <p>Modal Footer</p> -->
            </div>
        </div>
        <!-- edit driver modal -->
        <div class="modal" id="edit-driver">
            <div class="modal-header">
                <h3>Edit driver</h3>
            </div>
            <div class="modal-body">
                <form action="../reg_exe.php" method="POST" id="edit-driver-data">

                </form>
            </div>
            <div class="modal-footer">
                <!-- <p>Modal Footer</p> -->
            </div>
        </div>
        <script src="../js/index.js?<?php echo rand(); ?>"></script>

</body>

</html>