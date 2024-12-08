<?php
// siteground credentials
$host = "localhost";
$db_name = "dbqmnddu2ryxr8";
$username = "u0isoggsl4xbv";
$password = "6?1@%v5H111K";

$conn = new mysqli($host, $username, $password, $db_name);

// local test credentials
//$host = "127.0.0.1";
//$db_name = "books";
//$username = "root";
//$password = "";

//$conn = new mysqli($host, $username, $password, $db_name, 3306, '/Applications/XAMPP/xamppfiles/var/mysql/mysql.sock');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
