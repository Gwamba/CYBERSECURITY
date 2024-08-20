<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Module</title>
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
                        <h2>Add New Module</h2>
                    </div>
                    <div class="card-body p-4">
                        <form action="add_module_action.php" method="POST" enctype="multipart/form-data">
                            <div class="mb-4">
                                <label for="title" class="form-label">Module Title</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Enter module title" required>
                            </div>
                            <div class="mb-4">
                                <label for="description" class="form-label">Module Description</label>
                                <textarea class="form-control" id="description" name="description" rows="4" placeholder="Enter module description" required></textarea>
                            </div>
                            <div class="mb-4">
                                <label for="content" class="form-label">Module Content</label>
                                <textarea class="form-control" id="content" name="content" rows="5" placeholder="Enter module content" required></textarea>
                            </div>
                            <div class="mb-4">
                                <label for="images" class="form-label">Upload Images</label>
                                <input type="file" class="form-control" id="images" name="images[]" multiple>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-lg">Add Module</button>
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
