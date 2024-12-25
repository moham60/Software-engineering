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
    <meta name="description" content="home page after success login">
    <!-- Bootstrap Style -->
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <!-- Custom Style -->
    <link rel="stylesheet" href="./css/style.min.css">
    <!-- Font Awesome Link -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <title>Home</title>
</head>
<body>
    <?php renderMenu($userName); ?>

    <section class="w-100">
        <div class="container">
          <h2 class="fs-1">Material</h2>
          <div class="row gy-4">
            <div class="col-lg-8 col-md-7">
              <div class="row gy-4 materialRow"></div>
            </div>
            <div class="col-lg-4 col-md-5">
              <div class="add-material bg-white shadow-lg p-4">
                <button class="my-2 btn btn-success" id="addMaterial">
                  Add Material
                </button>
                <input type="file" class="form-control" id="uploadMaterial" />
                <div class="info mt-2">
                  <div
                    class="pdf-files d-none d-flex align-items-center justify-content-between w-100"></div>
                  <div
                    class="pdf-powerPoint d-none d-flex align-items-center justify-content-between"></div>
                  <div
                    class="images-files d-none d-flex align-items-center justify-content-between"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

    <script src="./js/home.js"></script>
    <script src="./js/setting.js"></script>
</body>
</html>
