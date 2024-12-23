<?php
session_start();
include('database.php');

// Ensure the user is logged in and is a student
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Student') {
    die("Access denied.");
}

// Check if a course ID is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['courseId'])) {
    $courseId = (int)$_POST['courseId'];
    $studentId = $_SESSION['user_id'];

    // Check if the student is already enrolled
    $checkQuery = "SELECT * FROM CourseStudents WHERE CourseId = ? AND StudentId = ?";
    $stmt = mysqli_prepare($conn, $checkQuery);
    mysqli_stmt_bind_param($stmt, 'ii', $courseId, $studentId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        echo "You are already enrolled in this course.";
        exit;
    }

    // Enroll the student
    $insertQuery = "INSERT INTO CourseStudents (CourseId, StudentId) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $insertQuery);
    mysqli_stmt_bind_param($stmt, 'ii', $courseId, $studentId);

    if (mysqli_stmt_execute($stmt)) {
        echo "Successfully joined the course!";
        header("Location: courses.php"); // Redirect back to courses
        exit;
    } else {
        echo "Error joining course: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
