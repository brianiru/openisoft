$("#send-request").click(function () {
    event.preventDefault();
    // run custom waitme
    run_waitMe_custom('roundBounce', '.snd-rqst', 'Sending...', 'horizontal');
    // send request
    var formData = new FormData();
    formData.append('name', $('#name').val());
    formData.append('email', $('#email').val());
    formData.append('phone', $('#phone').val());
    formData.append('address', $('#address').val());
    formData.append('message', $('#message').val());
    formData.append('date', $('#date').val());
    formData.append('send-request', true);
    $.ajax({
        url: "reg_exe.php",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            // stop waitme
            $('.snd-rqst').waitMe('hide');
            if (data == "success") {
                // swal fire success
                swal.fire({
                    title: "Success",
                    text: "Request sent successfully!",
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

// register
$("#register").click(function () {
    event.preventDefault();
    // run custom waitme
    run_waitMe_custom('roundBounce', '.register', 'Registering...', 'horizontal');
    // send request
    var formData = new FormData();
    formData.append('name', $('#name').val());
    formData.append('email', $('#email').val());
    formData.append('username', $('#username').val());
    formData.append('password', $('#password').val());
    formData.append('confirm-password', $('#confirm-password').val());
    formData.append('register', true);
    $.ajax({
        url: "../reg_exe.php",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            // stop waitme
            $('.register').waitMe('hide');
            if (data == "success") {
                // swal fire success
                swal.fire({
                    title: "Success",
                    text: "Registration successful!",
                    icon: "success",
                    button: "OK",
                }).then(function () {
                    // go to login page
                    window.location.href = "login.php";
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
// login
$("#login").click(function () {
    event.preventDefault();
    // run custom waitme
    run_waitMe_custom('roundBounce', '.login', 'Login in...', 'horizontal');
    // send request
    var formData = new FormData();
    formData.append('username', $('#username').val());
    formData.append('password', $('#password').val());
    formData.append('driver', $('#driver').val());
    formData.append('login', true);
    $.ajax({
        url: "../reg_exe.php",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            // stop waitme
            $('.login').waitMe('hide');
            // if data contains success 
            if (data.includes("success")) {
                // swal fire success
                swal.fire({
                    title: "Success",
                    text: "successfully logged in!",
                    icon: "success",
                    button: "OK",
                }).then(function () {
                    // window location
                    // get the rest of text from data excluding success
                    var rest = data.replace("success", "");
                    // go to the page
                    window.location.href = rest;
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

// request-view
$(".request-view").click(function () {
    event.preventDefault();
    // clear #request-view-data
    $('#request-view-data').html('');
    // get this id
    var id = $(this).attr('id');
    console.log(id);
    // open request-view modal
    $('#request').modal('show');
    // run custom waitme
    run_waitMe_custom('roundBounce', '#request-view-data', 'Loading...', 'horizontal');
    // get the current row data
    var formData = new FormData();
    formData.append('id', id);
    formData.append('request-view', true);
    $.ajax({
        url: "../reg_exe.php",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            // stop waitme
            $('#request-view-data').waitMe('hide');
            // set the data
            $('#request-view-data').html(data);
        }
    });

});
// rate-us
$("#rate-us").click(function () {
    event.preventDefault();
    // run custom waitme
    run_waitMe_custom('roundBounce', '.snd-rt', 'Adding Rating...', 'horizontal');
    // send request
    var formData = new FormData();
    formData.append('name', $('#rate-name').val());
    formData.append('email', $('#rate-email').val());
    formData.append('message', $('#rate-message').val());
    formData.append('rating', $('#rate-rating').val());
    formData.append('rate-us', true);
    $.ajax({
        url: "reg_exe.php",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            // stop waitme
            $('.snd-rt').waitMe('hide');
            if (data == "success") {
                // swal fire success
                swal.fire({
                    title: "Success",
                    text: "Rating added successfully!",
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

// add-driver-rqst
$("#add-driver-rqst").click(function () {
    event.preventDefault();
    // run custom waitme
    run_waitMe_custom('roundBounce', '.add-driver-rqst', 'Adding Driver...', 'horizontal');
    // send request
    var formData = new FormData();
    formData.append('name', $('#name').val());
    formData.append('national_id', $('#national_id').val());
    formData.append('license', $('#license').val());
    formData.append('email', $('#email').val());
    formData.append('phone', $('#phone').val());
    formData.append('address', $('#address').val());
    formData.append('add-driver-rqst', true);
    $.ajax({
        url: "../reg_exe.php",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            // stop waitme
            $('.add-driver-rqst').waitMe('hide');
            if (data == "success") {
                // hide custom waitme
                $('.add-driver-rqst').waitMe('hide');
                // swal fire success
                swal.fire({
                    title: "Success",
                    text: "Driver added successfully!",
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

//  edit-driver-btn
$(".edit-driver-btn").click(function () {
    event.preventDefault();
    // clear #edit-driver-data
    $('#edit-driver-data').html('');
    // get this id
    var id = $(this).attr('id');
    console.log(id);
    // open edit-driver modal
    $('#edit-driver').modal('show');
    // run custom waitme
    run_waitMe_custom('roundBounce', '#edit-driver-data', 'Loading...', 'horizontal');
    // get the current row data
    var formData = new FormData();
    formData.append('id', id);
    formData.append('edit-driver-view', true);
    $.ajax({
        url: "../reg_exe.php",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            // stop waitme
            $('#edit-driver-data').waitMe('hide');
            // set the data
            $('#edit-driver-data').html(data);
        }
    });
});
// edit-driver-rqst submit
$(".edit-driver-view").click(function (e) {
    alert('test');
    e.preventDefault();
    // run custom waitme
    run_waitMe_custom('roundBounce', '.edit-driver-rqst', 'Updating Driver...', 'horizontal');
    // send request
    var formData = new FormData();
    formData.append('id', $('#edit-id').val());
    formData.append('name', $('#edit-name').val());
    formData.append('national_id', $('#edit-national_id').val());
    formData.append('license', $('#edit-license').val());
    formData.append('email', $('#edit-email').val());
    formData.append('phone', $('#edit-phone').val());
    formData.append('address', $('#edit-address').val());
    formData.append('edit-driver', true);
    $.ajax({
        url: "../reg_exe.php",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            // stop waitme
            $('.edit-driver-rqst').waitMe('hide');
            if (data == "success") {
                // hide custom waitme
                $('.edit-driver-rqst').waitMe('hide');
                // swal fire success
                swal.fire({
                    title: "Success",
                    text: "Driver updated successfully!",
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

// delete-driver
$(".delete-driver").click(function () {
    event.preventDefault();
    // get this id
    var id = $(this).attr('id');
    console.log(id);
    // swal fire
    swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this driver! sds",
        icon: "warning",
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: 'Yes',
        // denyButtonText: 'Cancel',
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete.isConfirmed) {
            // run custom waitme
            run_waitMe_custom('roundBounce', '#driver-table', 'Deleting Driver...', 'horizontal');
            // send request
            var formData = new FormData();
            formData.append('id', id);
            formData.append('delete-driver', true);
            $.ajax({
                url: "../reg_exe.php",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function (data) {
                    // stop waitme
                    $('#driver-table').waitMe('hide');
                    if (data == "success") {
                        // swal fire success
                        swal.fire({
                            title: "Success",
                            text: "Driver deleted successfully!",
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
        } else {
            swal.fire({
                title: "Cancelled",
                text: "Driver is safe :)",
                icon: "info",
                button: "OK",
            });
        }
    });
});
// edit_profile_pic preview
function showPreview(event) {
    if (event.target.files.length > 0) {
        var src = URL.createObjectURL(event.target.files[0]);
        var preview = document.getElementById("profile_pic_preview");
        preview.src = src;
        preview.style.display = "block";
    }
}

// request-reply
$(".request-reply").click(function () {
    event.preventDefault();
    // get this id
    var id = $(this).attr('id');
    console.log(id);
    // open edit-driver modal
    $('#request-reply').modal('show');
    // run custom waitme
    run_waitMe_custom('roundBounce', '#request-reply-data', 'Loading...', 'horizontal');
    // get the current row data
    var formData = new FormData();
    formData.append('id', id);
    formData.append('request-reply-view', true);
    $.ajax({
        url: "../reg_exe.php",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            // stop waitme
            $('#request-reply-data').waitMe('hide');
            // set the data
            $('#request-reply-data').html(data);
        }
    });
});
// contact-btn
$(".contact-btn").click(function () {
    event.preventDefault();
    // run custom waitme
    run_waitMe_custom('roundBounce', '.contact-rqst', 'Sending Message...', 'horizontal');
    // send request
    var formData = new FormData();
    formData.append('name', $('#contact-name').val());
    formData.append('email', $('#contact-email').val());
    formData.append('message', $('#contact-message').val());
    formData.append('contact', true);
    $.ajax({
        url: "reg_exe.php",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            // stop waitme
            $('.contact-rqst').waitMe('hide');
            if (data == "success") {
                // hide custom waitme
                $('.contact-rqst').waitMe('hide');
                // swal fire success
                swal.fire({
                    title: "Success",
                    text: "Message sent successfully!",
                    icon: "success",
                    button: "OK",
                }).then(function () {
                    // clear form
                    $('.contact-rqst').trigger("reset");
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
// send-login-details
$(".send-login-details").click(function () {
    event.preventDefault();
    // get this id
    var id = $(this).attr('id');
    // run custom waitme
    run_waitMe_custom('roundBounce', '.drivers-table', 'Sending Login Details...', 'horizontal');
    // send request
    var formData = new FormData();
    formData.append('id', id);
    formData.append('send-login-details', true);
    $.ajax({
        url: "../reg_exe.php",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            // stop waitme
            $('.drivers-table').waitMe('hide');
            if (data == "success") {
                // swal fire success
                swal.fire({
                    title: "Success",
                    text: "Login details sent successfully!",
                    icon: "success",
                    button: "OK",
                })
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

// request-rating-data
$(".request-rating-data").click(function () {
    event.preventDefault();
    // get this data-id
    var id = $(this).attr('data-id');
    // open reply-rating modal
    $('#reply-rating').modal('show');
    // run custom waitme
    run_waitMe_custom('roundBounce', '#request', 'Loading...', 'horizontal');
    // get the current row data
    var formData = new FormData();
    formData.append('id', id);
    formData.append('request-rating-view', true);
    $.ajax({
        url: "../reg_exe.php",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            // stop waitme
            $('#request').waitMe('hide');
            // set the data
            $('#reply-rating-data').html(data);
        }
    });
});

/* // reply-rating
$(".reply-rating").click(function () {
    event.preventDefault();
    // get this data-id
    var id = $(this).attr('data-id');
    // get this */

// update-profile-admin
$(".update-profile-admin").click(function () {
    event.preventDefault();
    // run custom waitme
    run_waitMe_custom('roundBounce', '.profile-rqst', 'Updating Profile...', 'horizontal');
    var file = $('#image')[0].files[0];
    if ((file == undefined) || (file == null)) {
        temp = "no_image";
    } else {
        temp = "image";
    }
    // send request
    var formData = new FormData();
    formData.append('name', $('#name').val());
    formData.append('email', $('#email').val());
    formData.append('password', $('#password').val());
    formData.append('new-password', $('#new-password').val());
    formData.append('confirm-new-password', $('#confirm-new-password').val());
    formData.append('image', file);
    formData.append('temp', temp);
    formData.append('update-profile-admin', true);
    $.ajax({
        url: "../reg_exe.php",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            // stop waitme
            $('.profile-rqst').waitMe('hide');
            if (data == "success") {
                // swal fire success
                swal.fire({
                    title: "Success",
                    text: "Profile updated successfully!",
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