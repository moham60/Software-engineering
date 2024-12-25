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
    <section class="w-100">
        <div class="container">
          <h2 class="fs-1">Profile</h2>
          <h4 class="text-primary">Choose Profile Image</h4>
          <div class="chooseImage  my-4">
            <form action="" class="d-flex align-items-center">
    <div class="inpt ms-2">
               <input
                class="d-none"
                type="radio"
                name="chooseProfileImage"
                id="img1" />
              <label for="img1"
                ><img
                  class="rounded-circle"
                  width="30px"
                  src="./images/avatar.png"
                  alt=""
              /></label>
             
            </div>
            <div class="inpt ms-2">
               <input
                class="d-none"
                type="radio"
                name="chooseProfileImage"
                id="img2" />
              <label for="img2"
                ><img
                  class="rounded-circle"
                  width="30px"
                  
                  src="./images/friend-04.jpg"
                  alt=""
              /></label>
             
            </div>
            <div class="inpt ms-2">
              <input
                class="d-none"
                type="radio"
                name="chooseProfileImage"
                id="img3" />
              <label for="img3"
                ><img
                  class="rounded-circle"
                  width="30px"
                  src="./images/friend-02.jpg"
                  alt=""
              /></label>
              
            </div>
            <div class="inpt ms-2">
               <input
                class="d-none"
                type="radio"
                name="chooseProfileImage"
                id="img4" />
              <label for="img4"
                ><img
                  class="rounded-circle"
                  width="30px"
                  src="./images/friend-01.jpg"
                  alt=""
              /></label>
             
            </div>
            <button class="btn btn-success ms-3" id="saveChangeImage">Save Image</button>
            </form>
            
          </div>
          <div class="row gy-3">
            <div class="col-12 ">
              <div class="cart p-3  shadow-lg text-center">
                <p class="fs-3 text-primary">General Information</p>
                <div class="info">
                  <p class="fs-4">
                    Name: <span class="text-danger"><?php echo $userName ;?></span>
                  </p>
                  <p class="fs-4">
                    Gender: <span class="text-danger">None</span>
                  </p>
                  <p class="fs-4">
                    Country: <span class="text-danger">None</span>
                  </p>
                  <p class="fs-4">
                    Role: <span class="text-danger"><?php echo $_SESSION['role']; ?></span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-12 "> <div class="cart  p-3 shadow-lg text-center">
                <p class="fs-3 text-primary">Personal Information</p>
                <div class="info">
                  <p class="fs-4">
                    Email: <span class="text-danger"><?php echo $_SESSION['email']; ?></span>
                  </p>
                  <p class="fs-4">
                    Phone: <span class="text-danger">None</span>
                  </p>
                  <p class="fs-4">
                    Date Of Birth: <span class="text-danger">None</span>
                  </p>
                </div>
              </div></div>
             <div class="col-12 "> <div class="cart p-3  shadow-lg text-center">
                <p class="fs-3 text-primary">Job Information</p>
                <div class="info">
                  <p class="fs-4">
                    Title:
                    <span class="text-danger">None</span>
                  </p>
                  <p class="fs-4">
                    Programming Language:
                    <span class="text-danger">None</span>
                  </p>
                  <p class="fs-4">
                    Years of experience:
                    <span class="text-danger">None</span>
                  </p>
                </div>
              </div></div>
             
            </div>
          </div>
        </div>
      </section>
    <script src="./js/home.js"></script>
    <script src="./js/profile.js"></script>

</body>
</html>
