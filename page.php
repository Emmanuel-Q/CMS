<?php
require_once 'admin/config/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $url = $_POST['url'];
    $title = $_POST['title'];
    $header = $_POST['header'];
    $footer = $_POST['footer'];
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
    if ($uploadOk == 1 && $imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg" || $imageFileType == "gif") {
        if (move_uploaded_file($_FILES["banner"]["tmp_name"], $target_file)) {
            $sql = "INSERT INTO pages (url, title, header, banner, footer, published) VALUES ('$url', '$title', '$header', '$target_file', '$footer', '$publishStatus')";
            if ($conn->query($sql) === TRUE) {
                header("Location: success.php");
            } else {
                echo "Error creating page: " . $conn->error;
            }
        } else {
            echo "Error uploading image";
        }
    } else {
        echo "File is not an image";
    }
}


?>
