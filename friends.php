<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Include your database connection file
include("menu.php");
include("database.php"); // Assuming your database connection is here
session_start();

if (!isset($_SESSION['user_id'])) {
    // Handle the case where the user is not logged in
    header('Location: login.php'); // or any other page to redirect
    exit;
}

$userId = $_SESSION['user_id']; // Example session variable

// Fetch the user's role and name from the database
$sql = "SELECT FirstName, LastName, Role FROM Users WHERE UserId = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $userData = $result->fetch_assoc();
    $userName = $userData['FirstName'] . ' ' . $userData['LastName'];
    $userRole = $userData['Role']; // Get the user's role (e.g., 'student', 'doctor')
} else {
    die("User not found");
}

// Remove friend logic
if (isset($_POST['remove_friend'])) {
    $friendId = $_POST['friend_id'];
    $sql = "DELETE FROM Friends WHERE (UserId = ? AND FriendId = ?) OR (UserId = ? AND FriendId = ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Error preparing the statement: " . $conn->error); // Debugging error
    }

    $stmt->bind_param("iiii", $userId, $friendId, $friendId, $userId);
    $stmt->execute();
    // echo "Friend removed successfully!";
}

// Add friend logic
if (isset($_POST['add_friend'])) {
    $potentialFriendId = $_POST['potential_friend_id'];

    // Prepare the query to add the friendship in both directions
    $sql = "INSERT INTO Friends (UserId, FriendId) VALUES (?, ?), (?, ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Error preparing the statement: " . $conn->error); // Debugging error
    }

    // Bind both directions: (userId, potentialFriendId) and (potentialFriendId, userId)
    $stmt->bind_param("iiii", $userId, $potentialFriendId, $potentialFriendId, $userId);

    if ($stmt->execute()) {
        // echo "Friend added successfully!";
    } else {
        echo "Error adding friend: " . $stmt->error;
    }
}


// Fetch the list of friends (both directions)
function getFriends($userId, $conn) {
    $sql = "
        SELECT u.UserId, CONCAT(u.FirstName, ' ', u.LastName) AS UserName, u.Email, u.Role 
        FROM Users u 
        INNER JOIN Friends f ON (f.UserId = u.UserId AND f.FriendId = ?)
        WHERE u.UserId != ?";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Error preparing the statement: " . $conn->error); // Debugging error
    }

    $stmt->bind_param("ii", $userId, $userId);
    $stmt->execute();
    return $stmt->get_result();
}

// Fetch potential friends (users who are not yet friends)
function getPotentialFriends($userId, $conn) {
    $sql = "
        SELECT u.UserId, CONCAT(u.FirstName, ' ', u.LastName) AS UserName, u.Email, u.Role 
        FROM Users u 
        WHERE u.UserId != ? AND u.UserId NOT IN (SELECT FriendId FROM Friends WHERE UserId = ?)";
    
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Error preparing the statement: " . $conn->error); // Debugging error
    }

    $stmt->bind_param("ii", $userId, $userId);
    $stmt->execute();
    return $stmt->get_result();
}

// Reload the list of friends and potential friends after any modification (add/remove friend)
$friends = getFriends($userId, $conn);
$potentialFriends = getPotentialFriends($userId, $conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="home page after success login">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <title>Home</title>
</head>
<body>
    
        <?php renderMenu($userName); ?>

        <section class="friends py-5 m-5">
            <h2 class="fs-1">Your Friends</h2>

            <div class="container">
                <div class="row">
                    <h3>Friends You Already Have:</h3>
                    <?php while ($friend = $friends->fetch_assoc()) { ?>
                        <div class="col-lg-4 col-md-6 col-sm-12 mt-4">
                            <div class="cart shadow-lg position-relative bg-white py-4 px-3">
                                <div class="title border-bottom">
                                    <h4 class="text-center"><?php echo $friend['UserName']; ?></h4>
                                </div>
                                <div class="info my-2 py-2 border-bottom">
                                    <div class="icon">
                                        <i class="fa-regular fa-envelope fa-fw"></i>
                                        <span> <?php echo $friend['Email']; ?></span>
                                    </div>
                                    <div class="icon">
                                        <i class="fa-solid fa-user fa-fw"></i>
                                        <span>Role: <?php echo ucfirst($friend['Role']); ?></span>
                                    </div>
                                </div>
                                <div class="personal-info d-flex align-items-center justify-content-between py-2">
                                    <form action="" method="post" class="d-inline">
                                        <input type="hidden" name="friend_id" value="<?php echo $friend['UserId']; ?>">
                                        <button type="submit" name="remove_friend" class="btn btn-danger" style="font-size: 12px;">Remove Friend</button>
                                    </form>
                                    <a href="chat.php?friend_id=<?php echo $friend['UserId']; ?>" class="btn btn-success" style="font-size: 12px;">Chat</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <h3>People You Can Add as Friends:</h3>
                    <?php while ($potentialFriend = $potentialFriends->fetch_assoc()) { ?>
                        <div class="col-lg-4 col-md-6 col-sm-12 mt-4">
                            <div class="cart shadow-lg position-relative bg-white py-4 px-3">
                                <div class="title border-bottom">
                                    <h4 class="text-center"><?php echo $potentialFriend['UserName']; ?></h4>
                                </div>
                                <div class="info my-2 py-2 border-bottom">
                                    <div class="icon">
                                        <i class="fa-regular fa-envelope fa-fw"></i>
                                        <span> <?php echo $potentialFriend['Email']; ?></span>
                                    </div>
                                    <div class="icon">
                                        <i class="fa-solid fa-user fa-fw"></i>
                                        <span>Role: <?php echo ucfirst($potentialFriend['Role']); ?></span>
                                    </div>
                                </div>
                                <div class="personal-info d-flex align-items-center justify-content-between py-2">
                                    <form action="" method="post" class="d-inline">
                                        <input type="hidden" name="potential_friend_id" value="<?php echo $potentialFriend['UserId']; ?>">
                                        <button type="submit" name="add_friend" class="btn btn-primary" style="font-size: 12px;">Add Friend</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </section>
    <script src="./js/home.js"></script>
</body>
</html>
