<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sectionId = $_POST['section_id'];

    // Clean and sanitize the input
    $name = trim($_POST['name']);
    $content = ($_POST['content']);
    $pageId = intval($_POST['page_id']);
    $publish = isset($_POST['publish']) ? 1 : 0; 

    // Handle file upload
    if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $targetFile);

        // Clean and sanitize the file name
        $image = $targetFile;
    }

    require_once 'admin/config/db_connect.php';

    // Prepare the update query with placeholders
    $sql = "UPDATE sections SET name = ?, content = ?, page_id = ?, published = ?";

    // Check if a new image was uploaded
    if ($image) {
        $sql .= ", image = ?";
    }

    $sql .= " WHERE id = ?";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    // Bind the parameters
    $stmt->bind_param("ssiss", $name, $content, $pageId, $publish, $sectionId);

    // Execute the update query
    if ($stmt->execute()) {
        header("Location: success.php");
    } else {
        echo "Error updating section: " . $stmt->error;
    }

    // Close the statement and database connection
    $stmt->close();
    $conn->close();
}
?>
