<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "network_monitor";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$ip_address = $_POST['ip_address'];
$status = $_POST['status'];

$sql = "INSERT INTO network_status (ip_address, status)
VALUES ('$ip_address', '$status')";

if ($conn->query($sql) === TRUE) {
    echo "Record saved successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
