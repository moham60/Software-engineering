<?php
include("menu.php");
include("database.php");
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$userId = $_SESSION['user_id'];
$friendId = $_GET['friend_id'] ?? null;

if (!$friendId) {
    echo "Friend ID is required.";
    exit;
}

// Fetch messages
$messagesQuery = "
    SELECT * FROM Messaging 
    WHERE (SenderId = ? AND RecipientId = ?)
       OR (SenderId = ? AND RecipientId = ?)
    ORDER BY CreateDate ASC
";
$stmt = $conn->prepare($messagesQuery);
$stmt->bind_param("iiii", $userId, $friendId, $friendId, $userId);
$stmt->execute();
$result = $stmt->get_result();
$messages = $result->fetch_all(MYSQLI_ASSOC);

// Fetch friend info
$friendQuery = "SELECT FirstName, LastName FROM Users WHERE UserId = ?";
$friendStmt = $conn->prepare($friendQuery);
$friendStmt->bind_param("i", $friendId);
$friendStmt->execute();
$friendResult = $friendStmt->get_result();
$friend = $friendResult->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.min.css">
    <title>Chat with <?php echo $friend['FirstName'] . ' ' . $friend['LastName']; ?></title>
</head>
<body>
        <?php renderMenu(getUserName($userId)); ?>
        
        <div class="container mt-4">
            <h2>Chat with <?php echo htmlspecialchars($friend['FirstName'] . ' ' . $friend['LastName']); ?></h2>
            
            <div class="chat-box border rounded p-3 mb-3" style="height: 300px; overflow-y: auto;">
                <?php foreach ($messages as $message): ?>
                    <div class="<?php echo $message['SenderId'] == $userId ? 'text-end' : 'text-start'; ?>">
                        <p class="mb-1"><strong><?php echo $message['SenderId'] == $userId ? 'You' : $friend['FirstName']; ?>:</strong></p>
                        <p class="bg-light p-2 rounded"><?php echo htmlspecialchars($message['Message']); ?></p>
                        <small class="text-muted"><?php echo $message['CreateDate']; ?></small>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <form action="send_message.php" method="POST" class="d-flex">
                <input type="hidden" name="recipient_id" value="<?php echo $friendId; ?>">
                <textarea name="message" class="form-control me-2" placeholder="Type your message..." required></textarea>
                <button type="submit" class="btn btn-primary">Send</button>
            </form>
        </div>
        <script src="./js/home.js"></script>
        <script src="./js/chat.js"></script>
</body>
</html>
