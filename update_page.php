<?php
require_once 'admin/config/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $pageId = intval($_POST['page_id']);
    $url = trim($_POST['url']);
    $title = trim($_POST['title']);
    $header = trim($_POST['header']);
    $footer = trim($_POST['footer']);
    $publish = isset($_POST['publish']) ? 1 : 0;

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
                // Prepare the SQL statement using a prepared statement
                $stmt = $conn->prepare("UPDATE pages SET url=?, title=?, header=?, banner=?, footer=?, published=? WHERE id=?");
                $stmt->bind_param("ssssssi", $url, $title, $header, $target_file, $footer, $publish, $pageId);

                // Execute the prepared statement
                if ($stmt->execute()) {
                    header("Location: success.php");
                } else {
                    echo "Error updating page: " . $stmt->error;
                }

                // Close the statement
                $stmt->close();
            } else {
                echo "Error uploading image";
            }
        } else {
            echo "Invalid image file";
        }
    } else {
        // Prepare the SQL statement using a prepared statement
        $stmt = $conn->prepare("UPDATE pages SET url=?, title=?, header=?, footer=?, published=? WHERE id=?");
        $stmt->bind_param("sssssi", $url, $title, $header, $footer, $publish, $pageId);

        // Execute the prepared statement
        if ($stmt->execute()) {
            header("Location: success.php");
        } else {
            echo "Error updating page: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }
}
?>
