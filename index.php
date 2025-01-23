<?php
include 'db_connection.php';
$sql = "SELECT * FROM events";
$stmt = $conn->prepare($sql);
$stmt->execute();
$events = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Event Management</title>
</head>
<body>
<div class="container mt-4">
    <h1 class="mb-4">Events</h1>
    <a href="create.php" class="btn btn-primary mb-3">Create Event</a>
    <div class="list-group">
        <?php foreach ($events as $event): ?>
            <a href="view.php?id=<?php echo $event['id']; ?>" class="list-group-item list-group-item-action">
                <h5><?php echo $event['title']; ?></h5>
                <p><?php echo $event['description']; ?></p>
                <small><?php echo $event['start_time']; ?> to <?php echo $event['end_time']; ?></small>
                <div class="d-flex justify-content-end">
                    <a href="edit.php?id=<?php echo $event['id']; ?>" class="btn btn-sm btn-warning me-2">Edit</a>
                    <a href="delete.php?id=<?php echo $event['id']; ?>" class="btn btn-sm btn-danger" 
                       onclick="return confirm('Are you sure you want to delete this event?')">Delete</a>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</div>
</body>
</html>
