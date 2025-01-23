<?php
include 'db_connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM events WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $event = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$event) {
        echo "Event not found.";
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>View Event</title>
</head>
<body>
<div class="container mt-4">
    <h1><?php echo $event['title']; ?></h1>
    <p class="text-muted">Description: <?php echo $event['description']; ?></p>
    <p><strong>Start:</strong> <?php echo $event['start_time']; ?></p>
    <p><strong>End:</strong> <?php echo $event['end_time']; ?></p>
    <p><strong>Location:</strong> <?php echo $event['location']; ?></p>
    <a href="index.php" class="btn btn-primary">Back to Events</a>
</div>
</body>
</html>