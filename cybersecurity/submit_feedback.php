<?php
$host = 'localhost';
$db = 'cybersecurity_db';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$module_id = $_POST['module_id'];
$rating = $_POST['rating'];
$comments = $_POST['comments'];

// Check if the module ID exists in the modules table
$sql_check_module = "SELECT id FROM modules WHERE id = ?";
$stmt_check = $conn->prepare($sql_check_module);
$stmt_check->bind_param("i", $module_id);
$stmt_check->execute();
$stmt_check->store_result();

if ($stmt_check->num_rows == 0) {
    // Show a better error message
    echo "<script>alert('Invalid Module ID. Please select a valid module.'); window.location.href = 'feedback.php';</script>";
    $stmt_check->close();
    $conn->close();
    exit;
}

$stmt_check->close();

// Insert feedback if module ID exists
$sql = "INSERT INTO feedback (module_id, rating, comments) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iis", $module_id, $rating, $comments);

if ($stmt->execute()) {
    echo "<script>alert('Thank you for your feedback!'); window.location.href = 'feedback.php';</script>";
} else {
    echo "<script>alert('Error submitting feedback: " . $stmt->error . "'); window.location.href = 'feedback.php';</script>";
}

$stmt->close();
$conn->close();
?>
