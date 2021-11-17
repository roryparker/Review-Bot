<?php 

ob_start(); // turns on output buffering
session_start(); // start session for stored variables.
$timezone = date_default_timezone_set("America/New_York"); // Set time zone to EST

$con = new mysqli("localhost", "root", "", "userdb");

if (mysqli_connect_errno()) {
    echo "Error connecting: ". mysqli_connect_errno();
}

?>
