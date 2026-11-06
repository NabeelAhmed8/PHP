<?php
$conn = mysqli_connect("localhost","root","","web");
if ($conn === false) {
    die("Connection failed: " . mysqli_connect_error());
}
// echo "Connected successfully";
mysqli_set_charset($conn, "utf8mb4");
?>