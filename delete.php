<?php
session_start();
include 'db_connection.php';

if (isset($_GET['id'])) {
    $eventId = $_GET['id'];
    $userId = $_SESSION['user_id']; // Get the logged-in user's ID

    // Fetch the event's creator ID from the database
    $sqlFetch = "SELECT organizer_id FROM events WHERE id = :id";
    $stmtFetch = $conn->prepare($sqlFetch);
    $stmtFetch->bindParam(':id', $eventId);
    $stmtFetch->execute();
    $event = $stmtFetch->fetch(PDO::FETCH_ASSOC);

    if ($event && $event['organizer_id'] == $userId) {
        // User is the creator of the event, proceed with deletion

        // Delete dependent rows in the tickets table
        $sqlTickets = "DELETE FROM tickets WHERE event_id = :event_id";
        $stmtTickets = $conn->prepare($sqlTickets);
        $stmtTickets->bindParam(':event_id', $eventId);
        $stmtTickets->execute();

        // Delete the event
        $sqlEvent = "DELETE FROM events WHERE id = :id";
        $stmtEvent = $conn->prepare($sqlEvent);
        $stmtEvent->bindParam(':id', $eventId);
        $stmtEvent->execute();

        header("Location: events.php");
        exit();
    } else {
        // User is not the creator of the event, deny the deletion
        header("Location: events.php?error=not_authorized");
        exit();
    }
} else {
    header("Location: events.php");
    exit();
}
?>