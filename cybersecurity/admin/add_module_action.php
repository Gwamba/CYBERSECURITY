<?php
$host = 'localhost';
$db = 'cybersecurity_db';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$title = $_POST['title'];
$description = $_POST['description'];
$content = $_POST['content'];

// Insert the module into the database
$sql = "INSERT INTO modules (title, description, content) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $title, $description, $content);

if ($stmt->execute()) {
    $module_id = $stmt->insert_id; // Get the ID of the inserted module

    // Handle multiple image uploads
    if (!empty($_FILES['images']['name'][0])) {
        $image_paths = $_FILES['images']['tmp_name'];
        
        foreach ($_FILES['images']['name'] as $key => $image_name) {
            $image_tmp = $image_paths[$key];
            $image_path = 'uploads/' . $image_name;

            // Move uploaded files to the uploads directory
            if (move_uploaded_file($image_tmp, $image_path)) {
                // Save each image path to the database
                $sql = "INSERT INTO module_images (module_id, image_path) VALUES (?, ?)";
                $stmt_image = $conn->prepare($sql);
                $stmt_image->bind_param("is", $module_id, $image_path);
                $stmt_image->execute();
            }
        }
    }

    header("Location: admin.php?message=Module added successfully");
} else {
    echo "Error adding module: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
