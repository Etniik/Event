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
$sql = "SELECT * FROM events WHERE id = :id AND organizer_id = :organizer_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $event_id, PDO::PARAM_INT);
$stmt->bindParam(':organizer_id', $_SESSION['user_id'], PDO::PARAM_INT);
$stmt->execute();
$event = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$event) {
    echo "Event not found or you do not have permission to edit this event.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $date = $_POST['date'];
    $location = $_POST['location'];
    $description = $_POST['description'];

    $sql = "UPDATE events SET name = :name, date = :date, location = :location, description = :description 
            WHERE id = :id AND organizer_id = :organizer_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':date', $date);
    $stmt->bindParam(':location', $location);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':id', $event_id, PDO::PARAM_INT);
    $stmt->bindParam(':organizer_id', $_SESSION['user_id'], PDO::PARAM_INT);

    if ($stmt->execute()) {
        header("Location: events.php");
        exit();
    } else {
        echo "Error updating the event.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Edit Event</title>
</head>
<body>
<div class="container mt-5">
    <h1>Edit Event</h1>
    <form method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Event Name</label>
            <input type="text" name="name" id="name" class="form-control" value="<?php echo htmlspecialchars($event['name']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" name="date" id="date" class="form-control" value="<?php echo htmlspecialchars($event['date']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="location" class="form-label">Location</label>
            <input type="text" name="location" id="location" class="form-control" value="<?php echo htmlspecialchars($event['location']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" rows="4" required><?php echo htmlspecialchars($event['description']); ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update Event</button>
        <a href="events.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
