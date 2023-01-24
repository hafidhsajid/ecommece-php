<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "barang";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if ($conn == false) {
    die("Connection failed: " . mysqli_connect_error());
    echo ' not connected';
} 
    // echo 'connected';
?>