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
    <!--bootsrap style-->
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <!--custom style -->
    <link rel="stylesheet" href="./css/style.min.css">
    <!--font awsome link-->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <title>Home</title>
</head>
<body>
    <nav class=" bg-white d-flex justify-content-between  align-items-center ">
        <div class="inpt position-relative">
            <input type="search" class="rounded " placeholder="enter keyWord">
            <i class="fa-solid fa-search position-absolute translate-middle top-50"></i>
        </div>
       
        <div class="right d-flex align-items-center">
            <i class="fa-solid fa-moon me-2 darkMode "></i>
            <i class="fa-regular fa-bell fa-lg me-2"></i>
        </div>
    </nav>
    <main class="d-flex gap-3 ">
    <?php renderMenu($userName); ?>

        <section class="friends py-5 m-5 ">
            <h2 class="fs-1">Friends</h2>
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-12  mt-4">
                        <div class="cart shadow-lg  position-relative bg-white  py-4 px-3">
                 <div class="comunnicate-icon d-flex align-items-center position-absolute start-0 top-0 mt-2  ms-2  ">
                                <a href="#" class="me-2 btn btn-primary rounded-circle"><i class="fa-solid fa-phone"></i></a>
                                <a href="#" class="btn btn-primary rounded-circle"><i class="fa-regular fa-envelope"></i></a>
                            </div>
                            <div class="image mt-4">
                                <img class="w-25 rounded mx-auto d-block" src="./images/brunet-man-with-round-eyeglasses.jpg" alt="">
                            </div>
                        <div class="title border-bottom ">
                            <h4 class="text-center">Mohamed</h4>
                        </div>
                        <div class="info my-2 py-2  border-bottom">
                            <div class="icon">
                                <i class="fa-regular fa-face-smile fa-fw"></i>
                                <span> 99 Friend</span>
                            </div>
                            
                            <div class="icon">
                                <i class="fa-regular fa-newspaper fa-fw"></i>
                                <span> 25 Articles</span>
                            </div>
                        </div>
                           <div class="personal-info d-flex align-items-center justify-content-between   py-2 ">
                            <span>Joined 02/10/2021</span>
                            <div class="butns d-flex">
                                <a class="btn btn-primary me-2" style="font-size: 12px;">Profile</a>
                                <a class="btn btn-danger" style="font-size: 12px;">remove</a>
                            </div>
                           </div>
                        </div>
                  
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12  mt-4">
                        <div class="cart shadow-lg p-2 position-relative bg-white py-4 px-3">
                 <div class="comunnicate-icon d-flex align-items-center position-absolute start-0 top-0 mt-2   ms-2">
                                <a href="#" class="me-2 btn btn-primary rounded-circle"><i class="fa-solid fa-phone"></i></a>
                                <a href="#" class="btn btn-primary rounded-circle"><i class="fa-regular fa-envelope"></i></a>
                            </div>
                            <div class="image mt-4">
                                <img class="w-25 rounded mx-auto d-block" src="./images/young-bearded-man-with-striped-shirt.jpg" alt="">
                            </div>
                        <div class="title border-bottom ">
                            <h4 class="text-center">Mohamed</h4>
                        </div>
                        <div class="info my-2 py-2  border-bottom">
                            <div class="icon">
                                <i class="fa-regular fa-face-smile fa-fw"></i>
                                <span> 99 Friend</span>
                            </div>
                            
                            <div class="icon">
                                <i class="fa-regular fa-newspaper fa-fw"></i>
                                <span> 25 Articles</span>
                            </div>
                        </div>
                           <div class="personal-info d-flex align-items-center justify-content-between   py-2 ">
                            <span>Joined 02/10/2021</span>
                            <div class="butns d-flex">
                                <a class="btn btn-primary me-2" style="font-size: 12px;">Profile</a>
                                <a class="btn btn-danger" style="font-size: 12px;">remove</a>
                            </div>
                           </div>
                        </div>
                  
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12  mt-4">
                        <div class="cart shadow-lg p-2 position-relative bg-white py-4 px-3 ">
                 <div class="comunnicate-icon d-flex align-items-center position-absolute start-0 top-0 mt-2 ms-2 ">
                                <a href="#" class="me-2 btn btn-primary rounded-circle"><i class="fa-solid fa-phone"></i></a>
                                <a href="#" class="btn btn-primary rounded-circle"><i class="fa-regular fa-envelope"></i></a>
                            </div>
                            <div class="image mt-4">
                                <img class="w-25 rounded mx-auto d-block" src="./images/confident-handsome-man-extending-his-hand-handshake-smiling-determined.jpg" alt="">
                            </div>
                        <div class="title border-bottom ">
                            <h4 class="text-center">Mohamed</h4>
                        </div>
                        <div class="info my-2 py-2  border-bottom">
                            <div class="icon">
                                <i class="fa-regular fa-face-smile fa-fw"></i>
                                <span> 99 Friend</span>
                            </div>
                            
                            <div class="icon">
                                <i class="fa-regular fa-newspaper fa-fw"></i>
                                <span> 25 Articles</span>
                            </div>
                        </div>
                           <div class="personal-info d-flex align-items-center justify-content-between   py-2 ">
                            <span>Joined 02/10/2021</span>
                            <div class="butns d-flex">
                                <a class="btn btn-primary me-2" style="font-size: 12px;">Profile</a>
                                <a class="btn btn-danger" style="font-size: 12px;">remove</a>
                            </div>
                           </div>
                        </div>
                  
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12  mt-4">
                        <div class="cart shadow-lg p-2 position-relative bg-white py-4 px-3 ">
                 <div class="comunnicate-icon d-flex align-items-center position-absolute start-0 top-0 mt-2 ms-2 ">
                                <a href="#" class="me-2 btn btn-primary rounded-circle"><i class="fa-solid fa-phone"></i></a>
                                <a href="#" class="btn btn-primary rounded-circle"><i class="fa-regular fa-envelope"></i></a>
                            </div>
                            <div class="image mt-4">
                                <img class="w-25 rounded mx-auto d-block" src="./images/confident-handsome-man-extending-his-hand-handshake-smiling-determined.jpg" alt="">
                            </div>
                        <div class="title border-bottom ">
                            <h4 class="text-center">Mohamed</h4>
                        </div>
                        <div class="info my-2 py-2  border-bottom">
                            <div class="icon">
                                <i class="fa-regular fa-face-smile fa-fw"></i>
                                <span> 99 Friend</span>
                            </div>
                            
                            <div class="icon">
                                <i class="fa-regular fa-newspaper fa-fw"></i>
                                <span> 25 Articles</span>
                            </div>
                        </div>
                           <div class="personal-info d-flex align-items-center justify-content-between   py-2 ">
                            <span>Joined 02/10/2021</span>
                            <div class="butns d-flex">
                                <a class="btn btn-primary me-2" style="font-size: 12px;">Profile</a>
                                <a class="btn btn-danger" style="font-size: 12px;">remove</a>
                            </div>
                           </div>
                        </div>
            
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12  mt-4">
                        <div class="cart shadow-lg p-2 position-relative bg-white py-4 px-3">
                 <div class="comunnicate-icon d-flex align-items-center position-absolute start-0 top-0 mt-2   ms-2">
                                <a href="#" class="me-2 btn btn-primary rounded-circle"><i class="fa-solid fa-phone"></i></a>
                                <a href="#" class="btn btn-primary rounded-circle"><i class="fa-regular fa-envelope"></i></a>
                            </div>
                            <div class="image mt-4">
                                <img class="w-25 rounded mx-auto d-block" src="./images/young-bearded-man-with-striped-shirt.jpg" alt="">
                            </div>
                        <div class="title border-bottom ">
                            <h4 class="text-center">Mohamed</h4>
                        </div>
                        <div class="info my-2 py-2  border-bottom">
                            <div class="icon">
                                <i class="fa-regular fa-face-smile fa-fw"></i>
                                <span> 99 Friend</span>
                            </div>
                            
                            <div class="icon">
                                <i class="fa-regular fa-newspaper fa-fw"></i>
                                <span> 25 Articles</span>
                            </div>
                        </div>
                           <div class="personal-info d-flex align-items-center justify-content-between   py-2 ">
                            <span>Joined 02/10/2021</span>
                            <div class="butns d-flex">
                                <a class="btn btn-primary me-2" style="font-size: 12px;">Profile</a>
                                <a class="btn btn-danger" style="font-size: 12px;">remove</a>
                            </div>
                           </div>
                        </div>
                  
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script src="./js/home.js"></script>
   
   
</body>
</html>