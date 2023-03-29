<?php
// if session is not set start session
if (!isset($_SESSION)) {
    session_start();
}
// if session is set destroy session
if (isset($_SESSION)) {
    session_destroy();
    header("Location: login.php");
}
