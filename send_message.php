<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include("database.php");
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$userId = $_SESSION['user_id'];
$recipientId = $_POST['recipient_id'];
$message = trim($_POST['message']);

if ($message && $recipientId) {
    // Use `mysqli` instead of `PDO`
    $insertQuery = "INSERT INTO Messaging (SenderId, RecipientId, Message) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($insertQuery);
    if ($stmt) {
        $stmt->bind_param("iis", $userId, $recipientId, $message); // "iis" = integer, integer, string
        $stmt->execute();
        $stmt->close();
    } else {
        // Log or handle the error
        echo "Error preparing statement: " . $conn->error;
    }
}

// Redirect back to the chat
header("Location: chat.php?friend_id=$recipientId");
exit;
?>
