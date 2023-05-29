<?php
require_once 'admin/config/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $content = $_POST['content'];
    $page_id = $_POST['page_id'];
    $publish = isset($_POST['publish']) ? 1 : 0;

    $target_file = "";
    if ($_FILES["image"]["size"] > 0) {
        // Handle file upload
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }
        if ($uploadOk == 1 && ($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg" || $imageFileType == "gif")) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                // Image uploaded successfully
            } else {
                echo "Error uploading image";
                exit;
            }
        } else {
            echo "Invalid image file";
            exit;
        }
    }

    // Insert the section into the database
    $sql = "INSERT INTO sections (name, content, image, page_id, published) VALUES ('$name', '$content', '$target_file', '$page_id', '$publish')";
    if ($conn->query($sql) === TRUE) {
        header("Location: success.php");
    } else {
        echo "Error creating section: " . $conn->error;
    }
}
?>
