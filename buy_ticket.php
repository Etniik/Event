<?php
session_start();
include 'db_connection.php';

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
$user_id = $_SESSION['user_id'];

// Insert the ticket purchase into the database
$sql = "INSERT INTO tickets (event_id, user_id) VALUES (:event_id, :user_id)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':event_id', $event_id, PDO::PARAM_INT);
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

if ($stmt->execute()) {
    echo "<div style='text-align: center; margin-top: 50px;'>
            <h1>Ticket Purchased Successfully!</h1>
            <a href='events.php' class='btn btn-primary'>Back to Events</a>
          </div>";
} else {
    echo "<div style='text-align: center; margin-top: 50px;'>
            <h1>Error purchasing the ticket. Please try again.</h1>
            <a href='details.php?id=$event_id' class='btn btn-primary'>Back to Event</a>
          </div>";
}
?>
