<?php
include '../db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $location = $_POST['location'];
    $organizer_id = 1;

    $sql = "INSERT INTO events (title, description, start_time, end_time, location, organizer_id)
            VALUES (:title, :description, :start_time, :end_time, :location, :organizer_id)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':start_time', $start_time);
    $stmt->bindParam(':end_time', $end_time);
    $stmt->bindParam(':location', $location);
    $stmt->bindParam(':organizer_id', $organizer_id);

    if ($stmt->execute()) {
        echo "Event created succesfully.";
    } else {
        echo "Error: " . $stmt->errorInfo()[2];
    }
    
}
?>

<form method="POST">
    <input type="text" name="title" placeholder="Event Title" required>
    <textarea name="description" placeholder="Event Description" required></textarea>
    <input type="datetime-local" name="start_time" required>
    <input type="datetime-local" name="end_time" required>
    <input type="text" name="location" placeholder="Location" required>
    <button type="submit">Create Event</button>
</form>