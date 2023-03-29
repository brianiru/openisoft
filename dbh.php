<?php
// db connection file
$server = "localhost";
$username = "root";
$password = "";
$db = "garbage";

// create connection
$conn = mysqli_connect($server, $username, $password, $db);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
