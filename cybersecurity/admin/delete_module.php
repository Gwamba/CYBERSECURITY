<?php
$host = 'localhost';
$db = 'cybersecurity_db';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$module_id = $_GET['id'];

$sql = "DELETE FROM modules WHERE id = $module_id";

if ($conn->query($sql) === TRUE) {
    echo "Module deleted successfully";
    header("Location: index.php");
} else {
    echo "Error deleting module: " . $conn->error;
}

$conn->close();
?>
