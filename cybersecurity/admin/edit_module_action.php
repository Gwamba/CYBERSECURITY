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
$title = $_POST['title'];
$description = $_POST['description'];
$content = $_POST['content'];

// Update module details
$sql = "UPDATE modules SET title = ?, description = ?, content = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssi", $title, $description, $content, $module_id);

if ($stmt->execute()) {
    // Handle image uploads
    if (!empty($_FILES['images']['name'][0])) {
        $image_paths = $_FILES['images']['tmp_name'];
        
        foreach ($_FILES['images']['name'] as $key => $image_name) {
            $image_tmp = $image_paths[$key];
            $image_path = 'uploads/' . $image_name;

            if (move_uploaded_file($image_tmp, $image_path)) {
                // Insert new image paths into the database
                $sql_image = "INSERT INTO module_images (module_id, image_path) VALUES (?, ?)";
                $stmt_image = $conn->prepare($sql_image);
                $stmt_image->bind_param("is", $module_id, $image_path);
                $stmt_image->execute();
            }
        }
    }

    // Redirect or show success message
    header("Location: admin.php?message=Module updated successfully");
} else {
    echo "Error updating module: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
