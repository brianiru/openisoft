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
    <title>Requests - Garbage collection system</title>
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
                <h3>Users ratings</h3>
                <div class="requests-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Rating ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Rating</th>
                                <th>Message</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // include database connection
                            include "../dbh.php";
                            // select all requests
                            $sql = "SELECT * FROM ratings";
                            $result = mysqli_query($conn, $sql);
                            // if there are requests
                            if (mysqli_num_rows($result) > 0) {
                                // fetch requests
                                while ($row = mysqli_fetch_assoc($result)) {
                                    // echo "<pre>";
                                    // print_r($row);
                                    // echo "</pre>";
                                    // get the request id
                                    $rating_id = $row['id'];
                                    // get the request name
                                    $name = $row['name'];
                                    // get the request email
                                    $email = $row['email'];
                                    // get the request rating
                                    $rating = $row['rating'];
                                    // get the request message
                                    $message = $row['message'];
                                    // trim message to 2 words if it is more than 2 words then add ...
                                    $message = (strlen($message) > 20) ? substr($message, 0, 20) . "..." : $message;
                                    // get the request date
                                    $date = $row['created_at'];
                                    // display the request
                                    echo "<tr>
                                        <td>#$rating_id</td>
                                        <td>$name</td>
                                        <td>$email</td>
                                        <td class='star-display'>$rating</td>
                                        <td>$message</td>
                                        <td>$date</td>
                                        <td>
                                            <button class='view btn btn-success request-rating-data' data-id='$rating_id'>Reply</button>
                                        </td>
                                    </tr>";
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- nw -->
                <!-- change a number eg 3 to stars out of 5-->

            </div>
        </div>
    </div>

    <!-- request-view modal-->
    <div class="modal" id="request">
        <div class="modal-header">
            <h3>View Request</h3>
        </div>
        <div class="modal-body" id="request-view-data">

        </div>
    </div>
    <!-- rating reply modal -->
    <div class="modal" id="reply-rating">
        <div class="modal-header">
            <h3>Reply to a rating</h3>
        </div>
        <div class="modal-body" id="reply-rating-data">

        </div>
    </div>
    <script src="../js/index.js"></script>
    <script>
        // document ready
        $(document).ready(function() {
            // Get all star elements
            const stars = document.querySelectorAll('.star-display');

            // Add click event listener to each star
            stars.forEach((star) => {

                // Get the rating value (e.g. 3)
                const ratingValue = star.innerHTML;

                // Create the HTML for the stars
                let starsHtml = '';
                for (let i = 1; i <= 5; i++) {
                    if (i <= ratingValue) {
                        starsHtml += '<span class="star active-star"></span>';
                    } else {
                        starsHtml += '<span class="star"></span>';
                    }
                }

                // Add the stars to the container element
                star.innerHTML = starsHtml;
            });
        });
    </script>
</body>

</html>