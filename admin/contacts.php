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
    <title>Contacts - Garbage collection system</title>
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
                <h3>Contact messages</h3>
                <div class="requests-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Message</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // include database connection
                            include "../dbh.php";
                            // select all from requests
                            $query = "SELECT * FROM contacts";
                            $result = mysqli_query($conn, $query);
                            // if there are requests
                            if (mysqli_num_rows($result) > 0) {
                                // fetch requests
                                while ($row = mysqli_fetch_assoc($result)) {
                                    // echo "<pre>";
                                    // print_r($row);
                                    // echo "</pre>";
                                    // get request id
                                    $id = $row['id'];
                                    // get name
                                    $name = $row['name'];
                                    // get email
                                    $email = $row['email'];
                                    // get message
                                    $message = $row['message'];
                                    // display requests
                                    echo "<tr>
                                            <td>$id</td>
                                            <td>$name</td>
                                            <td>$email</td>
                                            <td>$message</td>
                                            <td>
                                            <a href='reply.php?id=$id&table=contacts' data-id='$id' class='btn btn-success reply-contact'>Reply</a>
                                                <a href='#' class='btn btn-danger delete'>Delete</a>
                                            </td>
                                        </tr>
                                    ";
                                }
                            } else {
                                echo "<tr>
                                        <td colspan='7'>No messages</td>
                                    </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    <div class="modal" id="reply-to-contact">
        <div class="modal-header">
            <h3>Reply to a contact</h3>
        </div>
        <div class="modal-body" id="request-contact-data">
            <form action="../reg_exe.php" method="post">
                <div class="form-control">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" value="<?php echo $name; ?>" disabled>
                </div>
                <div class="form-control">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" value="<?php echo $email; ?>" disabled>
                </div>
                <div class="form-control">
                    <label for="message">Message</label>
                    <textarea name="message" id="message" cols="30" rows="10" disabled><?php echo $message; ?></textarea>
                </div>
                <div class="form-control">
                    <label for="reply">Reply</label>
                    <textarea name="reply" id="reply" cols="30" rows="10"></textarea>
                </div>
                <div class="form-control">
                    <input type="submit" name="reply-contact" value="Reply" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>


    <script src="../js/index.js"></script>
    <script>
        $('.reply-contact').click(function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            $('#reply-to-contact').modal('show');
            // clear modal
            $('#request-contact-data').html('');
            $.ajax({
                url: '../reg_exe.php',
                type: 'POST',
                data: {
                    id: id,
                    request_contact_data: 'contacts'
                },
                success: function(data) {
                    $('#request-contact-data').html(data);
                }
            });
        });
    </script>
</body>

</html>