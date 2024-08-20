<?php
$host = 'localhost';
$db = 'cybersecurity_db';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all modules
$sql = "SELECT id, title, description FROM modules";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cybersecurity Modules</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Cybersecurity Awareness Modules</h1>
        <div class="list-group">

            <?php while ($module = $result->fetch_assoc()) { ?>
                <div class="list-group-item mb-4">
                    <h4><?php echo $module['title']; ?></h4>
                    <p><?php echo $module['description']; ?></p>
                    <a href="module.php?id=<?php echo $module['id']; ?>" class="btn btn-primary">Read More</a>
                </div>
            <?php } ?>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
