<?php
    require_once '../config/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pageId = $_POST['page_id'];
    $url = $_POST['url'];
    $title = $_POST['title'];
    $header = $_POST['header'];
    $footer = $_POST['footer'];

    // Check if a new image is uploaded
    if ($_FILES['banner']['error'] !== UPLOAD_ERR_NO_FILE) {
        // Handle file upload
        $target_dir = 'uploads/';
        $target_file = $target_dir . basename($_FILES["banner"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowedExtensions = array("jpg", "jpeg", "png", "gif");

        // Check if the uploaded file is an image
        if (in_array($imageFileType, $allowedExtensions)) {
            if (move_uploaded_file($_FILES["banner"]["tmp_name"], $target_file)) {
                // Update page with new image in the database
                $sql = "UPDATE pages SET url='$url', title='$title', header='$header', banner='$target_file', footer='$footer' WHERE id='$pageId'";
                if ($conn->query($sql) === TRUE) {
                    echo "Page updated successfully";
                } else {
                    echo "Error updating page: " . $conn->error;
                }
            } else {
                echo "Error uploading image";
            }
        } else {
            echo "File is not an image";
        }
    } else {
        // Update page without changing the image in the database
        $sql = "UPDATE pages SET url='$url', title='$title', header='$header', footer='$footer' WHERE id='$pageId'";
        if ($conn->query($sql) === TRUE) {
            echo "Second Page updated successfully";
        } else {
            echo "Error updating page: " . $conn->error;
        }
    }
}



?>