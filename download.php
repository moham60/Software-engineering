<?php
// Include database connection
include('database.php');

// Check if the 'id' parameter is provided
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $assignment_id = intval($_GET['id']); // Securely cast to integer

    // Fetch the filename from the database
    $query = "SELECT Filename FROM Assignment WHERE AssignmentId = $assignment_id";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) === 1) {
        $assignment = mysqli_fetch_assoc($result);
        $file_path = "uploads/" . $assignment['Filename']; // Use Filename column for the file path

        // Check if the file exists
        if (file_exists($file_path)) {
            // Clear output buffer to prevent corruption
            if (ob_get_level()) {
                ob_end_clean();
            }

            // Get MIME type of the file
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime_type = finfo_file($finfo, $file_path);
            finfo_close($finfo);

            // Send appropriate headers to force the download
            header('Content-Description: File Transfer');
            header('Content-Type: ' . $mime_type);
            header('Content-Disposition: attachment; filename="' . basename($file_path) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file_path));

            // Read the file and output its contents
            readfile($file_path);
            exit;
        } else {
            echo "Error: File not found on the server.";
        }
    } else {
        echo "Error: Invalid file ID.";
    }
} else {
    echo "Error: No file ID provided.";
}

// Close database connection
mysqli_close($conn);
?>
