<?php
$host = 'localhost';
$db = 'cybersecurity_db';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$image_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$module_id = isset($_GET['module_id']) ? (int)$_GET['module_id'] : 0;

// Fetch the image path from the database
$sql = "SELECT image_path FROM module_images WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $image_id);
$stmt->execute();
$result = $stmt->get_result();
$image = $result->fetch_assoc();

if ($image) {
    $image_path = $image['image_path'];

    // Delete the image file from the server
    if (file_exists($image_path)) {
        unlink($image_path);
    }

    // Delete the image record from the database
    $sql_delete = "DELETE FROM module_images WHERE id = ?";
    $stmt_delete = $conn->prepare($sql_delete);
    $stmt_delete->bind_param("i", $image_id);
    $stmt_delete->execute();
}

$stmt->close();
$conn->close();

header("Location: edit_module.php?id=" . $module_id);
?>
