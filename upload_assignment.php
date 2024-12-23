<?php
// Check if the form has been submitted and if the file is uploaded
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if a file was uploaded without errors
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
        $target_dir = "uploads/"; // Directory for uploaded files
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Allowed file types
        $allowed_types = array("jpg", "jpeg", "png", "gif", "pdf", "pptx", "docx");
        if (!in_array($file_type, $allowed_types)) {
            echo "Sorry, only JPG, JPEG, PNG, GIF, PDF, PPTX, and DOCX files are allowed.";
        } else {
            // Move the uploaded file to the target directory
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                // File upload success
                $filename = $_FILES["file"]["name"]; // Save the filename
                $assignment_name = $_POST["assignment_name"];
                $description = $_POST["description"];
                $upload_date = date('Y-m-d H:i:s'); // Current timestamp
                $course_id = $_POST["course_id"]; // Get the course ID from the form
                $deadline = $_POST["deadline"]; // Get the deadline from the form

                // Database connection
                include('database.php');

                // Insert the file and assignment information into the database
                $sql = "INSERT INTO Assignment (CourseId, Title, FileType, Filename, UploadBy, UploadDate, Deadline) 
                        VALUES ('$course_id', '$assignment_name', '$file_type', '$filename', '1', '$upload_date', '$deadline')"; // Assuming '1' is the ID of the doctor (you can adjust this based on session or user login)

                if ($conn->query($sql) === TRUE) {
                    echo "The assignment has been uploaded and stored in the database.";
                } else {
                    echo "Sorry, there was an error uploading your file and storing information in the database: " . $conn->error;
                }

                $conn->close();
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        echo "No file was uploaded.";
    }
}
?>
