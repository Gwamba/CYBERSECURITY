<?php
$host = 'localhost';
$db = 'cybersecurity_db';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if feedback ID is set
if (isset($_POST['feedback_id'])) {
    $feedback_id = (int)$_POST['feedback_id'];

    // Delete feedback from the database
    $sql = "DELETE FROM feedback WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $feedback_id);

    if ($stmt->execute()) {
        echo "<script>alert('Experience deleted successfully'); window.location.href = 'view_experience.php';</script>";
    } else {
        echo "<script>alert('Error deleting experience'); window.location.href = 'view_experience.php';</script>";
    }

    $stmt->close();
} else {
    echo "<script>alert('No experience selected to delete'); window.location.href = 'view_experience.php';</script>";
}

$conn->close();
?>
