<?php
session_start();
include 'db_connection.php';
include 'navbar.php'; // Include the navigation bar

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch events from the database
$sql = "SELECT events.id, events.name, events.date, events.location, users.name AS organizer 
        FROM events 
        JOIN users ON events.organizer_id = users.id";
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
    <title>Events</title>
</head>
<body>
<div class="container mt-5">
    <?php if (isset($_GET['message'])): ?>
        <div class="alert alert-success">
            <?php echo htmlspecialchars($_GET['message']); ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_GET['error']) && $_GET['error'] == 'not_authorized_edit'): ?>
        <div class="alert alert-danger">
            You are not authorized to edit this event.
        </div>
    <?php endif; ?>

    <?php if (isset($_GET['error']) && $_GET['error'] == 'not_authorized'): ?>
        <div class="alert alert-danger">
            You are not authorized to delete this event.
        </div>
    <?php endif; ?>

    <h1>Event Management Dashboard</h1>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Event Name</th>
            <th>Date</th>
            <th>Location</th>
            <th>Organizer</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($events as $event): ?>
            <tr>
                <td><?php echo htmlspecialchars($event['name']); ?></td>
                <td><?php echo htmlspecialchars($event['date']); ?></td>
                <td><?php echo htmlspecialchars($event['location']); ?></td>
                <td><?php echo htmlspecialchars($event['organizer']); ?></td>
                <td>
                    <a href="details.php?id=<?php echo $event['id']; ?>" class="btn btn-info btn-sm">More Details</a>
                    <a href="edit.php?id=<?php echo $event['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="delete.php?id=<?php echo $event['id']; ?>" class="btn btn-danger btn-sm" 
                       onclick="return confirm('Are you sure you want to delete this event?');">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>