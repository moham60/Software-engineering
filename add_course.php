<?php
// Start the session and include necessary files
session_start();
include('database.php');

// Check if the user is logged in and is a Doctor
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Doctor') {
    die("Access denied.");
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $courseName = trim($_POST['courseName']);
    $description = trim($_POST['description']);
    $doctorId = $_SESSION['user_id']; // Assuming UserId is stored in session

    // Validate input
    if (empty($courseName) || empty($description)) {
        echo "All fields are required.";
        exit;
    }

    // Prepare the SQL query to insert the course
    $query = "INSERT INTO Courses (CourseName, Description, DoctorId, CreateDate, UpdateDate) 
              VALUES (?, ?, ?, NOW(), NOW())";

    // Use prepared statement to prevent SQL injection
    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt, 'ssi', $courseName, $description, $doctorId);

        // Execute the query
        if (mysqli_stmt_execute($stmt)) {
            echo "Course added successfully!";
            header("Location: courses.php"); // Redirect to the home page
            exit;
        } else {
            echo "Error adding course: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing statement: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
