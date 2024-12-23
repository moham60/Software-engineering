<?php
session_start(); // Ensure session is started
include('menu.php');
include('database.php');    
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
<nav class="d-flex justify-content-between align-items-center">
      <div class="inpt position-relative">
        <input type="search" class="rounded" placeholder="enter keyWord" />
        <i
          class="fa-solid fa-search position-absolute translate-middle top-50"></i>
      </div>

      <div class="right d-flex align-items-center">
        <i class="fa-solid fa-moon me-2 darkMode"></i>
        <i class="fa-regular fa-bell fa-lg me-2"></i>
        <i class="fa-solid fa-right-from-bracket" id="logOut"></i>
      </div>
</nav>
<main class="d-flex">
    
<?php renderMenu($userName); ?>

<section class="w-100">
    <div class="container coursers">
        <h2 class="fs-1 py-2">Courses</h2>

        <!-- Check if user is a professor -->
        <?php if ($_SESSION['role'] === 'Doctor') { ?>
        <button class="btn btn-primary mb-4" id="addCourseButton" onclick="showCourseForm()">Add Course</button>
        
        <div id="courseForm" class="mb-4" style="display: none;">
            <form action="add_course.php" method="POST" class="shadow p-4 rounded bg-light">
                <div class="mb-3">
                    <label for="courseName" class="form-label">Course Name:</label>
                    <input type="text" id="courseName" name="courseName" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description:</label>
                    <textarea id="description" name="description" rows="4" class="form-control" required></textarea>
                </div>
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </div>

        <script>
            function showCourseForm() {
                document.getElementById("courseForm").style.display = "block";
            }
        </script>
        <?php } ?>

        <div class="row gy-4">
            <?php
            // Fetch courses from the database
            $query = "SELECT c.CourseId, c.CourseName, c.Description, u.FirstName, u.LastName FROM Courses c 
                      JOIN Users u ON c.DoctorId = u.UserId";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($course = mysqli_fetch_assoc($result)) {
                    // Get the number of students who joined the course
                    $courseId = $course['CourseId'];
                    $studentCountQuery = "SELECT COUNT(*) AS studentCount FROM CourseStudents WHERE CourseId = $courseId";
                    $studentCountResult = mysqli_query($conn, $studentCountQuery);
                    $studentCount = mysqli_fetch_assoc($studentCountResult)['studentCount'];
                    ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="card bg-white shadow-lg">
                            <div class="card-img-top">
                                <img class="w-100" src="./images/course-01.jpg" alt="Course Image">
                            </div>
                            <div class="card-body">
                                <h3 class="fw-bolder fs-5"><?php echo htmlspecialchars($course['CourseName']); ?></h3>
                                <p class="mt-3"><?php echo htmlspecialchars($course['Description']); ?></p>
                                <p><strong>Professor:</strong> <?php echo htmlspecialchars($course['FirstName']) . ' ' . htmlspecialchars($course['LastName']); ?></p>
                                <p><strong>Students Joined:</strong> <?php echo $studentCount; ?></p>
                                <?php if ($_SESSION['role'] === 'Student') { ?>
                                    <form action="join_course.php" method="POST">
                                        <input type="hidden" name="courseId" value="<?php echo $course['CourseId']; ?>">
                                        <button type="submit" class="btn btn-primary">Join Course</button>
                                    </form>
                                <?php } ?>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between position-relative">
                                <div class="badge bg-primary position-absolute translate-middle top-0 start-50">Course Info</div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<p>No courses available at the moment.</p>";
            }
            ?>
        </div>
    </div>
</section>
</main>
<script src="./js/home.js"></script>
<script src="./js/setting.js"></script>
</body>
</html>
