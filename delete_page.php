<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $pageId = $_GET['id'];

    require_once 'config/db_connect.php';

    // Prepare the delete query for deleting the page
    $deletePageQuery = "DELETE FROM pages WHERE id = $pageId";
    if ($conn->query($deletePageQuery) === TRUE) {
        // Delete all sections associated with the page
        $deleteSectionsQuery = "DELETE FROM sections WHERE page_id = $pageId";
        if ($conn->query($deleteSectionsQuery) === TRUE) {
            header("Location: success.php");
        } else {
            echo "Error deleting associated sections: " . $conn->error;
        }
    } else {
        echo "Error deleting page: " . $conn->error;
    }

}
?>
