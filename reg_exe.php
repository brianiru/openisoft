<?php
// if session is not set start session
if (!isset($_SESSION)) {
    session_start();
}

include "dbh.php";

if (isset($_POST['send-request'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];
    $address = $_POST['address'];
    $date = $_POST['date'];
    $errors = [];
    if (empty($name)) {
        $errors['name'] = "Name field is required";
    }
    if (empty($email)) {
        $errors['email'] = "Email field is required";
    }
    if (empty($phone)) {
        $errors['phone'] = "Phone field is required";
    }
    if (empty($address)) {
        $errors['address'] = "Address field is required";
    }
    if (empty($message)) {
        $errors['message'] = "Message field is required";
    }
    if (empty($date)) {
        $errors['date'] = "Date field is required";
    }

    if (count($errors) > 0) {
        foreach ($errors as $key => $value) {
            echo "<h5 style='color: red;'>$value</h5>";
        }
    } else {
        $sql = "INSERT INTO requests (name, email, phone, address, message, status, date) VALUES ('$name', '$email', '$phone', '$address', '$message', 'pending', '$date')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo "success";
        } else {
            echo "Request failed" . mysqli_error($conn);
        }
    }
}
// register
if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];
    $errors = [];
    if (empty($name)) {
        $errors['name'] = "Name field is required";
    }
    if (empty($email)) {
        $errors['email'] = "Email field is required";
    }
    if (empty($username)) {
        $errors['username'] = "Username field is required";
    }
    if (empty($password)) {
        $errors['password'] = "Password field is required";
    }
    if (empty($confirm_password)) {
        $errors['confirm-password'] = "Confirm password field is required";
    }
    if ($password != $confirm_password) {
        $errors['password'] = "Passwords does not match";
    }
    if (count($errors) > 0) {
        foreach ($errors as $key => $value) {
            echo "<h5 style='color: red;'>$value</h5>";
        }
    } else {
        // check if username exists
        $sql_username = "SELECT * FROM admins WHERE username = '$username'";
        $result_username = mysqli_query($conn, $sql_username);
        if (mysqli_num_rows($result_username) > 0) {
            echo "<h5 style='color: red;'>Username already taken</h5>";
            exit();
        } else {
            $sql = "INSERT INTO admins (name, email, username, password) VALUES ('$name', '$email', '$username', '$password')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo "success";
            } else {
                echo "Registration failed" . mysqli_error($conn);
            }
        }
    }
}

// login
if (isset($_POST['login'])) {
    if (isset($_POST['driver']) and $_POST['driver'] == "driver") {
        $url = "../driver.php";
        $username = $_POST['username'];
        $password = $_POST['password'];

        $errors = [];
        if (empty($username)) {
            $errors['username'] = "Username field is required";
        }
        if (empty($password)) {
            $errors['password'] = "Password field is required";
        }
        if (count($errors) > 0) {
            foreach ($errors as $key => $value) {
                echo "<h5 style='color: red;'>$value</h5>";
            }
        } else {
            $sql = "SELECT * FROM drivers WHERE email = '$username' AND national_id = '$password'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $_SESSION['user_id'] = $row['id'];
                echo "success";
                echo $url;
                // pretty dump session
                /* echo "<pre>";
            print_r($_SESSION);
            echo "</pre>";*/
            } else {
                echo "Login failed" . mysqli_error($conn);
            }
        }
    } else {
        $url = "index.php";
        $username = $_POST['username'];
        $password = $_POST['password'];

        $errors = [];
        if (empty($username)) {
            $errors['username'] = "Username field is required";
        }
        if (empty($password)) {
            $errors['password'] = "Password field is required";
        }
        if (count($errors) > 0) {
            foreach ($errors as $key => $value) {
                echo "<h5 style='color: red;'>$value</h5>";
            }
        } else {
            $sql = "SELECT * FROM admins WHERE username = '$username' AND password = '$password'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $_SESSION['user_id'] = $row['id'];
                echo "success";
                echo $url;
                // pretty dump session
                /* echo "<pre>";
            print_r($_SESSION);
            echo "</pre>";*/
            } else {
                echo "Login failed" . mysqli_error($conn);
            }
        }
    }
}

// request-view-data
if (isset($_POST['request-view'])) {
    $id = $_POST['id'];
    $sql = "SELECT * FROM requests WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) { ?>

            <form action="/reg_exe.php" method="POST">
                <!-- name -->
                <div class="form-control">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" placeholder="Enter your name" readonly value="<?php echo $row['name'] ?>">
                </div>
                <!-- email -->
                <div class="form-control">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="Enter your email" readonly value="<?php echo $row['email'] ?>">
                </div>
                <!-- phone -->
                <div class="form-control">
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" id="phone" placeholder="Enter your phone" readonly value="<?php echo $row['phone'] ?>">
                </div>
                <!-- address -->
                <div class="form-control">
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" placeholder="Enter your address" readonly value="<?php echo $row['address'] ?>">
                </div>
                <!-- message -->
                <div class="form-control">
                    <label for="message">Message</label>
                    <textarea name="message" id="message" cols="30" rows="5" placeholder="Enter your message" readonly value="<?php echo $row['message'] ?>"></textarea>
                </div>
                <!-- date of garbage request -->
                <div class="form-control">
                    <label for="date">Date</label>
                    <input type="date" name="date" id="date" placeholder="Enter date" readonly value="<?php echo $row['date'] ?>">
                </div>
            </form>

        <?php }
    }
}

// rate-us
if (isset($_POST['rate-us'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $rating = $_POST['rating'];
    $message = $_POST['message'];
    $errors = [];
    if (empty($name)) {
        $errors['name'] = "Name field is required";
    }
    if (empty($email)) {
        $errors['email'] = "Email field is required";
    }
    if (empty($rating)) {
        $errors['rating'] = "Rating field is required";
    }
    if (empty($message)) {
        $errors['message'] = "Message field is required";
    }
    if (count($errors) > 0) {
        foreach ($errors as $key => $value) {
            echo "<h5 style='color: red;'>$value</h5>";
        }
    } else {
        $sql = "INSERT INTO ratings (name, email, rating, message) VALUES ('$name', '$email', '$rating', '$message')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo "success";
        } else {
            echo "Request failed" . mysqli_error($conn);
        }
    }
}

// add-driver-rqst
if (isset($_POST['add-driver-rqst'])) {
    $name = $_POST['name'];
    $national_id = $_POST['national_id'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $license = $_POST['license'];
    $errors = [];
    if (empty($name)) {
        $errors['name'] = "Name field is required";
    }
    if (empty($national_id)) {
        $errors['national_id'] = "National ID field is required";
    }
    if (empty($email)) {
        $errors['email'] = "Email field is required";
    }
    if (empty($phone)) {
        $errors['phone'] = "Phone field is required";
    }
    if (empty($address)) {
        $errors['address'] = "Address field is required";
    }
    if (empty($license)) {
        $errors['license'] = "License field is required";
    }
    if (count($errors) > 0) {
        foreach ($errors as $key => $value) {
            echo "<h5 style='color: red;'>$value</h5>";
        }
    } else {
        $sql = "INSERT INTO drivers (name, national_id, email, phone, address, license) VALUES ('$name', '$national_id', '$email', '$phone', '$address', '$license')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo "success";
        } else {
            echo "Request failed" . mysqli_error($conn);
        }
    }
}

//  edit-driver-view
if (isset($_POST['edit-driver-view'])) {
    $id = $_POST['id'];
    $sql = "SELECT * FROM drivers WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) { ?>
            <!-- name -->
            <div class="form-control">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" placeholder="Enter your name" value="<?php echo $row['name'] ?>">
            </div>
            <!-- national id -->
            <div class="form-control">
                <label for="national_id">National ID</label>
                <input type="text" name="national_id" id="national_id" placeholder="Enter your national id" value="<?php echo $row['national_id'] ?>">
            </div>
            <!-- email -->
            <div class="form-control">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Enter your email" value="<?php echo $row['email'] ?>">
            </div>
            <!-- phone -->
            <div class="form-control">
                <label for="phone">Phone</label>
                <input type="text" name="phone" id="phone" placeholder="Enter your phone" value="<?php echo $row['phone'] ?>">
            </div>
            <!-- address -->
            <div class="form-control">
                <label for="address">Address</label>
                <input type="text" name="address" id="address" placeholder="Enter your address" value="<?php echo $row['address'] ?>">
            </div>
            <!-- license -->
            <div class="form-control">
                <label for="license">License</label>
                <input type="text" name="license" id="license" placeholder="Enter your license" value="<?php echo $row['license'] ?>">
            </div>
            <!-- hidden id -->
            <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
            <!-- submit -->
            <div class="form-control edit-driver-rqst">
                <button type="submit" name="edit-driver" class="btn btn-primary edit-driver-view">Edit driver</button>
            </div>
        <?php
        }
    }
}
//  edit-driver
if (isset($_POST['edit-driver'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $national_id = $_POST['national_id'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $license = $_POST['license'];
    $errors = [];
    if (empty($name)) {
        $errors['name'] = "Name field is required";
    }
    if (empty($national_id)) {
        $errors['national_id'] = "National ID field is required";
    }
    if (empty($email)) {
        $errors['email'] = "Email field is required";
    }
    if (empty($phone)) {
        $errors['phone'] = "Phone field is required";
    }
    if (empty($address)) {
        $errors['address'] = "Address field is required";
    }
    if (empty($license)) {
        $errors['license'] = "License field is required";
    }
    if (count($errors) > 0) {
        foreach ($errors as $key => $value) {
            echo "<h5 style='color: red;'>$value</h5>";
        }
    } else {
        $sql = "UPDATE drivers SET name = '$name', national_id = '$national_id', email = '$email', phone = '$phone', address = '$address', license = '$license' WHERE id = '$id'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            // redirect to drivers page with success message
            $_SESSION['message'] = "Driver updated successfully";
            $_SESSION['type'] = "success";
            // header("Location: admin/drivers.php");
            // redirect using javascript
            echo "<script>window.location.href = 'admin/drivers.php'</script>";
        } else {
            echo "Request failed" . mysqli_error($conn);
        }
    }
}

// delete-driver
if (isset($_POST['delete-driver'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM drivers WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "success";
    } else {
        echo "Request failed" . mysqli_error($conn);
    }
}

// request-reply-view
if (isset($_POST['request-reply-view'])) {
    $id = $_POST['id'];
    $sql = "SELECT * FROM requests WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) { ?>
            <!-- compose an email to send to user's email -->
            <div class="form-control">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Enter your email" value="<?php echo $row['email'] ?>">
            </div>
            <!-- subject -->
            <div class="form-control">
                <label for="subject">Subject</label>
                <input type="text" name="subject" id="subject" placeholder="Enter your subject" value="">
            </div>
            <!-- message -->
            <div class="form-control">
                <label for="message">Message</label>
                <textarea name="message" id="message" cols="30" rows="10" placeholder="Enter your message"></textarea>
            </div>
            <!-- hidden id -->
            <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
            <!-- submit -->
            <div class="form-control request-reply-rqst">
                <button type="submit" name="request-reply" class="btn btn-primary request-reply-view">Reply</button>
            </div>

        <?php
        }
    }
}
// request-reply
if (isset($_POST['request-reply'])) {
    $id = $_POST['id'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $errors = [];
    if (empty($email)) {
        $errors['email'] = "Email field is required";
    }
    if (empty($subject)) {
        $errors['subject'] = "Subject field is required";
    }
    if (empty($message)) {
        $errors['message'] = "Message field is required";
    }
    if (count($errors) > 0) {
        /* foreach ($errors as $key => $value) {
            echo "<h5 style='color: red;'>$value</h5>";
        } */
        // redirect to requests page with error message
        $_SESSION['errors'] = $errors;
        // header("Location: admin/requests.php");
        // redirect using javascript
        echo "<script>window.location.href = 'admin/requests.php';</script>";
    } else {
        // send email to user
        $to = $email;
        $subject = $subject;
        $message = $message;
        $headers = "From: shakingmachine@rs3.rcnoc.com";
        if (mail($to, $subject, $message, $headers)) {
            // redirect to requests page with success message
            $_SESSION['message'] = "Email sent successfully";
            $_SESSION['type'] = "success";
            // header("Location: admin/requests.php");
            // redirect using javascript
            echo "<script>window.location.href = 'admin/requests.php';</script>";
        } else {
            echo "Request failed" . mysqli_error($conn);
        }
    }
}

// contact
if (isset($_POST['contact'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $errors = [];
    if (empty($name)) {
        $errors['name'] = "Name field is required";
    }
    if (empty($email)) {
        $errors['email'] = "Email field is required";
    }
    if (empty($message)) {
        $errors['message'] = "Message field is required";
    }
    if (count($errors) > 0) {
        foreach ($errors as $key => $value) {
            echo "<h5 style='color: red;'>$value</h5>";
        }
    } else {
        // insert into database
        $sql = "INSERT INTO contacts (name, email, message) VALUES ('$name', '$email', '$message')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo "success";
            // send email to admin
            $to = "josephjuma2509@gmail.com";
            $subject = "Contact form";
            $message = "Name: $name \nEmail: $email \nMessage: $message";
            $headers = "From: shakingmachine@rs3.rcnoc.com";
            mail($to, $subject, $message, $headers);
            // send email to user
            $to = $email;
            $subject = "Message received";
            $message = "Thank you for contacting us. We will get back to you shortly.";
            $headers = "From: shakingmachine@rs3.rcnoc.com";
            mail($to, $subject, $message, $headers);
        } else {
            echo "Request failed" . mysqli_error($conn);
        }
    }
}

// send-login-details
if (isset($_POST['send-login-details'])) {
    $id = $_POST['id'];
    $sql = "SELECT * FROM drivers WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $email = $row['email'];
            $password = $row['national_id'];
            // send email to user
            $to = $email;
            $subject = "Login details";
            $message = "Your login details are: \nEmail: $email \nPassword: $password";
            $headers = "From: shakingmachine@rs3.rcnoc.com";
            // send to admin the driver's details
            $to_admin = "josephjuma2509@gmail.com";
            $subject_admin = "Driver details";
            $message_admin = "Driver's details: \nName: " . $row['name'] . " \nEmail: $email \nPassword: $password";
            $headers_admin = "From: shakingmachine@rs3.rcnoc.com";
            mail($to_admin, $subject_admin, $message_admin, $headers_admin);
            if (mail($to, $subject, $message, $headers)) {
                echo "success";
            } else {
                echo "Request failed" . mysqli_error($conn);
            }
        }
    } else {
        echo "Request failed" . mysqli_error($conn);
    }
}

// request-rating-view
if (isset($_POST['request-rating-view'])) {
    $id = $_POST['id'];
    $sql = "SELECT * FROM ratings WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $name = $row['name'];
            $email = $row['email'];
            $message = $row['message'];
        ?>
            <!-- compose an email to send to user's email -->
            <form action="../reg_exe.php" method="post">
                <div class="form-control">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" placeholder="Enter your name" value="<?php echo $name ?>" readonly>
                </div>
                <!-- email -->
                <div class="form-control">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="Enter your email" value="<?php echo $email ?>" readonly>
                </div>
                <!-- message -->
                <div class="form-control">
                    <label for="message">Message</label>
                    <textarea name="message" id="message" cols="30" rows="10" placeholder="Enter your message" readonly><?php echo $message ?></textarea>
                </div>
                <!-- your reply -->
                <div class="form-control">
                    <label for="reply">Your reply</label>
                    <textarea name="reply" id="reply" cols="30" rows="10" placeholder="Enter your reply"></textarea>
                </div>
                <!-- hidden id -->
                <input type="hidden" name="id" value="<?php echo $id ?>">
                <!-- submit -->
                <div class="form-control request-reply-rqst">
                    <button type="submit" name="rating-reply" class="btn btn-primary request-reply-view">Reply</button>
                </div>
            </form>

    <?php
        }
    }
}
// rating-reply
if (isset($_POST['rating-reply'])) {
    $id = $_POST['id'];
    $reply = $_POST['reply'];
    // get name, email and message
    $sql = "SELECT * FROM ratings WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $name = $row['name'];
            $email = $row['email'];
            $message = $row['message'];
        }
        $errors = [];
        if (empty($reply)) {
            $errors['reply'] = "Reply field is required";
        }
        if (count($errors) > 0) {
            // display errors
            foreach ($errors as $key => $value) {
                echo "<h5 style='color: red;'>$value</h5>";
            }
            echo "this page will redirect in 3 seconds" . "<br>";
            echo "If it doesn't redirect, click <a href='admin/ratings.php'>here</a>";
            // redirect after 3 seconds using javascript
            echo "<script>setTimeout(() => {
                window.location.href = 'admin/ratings.php';
            }, 3000);</script>";
        } else {
            // send email to user
            $to = $email;
            $subject = "Reply to your rating";
            $message = "Your rating: \nName: $name \nEmail: $email \nMessage: $message \n\nReply: $reply";
            $headers = "From: shakingmachine@rs3.rcnoc.com";
            if (mail($to, $subject, $message, $headers)) {
                echo "success";
            } else {
                echo "Request failed" . mysqli_error($conn) . "<br>";
                echo "this page will redirect in 3 seconds" . "<br>";
                echo "If it doesn't redirect, click <a href='admin/ratings.php'>here</a>";
                // redirect after 3 seconds using javascript
                echo "<script>setTimeout(() => {
                    window.location.href = 'admin/ratings.php';
                }, 3000);</script>";
            }
        }
    } else {
        echo "Request failed" . mysqli_error($conn);
    }
}

// request_id
if (isset($_POST['request_id'])) {
    $id = $_POST['request_id'];
    $sql = "SELECT * FROM requests WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $request_id = $row['id'];
    $request_name = $row['name'];
    $request_email = $row['email'];
    $request_phone = $row['phone'];
    $request_address = $row['address'];
    $request_date = $row['date'];
    $request_message = $row['message'];

    echo '
        <!-- name -->
        <h5><b>Name:</b> ' . $request_name . '</h5>
        <!-- message -->
        <h5><b>Message:</b> ' . $request_message . '</h5>
        <!-- date -->
        <h5><b>Date:</b> ' . $request_date . '</h5>
        <!-- address -->
        <h5><b>Address:</b> <span class="driver-copy" title="Click to copy" style="cursor: pointer;"
        >' . $request_address . '</span></h5>
        <!-- hint user to copy address and paste in google maps to see the location -->
        <h6><b>Hint:</b> Copy the address and paste it in <a href="https://maps.google.com/" style="color: blue;" target="_blank">google maps</a> to see the location</h6>
        <form action="../reg_exe.php" method="post">
            <input type="hidden" name="request_id" value="' . $request_id . '">
            <button type="submit" name="accept-request" data-id="' . $request_id . '" class="btn btn-primary accept-request">Accept this request</button>
        </form>
        <script>
        // accept-request
        $(".accept-request").click(function () {
            event.preventDefault();
            $id = $(this).attr("data-id");
            // ajax request
            var formData = new FormData();
            formData.append("request_id", $id);
            formData.append("accept-request", true);
            $.ajax({
                url: "reg_exe.php",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function (data) {
                    if (data.includes("success")) {
                        // swal fire success
                        swal.fire({
                            title: "Success",
                            text: "Request accepted successfully!",
                            icon: "success",
                            button: "OK",
                        }).then(function () {
                            // reload page
                            location.reload();
                        });
                    } else {
                        // swal fire error
                        swal.fire({
                            title: "Error",
                            html: data,
                            icon: "error",
                            button: "OK",
                        })
                    }
                }
            });
        });
        </script>

    ';
}
// accept-request
if (isset($_POST['accept-request'])) {
    $uid = $_SESSION['user_id'];
    $request_id = $_POST['request_id'];
    // update request status to accepted and add driver id
    $sql = "UPDATE requests SET status = 'accepted', driver = '$uid' WHERE id = '$request_id'";
    if (mysqli_query($conn, $sql)) {
        echo "success";
    } else {
        echo "Request failed" . mysqli_error($conn);
    }
}

// update-profile-admin
if (isset($_POST['update-profile-admin'])) {
    $id = $_SESSION['user_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $new_password = $_POST['new-password'];
    $confirm_new_password = $_POST['confirm-new-password'];
    $temp = $_POST['temp'];
    if ($temp === "no_image") {
        $image = '';
    } else {
        $image = $_FILES['image']['name'];
    }
    $errors = [];
    if (empty($name)) {
        $errors['name'] = "Name field is required";
    }
    if (empty($email)) {
        $errors['email'] = "Email field is required";
    }
    // get current user password
    $sql = "SELECT * FROM admins WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $current_password = $row['password'];
    // if all 3 password fields exist
    if (!empty($password) && !empty($new_password) && !empty($confirm_new_password)) {
        // if current password is correct
        if ($password === $current_password) {
            // if new password and confirm new password are the same
            if ($new_password === $confirm_new_password) {
                $password = $new_password;
            } else {
                $errors['password'] = "New password and confirm new password are not the same";
            }
        } else {
            $errors['password'] = "Current password is incorrect";
        }
    } else {
        $password = $current_password;
    }
    // if there are no errors
    if (count($errors) > 0) {
        foreach ($errors as $key => $value) {
            echo "<h5 style='color: red;'>$value</h5>";
        }
    } else {
        // if an image is uploaded
        if ($image != "") {
            // get image extension
            $image_extension = pathinfo($image, PATHINFO_EXTENSION);
            // get image size
            $image_size = $_FILES['image']['size'];
            // get image temp name
            $image_temp_name = $_FILES['image']['tmp_name'];
            // get image name
            $image_name = uniqid() . "." . $image_extension;
            // get image path
            $image_path = "resources/images/" . $image_name;
            // if image extension is not jpg, jpeg, png, gif
            if ($image_extension != "jpg" && $image_extension != "jpeg" && $image_extension != "png" && $image_extension != "gif") {
                echo "<h5 style='color: red;'>Image extension is not valid</h5>";
            } else {
                // if image size is greater than 2MB
                if ($image_size > 2097152) {
                    echo "<h5 style='color: red;'>Image size is too large</h5>";
                } else {
                    // if image is uploaded successfully
                    if (move_uploaded_file($image_temp_name, $image_path)) {
                        // update admin
                        $sql = "UPDATE admins SET name = '$name', email = '$email', password = '$password', image = '$image_name' WHERE id = '$id'";
                        if (mysqli_query($conn, $sql)) {
                            echo "success";
                        } else {
                            echo "Request failed" . mysqli_error($conn);
                        }
                    } else {
                        echo "<h5 style='color: red;'>Image upload failed</h5>";
                    }
                }
            }
        } else {
            // update admin
            $sql = "UPDATE admins SET name = '$name', email = '$email', password = '$password' WHERE id = '$id'";
            if (mysqli_query($conn, $sql)) {
                echo "success";
            } else {
                echo "Request failed" . mysqli_error($conn);
            }
        }
    }
}

// cancel_request_id
if (isset($_POST['cancel_request_id'])) {
    $id = $_POST['cancel_request_id'];
    $sql = "UPDATE requests SET status = 'cancelled', driver = '0' WHERE id = '$id'";
    if (mysqli_query($conn, $sql)) {
        echo "success";
    } else {
        echo "Request failed" . mysqli_error($conn);
    }
}
// approve_request_id
if (isset($_POST['approve_request_id'])) {
    $id = $_POST['approve_request_id'];
    $sql = "UPDATE requests SET approved_requests = 'yes' WHERE id = '$id'";
    if (mysqli_query($conn, $sql)) {
        echo "success";
    } else {
        echo "Request failed" . mysqli_error($conn);
    }
}
// request_contact_data
if (isset($_POST['request_contact_data'])) {
    $id = $_POST['id'];
    $sql = "SELECT * FROM contacts WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $name = $row['name'];
    $email = $row['email'];
    $message = $row['message'];
    ?>
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
        <div class="form-control reply-contact-rst">
            <input type="submit" name="reply-contact" value="Reply" class="btn btn-success reply-contact-send">
        </div>
    </form>
    <script>
        $('.reply-contact-send').click(function() {
            event.preventDefault();

            var reply = $('#reply').val();
            if (reply == "") {
                alert('Reply field is required');
                return false;
            } else {
                // run custom waitme
                run_waitMe_custom('roundBounce', '.reply-contact-rst', 'Sending reply...', 'horizontal');
                // send reply to contact
                $.ajax({
                    url: '../reg_exe.php',
                    method: 'post',
                    data: {
                        reply: reply,
                        id: <?php echo $id; ?>
                    },
                    success: function(response) {
                        $('.reply-contact-rst').waitMe('hide');
                        if (response == "success") {
                            swal.fire({
                                title: "Success",
                                text: "Reply sent successfully",
                                icon: "success",
                                button: "Ok",
                            }).then(function() {
                                location.reload();
                            });
                        } else {
                            swal.fire({
                                title: "Error",
                                text: response,
                                icon: "error",
                                button: "Ok",
                            });
                        }
                    }
                });
            }
        });
    </script>
<?php
}

// reply
if (isset($_POST['reply'])) {
    $reply = $_POST['reply'];
    $id = $_POST['id'];
    // get contact email, name
    $sql = "SELECT * FROM contacts WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $email = $row['email'];
    $name = $row['name'];
    // send reply to contact
    $to = $email;
    $subject = "Reply from admin";
    $message = $reply;
    $headers = "From: shakingmachine@rs3.rcnoc.com";
    if (mail($to, $subject, $message, $headers)) {
        echo "success";
    } else {
        echo "Request failed";
    }
}
