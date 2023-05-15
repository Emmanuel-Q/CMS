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


// // Get all sections from the database
// function get_all_sections() {
//     global $conn;

//     $query = "SELECT * FROM sections";
//     $result = mysqli_query($conn, $query);

//     $sections = array();

//     while ($row = mysqli_fetch_assoc($result)) {
//         $sections[] = $row;
//     }

//     return $sections;
// }

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














?>