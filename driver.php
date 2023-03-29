<?php
// if session is not set start session
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    header("Location: auth/login.php");
}
/* echo "<pre>";
print_r($_SESSION);
echo "</pre>"; */
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "resources/burt/burt_header.html"; ?>
    <!-- icon -->
    <link rel="icon" href="resources/images/garbage-icon.png">
    <link rel="stylesheet" href="css/style.css?v=<?php echo rand(); ?>">
    <script src="https://maps.googleapis.com/maps/api/js"></script>
    <title>Driver - Garbage collection system</title>
</head>

<body>
    <!-- header -->
    <header>
        <nav>
            <div class="left">
                <a href="index.php">
                    <h1 class="logo">Garbage collection system</h1>
                </a>
            </div>
            <div class="right">
                <ul>
                    <li><a href="#contact" class="contact-link">Contact us</a></li>
                    <li><a href="#about" rel="modal:open">About us</a></li>
                    <li><a href="#view-my-requests" rel="modal:open">My requests</a></li>
                    <li><a href="#request" rel="modal:open">Request</a></li>
                    <li><a href="#rate" rel="modal:open">Rate us</a></li>
                    <li><a href="auth/logout.php">Logout</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- nw -->
    <!-- available requests -->
    <div class="available-requests">
        <div class="available-requests-header">
            <h1>Available requests</h1>
        </div>
        <div class="available-requests-body">
            <?php
            include "dbh.php";
            $sql = "SELECT id, message, date, address FROM requests WHERE status = 'pending' OR status = 'cancelled'";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);
            if ($resultCheck > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '
                    <div class="request-card">
                        <div class="request-card-header">
                            <h3>Request ID: ' . $row['id'] . '</h3>
                        </div>
                        <div class="request-card-body">
                            <p> ' . $row['message'] . '</p>
                        </div>
                        <div class="request-card-footer">
                        <input type="hidden" name="driver-address" id="driver-address">
                        <input type="hidden" name="driver-date" id="driver-date">
                            <a href="#driver-view-request" rel="modal:open" class="btn btn-primary driver-view-request" data-id="' . $row['id'] . '">View request</a>
                        </div>
                    </div>
                    ';
                }
            } else {
                echo "<div class='request-card'>
                <div class='request-card-header'>
                    <h3>No requests available</h3>
                </div>
                <div class='request-card-body'>
                    <p> No requests available at the moment. </p>
                </div>
                <div class='request-card-footer'>
                    <a href='driver.php' class='btn btn-primary'>Refresh</a>
                </div>
                </div>";
            }
            ?>
            <!-- request card, with id and message, view request -->
            <!-- <div class="request-card">
                <div class="request-card-header">
                    <h3>Request ID: 1</h3>
                </div>
                <div class="request-card-body">
                    <p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quae. </p>
                </div>
                <div class="request-card-footer">
                    <a href="request.php" class="btn btn-primary">View request</a>
                </div>
            </div> -->
            <!-- nw -->
        </div>
    </div>
    <!-- footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-section-about" id="contact">
                <h1 class="logo-text"><span>Garbage</span> collection system</h1>
                <p>
                    Garbage collection system is a web application that allows users to request for garbage collection services. The system also allows drivers to accept the requests and collect the garbage.
                </p>
                <div class="contact">
                    <span><i class="fas fa-phone"></i> &nbsp; 123-456-789</span>
                    <span><i class="fas fa-envelope"></i> &nbsp; </span>
                </div>
                <div class="socials">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            <div class="footer-section-links">
                <h2>Quick Links</h2>
                <br>
                <ul>
                    <a href="#">
                        <li>Events</li>
                    </a>
                    <a href="#">
                        <li>Team</li>
                    </a>
                    <a href="#">
                        <li>Mentors</li>
                    </a>
                    <a href="#">
                        <li>Gallery</li>
                    </a>
                    <a href="#">
                        <li>Terms and Conditions</li>
                    </a>
                </ul>
            </div>
            <div class="footer-section-contact-form" id="contact-fm1">
                <h2 class="contact-fm1-h2">Contact us</h2>
                <br>
                <form action="index.html" method="post" class="contact-rqst">
                    <!-- name -->
                    <input type="text" name="name" id="contact-name" class="text-input contact-input" placeholder="Your name...">
                    <input type="email" name="email" id="contact-email" class="text-input contact-input" placeholder="Your email address...">
                    <textarea rows="4" name="message" id="contact-message" class="text-input contact-input" placeholder="Your message..."></textarea>
                    <button type="submit" class="btn btn-big contact-btn">
                        <i class="fas fa-envelope"></i>
                        Send
                    </button>
                </form>
            </div>
        </div>
    </footer>
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
                    <label for="address">Choose your Address</label>
                    <!-- <input type="text" name="address" id="address" placeholder="Enter your address"> -->
                    <input type="hidden" name="address" id="address" placeholder="Enter your address">
                    <div id="map-canvas"></div>
                    <div id="user-info"></div>
                </div>
                <!-- message -->
                <div class="form-control">
                    <label for="message">Message</label>
                    <textarea name="message" id="message" cols="30" rows="3" placeholder="Enter your message"></textarea>
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
    </div>
    <!-- rate modal -->
    <div class="modal" id="rate">
        <div class="modal-header">
            <h3>Rate our services</h3>
        </div>
        <div class="modal-body">
            <form action="/reg_exe.php" method="POST">
                <!-- name -->
                <div class="form-control">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="rate-name" placeholder="Enter your name">
                </div>
                <!-- email -->
                <div class="form-control">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="rate-email" placeholder="Enter your email">
                </div>
                <!-- message -->
                <div class="form-control">
                    <label for="message">Message</label>
                    <textarea name="message" id="rate-message" cols="30" rows="3" placeholder="Enter your message"></textarea>
                </div>
                <!-- rating inform of stars -->
                <div class="form-control">
                    <label for="rating">Rating</label>
                    <div id="stars">
                        <span class="star" data-value="1"></span>
                        <span class="star" data-value="2"></span>
                        <span class="star" data-value="3"></span>
                        <span class="star" data-value="4"></span>
                        <span class="star" data-value="5"></span>
                    </div>
                    <input type="hidden" id="rate-rating" name="rating" value="">
                </div>
                <!-- submit -->
                <div class="form-control snd-rt">
                    <button type="submit" name="submit" class="btn btn-primary" id="rate-us">Rate our services</button>
                </div>
            </form>
        </div>
    </div>
    <!-- about us modal -->
    <div class="modal" id="about">
        <div class="modal-header">
            <h3>About us</h3>
        </div>
        <div class="content">
            <p>Welcome to Waste Management Solutions! We are here to provide you with the best waste collection and disposal services in the industry. Our company is committed to providing you with the most reliable and efficient waste management solutions.</p>

            <p>We provide waste collection and disposal services for both residential and commercial customers. Our services include collection, transportation and disposal of all types of waste, including hazardous, organic and general waste. We offer flexible pickup schedules and competitive pricing.</p>

            <p>Our team of experienced professionals is here to ensure that the waste is collected and disposed of safely and efficiently. We use the latest technology and equipment to ensure that the waste is collected and disposed of in an environmentally friendly manner. We also offer advice and guidance on waste management and disposal methods.</p>

            <p>At Waste Management Solutions, we understand the importance of keeping our environment clean and safe. We strive to provide the best waste management solutions that are both efficient and cost-effective. We are committed to providing our customers with the best possible service and are dedicated to helping them achieve the highest standards in waste management.</p>

            <p>If you have any questions or would like more information about our services, please feel free to <a href="mailto:contact@wastemanagement.com">contact us</a>. We look forward to hearing from you!</p>
        </div>
    </div>
    <!-- driver-view-request modal -->
    <div class="modal" id="driver-view-request">
        <div class="modal-header">
            <h3>VIEW REQUEST</h3>
        </div>
        <div class="modal-body">
            <div class="driver-view-request-content">
                <!-- name -->
                <h5><b>Name:</b> John doe</h5>
                <!-- message -->
                <h5><b>Message:</b> I have a lot of garbage</h5>
                <!-- date -->
                <h5><b>Date:</b> 2021-05-05</h5>
                <!-- address -->
                <h5><b>Address:</b> <span class="driver-copy" title="Click to copy">1234, 5th street, New York, NY</span></h5>
                <!-- hint user to copy address and paste in google maps to see the location -->
                <h6><b>Hint:</b> Copy the address and paste it in <a href="https://maps.google.com/" style="color: blue;" target="_blank">google maps</a> to see the location</h6>

            </div>
        </div>
    </div>
    <!-- view my requests modal -->
    <div class="modal" id="view-my-requests">
        <div class="modal-header">
            <h3>VIEW ALL YOUR REQUESTS</h3>
            <!-- print requests receipt -->
            <button class="btn btn-primary" id="print-request-receipt">Print requests</button>
        </div>
        <div class="modal-body">
            <div class="vr-requests">
                <?php
                include "dbh.php";
                $uid = $_SESSION['user_id'];
                $sql = "SELECT * FROM requests WHERE driver = '$uid'";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);
                if ($resultCheck > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<div class='vr-request-card'>
                                <h3>Request ID: #" . $row['id'] . "</h3>
                                <h5><b>Name:</b> " . $row['name'] . "</h5>
                                <h5><b>Message:</b> " . $row['message'] . "</h5>
                                <h5><b>Date:</b> " . $row['date'] . "</h5>
                                <h5><b>Address:</b> <span class='driver-copy' title='Click to copy'>" . $row['address'] . "</span></h5>
                                <h6><b>Hint:</b> Copy the address and paste it in <a href='https://maps.google.com/' style='color: blue;' target='_blank'>google maps</a> to see the location</h6>
                                <!-- cancel request -->
                                <button class='btn btn-danger cancel-request' data-id='" . $row['id'] . "'>Cancel Request</button>
                            </div>";
                    }
                } else {
                    echo "<h3>You have no requests</h3>";
                }
                ?>
                <!-- <div class="vr-request-card">
                    <h3>Request ID: #3</h3>
                    <h5><b>Name:</b> John doe</h5>
                    <h5><b>Message:</b> I have a lot of garbage</h5>
                    <h5><b>Date:</b> 2021-05-05</h5>
                    <h5><b>Address:</b> <span class="driver-copy" title="Click to copy">1234, 5th street, New York, NY</span></h5>
                    <h6><b>Hint:</b> Copy the address and paste it in <a href="https://maps.google.com/" style="color: blue;" target="_blank">google maps</a> to see the location</h6>
                <button class="btn btn-danger">Cancel Request</button>
            </div> -->
                <!-- nw -->

            </div>
        </div>
    </div>
    <!-- nw -->
    <script src="js/index.js"></script>
    <script>
        // Get all star elements
        const stars = document.querySelectorAll('.star');

        // Add click event listener to each star
        stars.forEach((star) => {
            star.addEventListener('click', () => {
                // Remove active class from all stars
                stars.forEach((s) => {
                    s.classList.remove('active-star');
                });

                // Add active class to clicked star and all previous stars
                star.classList.add('active-star');
                let previous = star.previousElementSibling;
                while (previous) {
                    previous.classList.add('active-star');
                    previous = previous.previousElementSibling;
                }

                // Set the rating value to the selected star's data-value
                const ratingInput = document.getElementById('rate-rating');
                ratingInput.value = star.getAttribute('data-value');
            });
        });
        // contact-link click event go to contact section and highlight header
        $('#contact-link').click(function() {
            $('html, body').animate({
                scrollTop: $('#contact-fm1').offset().top
            }, 1000);
            // add active-scroll class to .footer-section-contact-form h2
            $('.contact-fm1-h2').addClass('active-scroll');
        });
        // nw
        var map;
        var marker;

        function initialize() {
            var mapOptions = {
                zoom: 11
            };
            map = new google.maps.Map(document.getElementById('map-canvas'),
                mapOptions);

            // Try HTML5 geolocation
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var pos = new google.maps.LatLng(position.coords.latitude,
                        position.coords.longitude);
                    var marker = new google.maps.Marker({
                        position: pos,
                        map: map,
                        title: 'Here you are',
                        draggable: true
                    });

                    map.setCenter(pos);
                    google.maps.event.addListener(marker, 'dragend', function(a) {
                        // $('#user-info').append(a.latLng.lat().toFixed(4) + ', ' + a.latLng.lng().toFixed(4) + '<br/>');
                        // append lat and lng to hidden input address
                        $('#address').val(a.latLng.lat().toFixed(4) + ', ' + a.latLng.lng().toFixed(4));
                    });
                }, function() {
                    handleNoGeolocation(true);
                });
            } else {
                // Browser doesn't support Geolocation
                handleNoGeolocation(false);
            }
        }

        function handleNoGeolocation(errorFlag) {
            if (errorFlag) {
                $('#user-info').append('Error: The Geolocation service failed.');
            } else {
                $('#user-info').append('Error: Your browser doesn\'t support geolocation.');
            }

            var options = {
                map: map,
                position: new google.maps.LatLng(60, 105),
            };

            map.setCenter(options.position);
        }

        google.maps.event.addDomListener(window, 'load', initialize);

        // nw
        // on driver-copy click copy the address
        $('.driver-copy').click(function() {
            // get the address
            var address = $(this).text();
            // create a temporary input element
            var $temp = $("<input>");
            // append the temporary input element to the body
            $("body").append($temp);
            // set the value of the temporary input element to the address
            $temp.val(address).select();
            // copy the address
            document.execCommand("copy");
            // remove the temporary input element
            $temp.remove();
            // animate to show the user that the address is copied
            $(this).animate({
                opacity: 0.25
            }, 1000, function() {
                $(this).animate({
                    opacity: 1
                }, 1000);
                $(this).attr('title', 'Copied');
            });
            setTimeout(function() {
                $(this).attr('title', 'Copied');
            }, 1000);
            $(this).attr('title', 'Click to copy');
        });
        // nw
        // driver-view-request click event
        $('.driver-view-request').click(function() {
            console.log('driver-view-request clicked');
            event.preventDefault();
            // get the request id
            var request_id = $(this).attr('data-id');
            // send ajax request to get the request details
            $('.driver-view-request-content').html('');
            // run custom waitme
            run_waitMe_custom('roundBounce', '#driver-view-request', 'Loading...', 'horizontal');

            $.ajax({
                url: 'reg_exe.php',
                type: 'POST',
                data: {
                    request_id: request_id
                },
                success: function(data) {
                    // remove waitme
                    $('#driver-view-request').waitMe('hide');
                    // driver-view-request-content html
                    $('.driver-view-request-content').html(data);
                }
            });
        });
        // nw
        // cancel-request
        $('.cancel-request').click(function() {
            var id = $(this).attr('data-id');
            // run custom waitme on this .vr-request-card
            run_waitMe_custom('roundBounce', '#view-my-requests', 'Loading...', 'horizontal');
            $.ajax({
                url: 'reg_exe.php',
                type: 'POST',
                data: {
                    cancel_request_id: id
                },
                success: function(data) {
                    // stop waitme
                    $('#view-my-requests').waitMe('hide');
                    if (data == "success") {
                        // swal fire success
                        swal.fire({
                            title: "Success",
                            text: "Request cancelled successfully!",
                            icon: "success",
                            button: "OK",
                        }).then(function() {
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
        $('#print-request-receipt').click(function() {
            console.log('print-request-receipt clicked');
            // load fetch_requests.php on new page
            window.open('fetch_requests.php', '_blank');

        });
    </script>
</body>

</html>