<?php
session_start();
include 'db_connection.php';
include 'navbar.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Check if an event ID is provided
if (!isset($_GET['id'])) {
    header("Location: events.php");
    exit();
}

$event_id = $_GET['id'];

// Fetch the event details
$sql = "SELECT events.name, events.date, events.location, events.description, users.name AS organizer 
        FROM events 
        JOIN users ON events.organizer_id = users.id 
        WHERE events.id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $event_id, PDO::PARAM_INT);
$stmt->execute();
$event = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$event) {
    echo "<div style='text-align: center; margin-top: 50px;'>
            <h1>Event Not Found</h1>
            <a href='events.php' class='btn btn-primary'>Back to Events</a>
          </div>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Event Details</title>
</head>
<body>
<div class="container mt-5">
    <h1>Event Details</h1>
    <table class="table table-bordered">
        <tr>
            <th>Name</th>
            <td><?php echo htmlspecialchars($event['name']); ?></td>
        </tr>
        <tr>
            <th>Date</th>
            <td><?php echo htmlspecialchars($event['date']); ?></td>
        </tr>
        <tr>
            <th>Location</th>
            <td><?php echo htmlspecialchars($event['location']); ?></td>
        </tr>
        <tr>
            <th>Description</th>
            <td><?php echo htmlspecialchars($event['description']); ?></td>
        </tr>
        <tr>
            <th>Organizer</th>
            <td><?php echo htmlspecialchars($event['organizer']); ?></td>
        </tr>
    </table>
    <a href="buy_ticket.php?id=<?php echo $event_id; ?>" class="btn btn-success">Buy Ticket</a>
    <a href="events.php" class="btn btn-secondary">Back to Events</a>
</div>
</body>
</html>
