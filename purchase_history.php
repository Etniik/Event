<?php
session_start();
include 'db_connection.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch tickets purchased by the user
$sql = "SELECT tickets.id, events.name, events.date, events.location, tickets.purchase_date 
        FROM tickets 
        JOIN events ON tickets.event_id = events.id 
        WHERE tickets.user_id = :user_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt->execute();
$tickets = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Purchase History</title>
</head>
<body>
<div class="container mt-5">
    <h1>Your Purchased Tickets</h1>
    <a href="events.php" class="btn btn-secondary mb-3">Back to Events</a>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>#</th>
            <th>Event Name</th>
            <th>Date</th>
            <th>Location</th>
            <th>Purchase Date</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($tickets as $ticket): ?>
            <tr>
                <td><?php echo htmlspecialchars($ticket['id']); ?></td>
                <td><?php echo htmlspecialchars($ticket['name']); ?></td>
                <td><?php echo htmlspecialchars($ticket['date']); ?></td>
                <td><?php echo htmlspecialchars($ticket['location']); ?></td>
                <td><?php echo htmlspecialchars($ticket['purchase_date']); ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
