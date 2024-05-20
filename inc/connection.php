<?php
$servername = "localhost";
$user = "root";
$password = "";
$dbname = "ems";

$conn = new mysqli($servername, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
