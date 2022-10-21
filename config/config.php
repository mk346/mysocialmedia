<?php
ob_start(); //turns on output  buffering
session_start(); //starts a session that can store variables in a session

$timezone = date_default_timezone_set("Africa/Nairobi");

$con = mysqli_connect("localhost", "root", "", "social");
if (mysqli_connect_errno()) {
    echo "Failed to connect" . mysqli_connect_errno();
}
?>