<?php include 'config/db_connect.php'; 

// Get all pages from the database
function get_all_pages() {
    global $conn;

    $query = "SELECT * FROM pages";
    $result = mysqli_query($conn, $query);

    $pages = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $pages[] = $row;
    }

    return $pages;
}

// Get all sections with corresponding page titles from the database
function get_all_sections_with_page_titles() {
    global $conn;

    $query = "SELECT s.id, p.title AS page_title, s.name, s.content, s.image FROM sections s INNER JOIN pages p ON s.page_id = p.id";
    $result = mysqli_query($conn, $query);

    $sections = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $sections[] = $row;
    }

    return $sections;
}

// Retrieve page data from database for updating
function get_page_by_id($pageId) {

    $sql = "SELECT * FROM pages WHERE id = $pageId";
    global $conn;

    $result = $conn->query($sql);

    // Check if the query was successful
    if ($result && $result->num_rows > 0) {
        $page = $result->fetch_assoc();

        return $page;
    } else {
        return null;
    }
}

// Function to get a section by ID
function get_section_by_id($sectionId) {
    global $conn;
    // Prepare the query
    $sql = "SELECT sections.*, pages.title AS page_title FROM sections
            INNER JOIN pages ON sections.page_id = pages.id
            WHERE sections.id = $sectionId";

    // Execute the query
    $result = $conn->query($sql);

    // Check if the query was successful
    if ($result && $result->num_rows > 0) {

        $section = $result->fetch_assoc();

        return $section;
    }

    // If no section is found, return null
    return null;
}

















?>