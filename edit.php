<?php
include '../db.php';

// Fetch existing event data
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM events WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $event = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Update event
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $location = $_POST['location'];

    $sql = "UPDATE events 
            SET title = :title, description = :description, start_time = :start_time, end_time = :end_time, location = :location 
            WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':start_time', $start_time);
    $stmt->bindParam(':end_time', $end_time);
    $stmt->bindParam(':location', $location);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        echo "Event updated successfully.";
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $stmt->errorInfo()[2];
    }
}
?>

<form method="POST">
    <input type="text" name="title" value="<?php echo $event['title']; ?>" required>
    <textarea name="description" required><?php echo $event['description']; ?></textarea>
    <input type="datetime-local" name="start_time" value="<?php echo date('Y-m-d\TH:i', strtotime($event['start_time'])); ?>" required>
    <input type="datetime-local" name="end_time" value="<?php echo date('Y-m-d\TH:i', strtotime($event['end_time'])); ?>" required>
    <input type="text" name="location" value="<?php echo $event['location']; ?>" required>
    <button type="submit">Update Event</button>
</form>
