<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $sectionId = $_POST['section_id'];

    // Retrieve the form data
    $name = $_POST['name'];
    $content = $_POST['content'];
    $image = $_FILES['image']['name'];
    $pageId = $_POST['page_id'];

    // Handle file upload
    if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $targetFile);
    }

    require_once 'config/db_connect.php';

    // Prepare the update query
    $sql = "UPDATE sections SET name = '$name', content = '$content', page_id = '$pageId'";
    
    // Check if a new image was uploaded
    if ($image) {
        $sql .= ", image = '$targetFile'";
    }

    $sql .= " WHERE id = '$sectionId'";

    // Execute the update query
    if ($conn->query($sql) === TRUE) {
        echo "Section updated successfully";
    } else {
        echo "Error updating section: " . $conn->error;
    }

}
?>