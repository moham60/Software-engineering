<?php
session_start();
include('menu.php');
include('database.php');

// Retrieve logged-in user information
$userId = $_SESSION['user_id']; // Assuming `user_id` is stored in the session
$userRole = $_SESSION['role']; // Assuming `role` is stored in the session ('Doctor' or 'Student')

// Query for courses
if ($userRole === 'Doctor') {
    // Fetch courses for the logged-in doctor
    $query_courses = "SELECT CourseId, CourseName FROM Courses WHERE DoctorId = $userId";
} elseif ($userRole === 'Student') {
    // Fetch courses for the logged-in student using CourseStudents table
    $query_courses = "
        SELECT c.CourseId, c.CourseName 
        FROM Courses c
        JOIN CourseStudents cs ON cs.CourseId = c.CourseId
        WHERE cs.StudentId = $userId";
} else {
    die("Access denied.");
}

$result_courses = mysqli_query($conn, $query_courses);

// Debugging - Check if query ran successfully and if courses are returned
if ($result_courses === false) {
    echo "Error executing query: " . mysqli_error($conn);
    exit;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Assignments for a specific course">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <title>Assignments</title>
</head>
<body>
        <?php renderMenu($userName); ?>

        <section class="w-100">
            <div class="container assignments">
                <h2 class="fs-1 py-2">Assignments</h2>
                


                <div class="row gy-4">
                    <?php
                    // Loop through each course and fetch assignments
                    if (mysqli_num_rows($result_courses) > 0) {
                        while ($course = mysqli_fetch_assoc($result_courses)) {
                            $course_id = $course['CourseId'];
                            $course_name = $course['CourseName'];

                            // Fetch assignments for this course
                            $query_assignments = "SELECT * FROM Assignment WHERE CourseId = '$course_id'";
                            $result_assignments = mysqli_query($conn, $query_assignments);
                            ?>
                            
                            <div class="col-lg-8 col-md-7">
                                <h4><?php echo htmlspecialchars($course_name); ?></h4>
                                <div class="row gy-4 assignmentsRow">
                                    <?php
                                    if (mysqli_num_rows($result_assignments) > 0) {
                                        while ($assignment = mysqli_fetch_assoc($result_assignments)) {
                                            $file_path = "uploads/" . $assignment['Filename'];
                                            ?>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="card bg-white shadow-lg">
                                                    <div class="card-body">
                                                        <h5 class="fw-bolder"><?php echo htmlspecialchars($assignment['Title']); ?></h5>
                                                        <p>Deadline: <?php echo htmlspecialchars($assignment['Deadline']); ?></p>
                                                        <a href="download.php?id=<?php echo $assignment['AssignmentId']; ?>" class="btn btn-primary">Download</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    } else {
                                        echo "<p>No assignments available for this course.</p>";
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        echo "<p>No courses found.</p>";
                    }
                    ?>
                                        <?php if ($userRole === 'Doctor'): ?>
                        <!-- Upload Assignment Form -->
                        <div class="col-lg-4 col-md-5">
                            <form action="upload_assignment.php" method="POST" class="add-assignment bg-white shadow-lg p-4" enctype="multipart/form-data">
                                <!-- Dropdown for selecting course -->
                                <div class="form-group">
                                    <label for="course_id">Select Course</label>
                                    <select name="course_id" id="course_id" class="form-control" required>
                                        <option value="">Select a Course</option>
                                        <?php
                                        mysqli_data_seek($result_courses, 0);
                                        while ($course = mysqli_fetch_assoc($result_courses)) {
                                            echo "<option value='" . $course['CourseId'] . "'>" . htmlspecialchars($course['CourseName']) . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <!-- Other fields for assignment -->
                                <input type="file" name="file" class="form-control" id="uploadAssignment" required>
                                <input type="text" name="assignment_name" class="form-control mt-2" placeholder="Assignment Name" required>
                                <textarea name="description" class="form-control mt-2" placeholder="Assignment Description" required></textarea>
                                
                                <!-- Deadline field -->
                                <div class="form-group mt-2">
                                    <label for="deadline">Deadline</label>
                                    <input type="datetime-local" name="deadline" class="form-control" id="deadline" required>
                                </div>

                                <button type="submit" class="btn btn-primary mt-3">Upload Assignment</button>
                            </form>
                        </div>
                    <?php endif; ?>
                </div>
                </div>
            </div>
        </section>
    <script src="./js/home.js"></script>
    <script src="./js/assignment.js"></script>
</body>
</html>

<?php
mysqli_close($conn);
?>
