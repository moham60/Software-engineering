<?php
// Include your database connection file
include("menu.php");
session_start();
if (!isset($_SESSION['user_id'])) {
    // Handle the case where the user is not logged in
    header('Location: login.php'); // or any other page to redirect
    exit;
}

$userId = $_SESSION['user_id']; // Example session variable

// Example: Get the user's name (replace `1` with the logged-in user's ID)
$userName = getUserName($userId);

// The menu rendering function will be called inside the HTML section
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="home page after successful login">
    <!-- Bootstrap style -->
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <!-- Custom style -->
    <link rel="stylesheet" href="./css/style.min.css">
    <!-- Font Awesome link -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <title>Home</title>
</head>
<body>
        
    <?php renderMenu($userName); ?>

    <script src="./js/home.js"></script>
    <script src="./js/setting.js"></script>
</body>
</html>
