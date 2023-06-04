<?php
require_once 'admin/config/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $url = trim($_POST['url']);
    $title = trim($_POST['title']);
    $header = trim($_POST['header']);
    $footer = trim($_POST['footer']);
    $publishStatus = isset($_POST['publish']) ? 1 : 0;
    
    // Handle file upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["banner"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["banner"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }
    if ($uploadOk == 1 && ($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg" || $imageFileType == "gif")) {
        if (move_uploaded_file($_FILES["banner"]["tmp_name"], $target_file)) {
            // Prepare the SQL statement using a prepared statement
            $stmt = $conn->prepare("INSERT INTO pages (url, title, header, banner, footer, published) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssi", $url, $title, $header, $target_file, $footer, $publishStatus);

            // Execute the prepared statement
            if ($stmt->execute()) {
                header("Location: success.php");
            } else {
                echo "Error creating page: " . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "Error uploading image";
        }
    } else {
        echo "Invalid image file";
    }
}
?>
