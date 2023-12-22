<?php
include_once("../include/functions.php");
include_once("include/db.php");

if (isset($_GET['shortlink'])) {
    $shortLink = $_GET['shortlink'];

    // Query the database to get the corresponding file information
    $conn = connectDb();
    $query = "SELECT `servername`, `filename`, `size` FROM `uploads` WHERE `shortlink` = '$shortLink'";
    $result = mysqli_query($conn, $query);

    if ($result && $row = mysqli_fetch_assoc($result)) {
        $serverName = $row['servername'];
        $originalName = $row['filename'];
        $filePath = '../uploads/' . $serverName;
        $fileSize = $row['size'];

        // Check if the file exists
        if (file_exists($filePath)) {
            // Set headers for displaying the file
            header('Content-Description: File Display');
            header('Content-Type: application/octet-stream'); // Change content type based on your file types
            header('Content-Disposition: inline; filename="' . $originalName . '"');
            header('Content-Length: ' . $fileSize);

            // Output the file
            readfile($filePath);
            exit;
        } else {
            echo 'File not found.';
        }
    } else {
        echo 'Short link not found.';
    }
} else {
    echo 'Invalid request.';
}
?>
