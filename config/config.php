<?php

// turns on output buffering
ob_start(); 

// start session for stored variables.
session_start(); 

// Set time zone to EST
$timezone = date_default_timezone_set("America/New_York"); 

$con = new mysqli("localhost", "root", "", "userdb");

if(mysqli_connect_errno()) {
    echo "Error connecting: ". mysqli_connect_errno();
}

?>