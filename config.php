<?php
$servername = "localhost";
$username = "assynerg_mooduser";
$password = "IJtd*=,j4%Fl";
$dbname = "assynerg_moodtable";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
