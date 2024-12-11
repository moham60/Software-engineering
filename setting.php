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
    <main class="d-flex">
        
    <?php renderMenu($userName); ?>

        
        <nav class="bg-white d-flex justify-content-between align-items-center">
            <div class="inpt position-relative">
                <input type="search" class="rounded" placeholder="Enter keyword">
                <i class="fa-solid fa-search position-absolute translate-middle top-50"></i>
            </div>
           
            <div class="right d-flex align-items-center">
                <i class="fa-solid fa-moon me-2 darkMode"></i>
                <i class="fa-regular fa-bell fa-lg me-2"></i>
            </div>
        </nav>
      
    </main>
    <script src="./js/home.js"></script>
</body>
</html>
