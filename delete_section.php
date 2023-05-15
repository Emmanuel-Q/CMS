<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    
    $sectionId = $_GET['id'];

    require_once 'config/db_connect.php';

    // Prepare the delete query
    $sql = "DELETE FROM sections WHERE id = $sectionId";

    // Execute the delete query
    if ($conn->query($sql) === TRUE) {
        echo "Section deleted successfully";
    } else {
        echo "Error deleting section: " . $conn->error;
    }

}
?>
