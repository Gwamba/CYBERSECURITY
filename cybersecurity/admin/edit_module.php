<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}

$host = 'localhost';
$db = 'cybersecurity_db';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the module ID from the URL
$module_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Fetch module data from the database
$sql = "SELECT * FROM modules WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $module_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $module = $result->fetch_assoc();
} else {
    echo "Module not found.";
    exit;
}

// Fetch module images
$sql_images = "SELECT * FROM module_images WHERE module_id = ?";
$stmt_images = $conn->prepare($sql_images);
$stmt_images->bind_param("i", $module_id);
$stmt_images->execute();
$result_images = $stmt_images->get_result();

$images = [];
while ($row = $result_images->fetch_assoc()) {
    $images[] = $row;
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Module</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../style/style.css" rel="stylesheet">
</head>

<body>
    <header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="index.php">Cybersecurity Awareness</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view_experience.php">User Experience</a>
                    </li>
                    <li class="nav-item">
                        <a href="add_module.php" class="nav-link">Add New Module</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
            </div>
        </nav>
    </header>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-dark text-white text-center">
                        <h2>Edit Module</h2>
                    </div>
                    <div class="card-body p-4">
                        <form action="edit_module_action.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="module_id" value="<?php echo $module['id']; ?>">

                            <div class="mb-4">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($module['title']); ?>" required>
                            </div>

                            <div class="mb-4">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="5" placeholder="Enter module description" required><?php echo htmlspecialchars($module['description']); ?></textarea>
                            </div>

                            <div class="mb-4">
                                <label for="content" class="form-label">Content</label>
                                <textarea class="form-control" id="content" name="content" rows="5" placeholder="Enter module content" required><?php echo htmlspecialchars($module['content']); ?></textarea>
                            </div>

                            <div class="mb-4">
                                <label for="images" class="form-label">Upload New Images</label>
                                <input type="file" class="form-control" id="images" name="images[]" multiple>
                            </div>

                            <div class="mb-4">
                                <h5>Existing Images</h5>
                                <div class="row">
                                    <?php foreach ($images as $image) { ?>
                                        <div class="col-md-4 mb-3">
                                            <div class="card">
                                                <img src="<?php echo $image['image_path']; ?>" alt="Module Image" class="img-fluid" style="max-width: 100%; height: auto;">
                                                <div class="card-body text-center">
                                                    <a href="delete_image.php?id=<?php echo $image['id']; ?>&module_id=<?php echo $module['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-lg">Update Module</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <footer class="mt-5 bg-dark text-white text-center py-3">
        <p>&copy;MMM 2024 Cybersecurity Awareness Platform.</p>
    </footer> -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
