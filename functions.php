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
    require_once 'config/db_connect.php';
    
    $query = "SELECT sections.id, sections.name, sections.content, sections.image, sections.page_id, sections.published, pages.title AS page_title FROM sections INNER JOIN pages ON sections.page_id = pages.id";
    $result = $conn->query($query);
    
    if ($result) {
        $sections = array();
        
        while ($row = $result->fetch_assoc()) {
            $sections[] = $row;
        }
        
        return $sections;
    } else {
        echo "Error retrieving sections: " . $conn->error;
        return array();
    }
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


 // Function to get the count of published pages
 function get_published_pages_count() {
    global $conn;

     $query = "SELECT COUNT(*) AS count FROM pages WHERE published = 1";
     $result = $conn->query($query);

     if ($result && $result->num_rows > 0) {
         $row = $result->fetch_assoc();
         return $row['count'];
     } else {
         return 0;
     }
 }

  // Count the number of published pages
  $publishedPagesCount = get_published_pages_count();


    // Function to get the count of total pages
    function get_total_pages_count() {
        global $conn;

        $query = "SELECT COUNT(*) AS count FROM pages";
        $result = $conn->query($query);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['count'];
        } else {
            return 0;
        }
    }

    // Count the number of pages created
    $totalPagesCount = get_total_pages_count();


     // Function to get the count of total unpublished pages
     function get_total_unpublished_pages_count() {
        global $conn;

         $query = "SELECT COUNT(*) AS count FROM pages WHERE published = 0";
         $result = $conn->query($query);
 
         if ($result && $result->num_rows > 0) {
             $row = $result->fetch_assoc();
             return $row['count'];
         } else {
             return 0;
         }
     }

        // Count the number of unpublished pages
        $totalUnpublishedPagesCount = get_total_unpublished_pages_count();


    // Function to get the count of total sections
    function get_total_sections_count() {
        global $conn;

        $query = "SELECT COUNT(*) AS count FROM sections";
        $result = $conn->query($query);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['count'];
        } else {
            return 0;
        }
    }

    // Count the number of sections
    $totalSectionsCount = get_total_sections_count();


     // Function to get the count of published sections
     function get_published_sections_count() {
         global $conn;

         $query = "SELECT COUNT(*) AS count FROM sections WHERE published = 1";
         $result = $conn->query($query);
 
         if ($result && $result->num_rows > 0) {
             $row = $result->fetch_assoc();
             return $row['count'];
         } else {
             return 0;
         }
     }

       // Count the number of published sections
       $publishedSectionsCount = get_published_sections_count();


// Function to get the count of unpublished sections
function get_unpublished_sections_count() {
    global $conn;

    $query = "SELECT COUNT(*) AS count FROM sections WHERE published = 0";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['count'];
    } else {
        return 0;
    }
}

// Count the number of unpublished sections
$unpublishedSectionsCount = get_unpublished_sections_count();



// Function to retrieve only published pages from the database
function get_published_pages() {
   global $conn;

    $sql = "SELECT * FROM pages WHERE published = 1";
    $result = $conn->query($sql);

    $pages = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $pages[] = $row;
        }
    }

    return $pages;
}



// Function to retrieve only unpublished pages from the database
function get_unpublished_pages() {
    global $conn;

    $sql = "SELECT * FROM pages WHERE published = 0";
    $result = $conn->query($sql);

    $pages = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $pages[] = $row;
        }
    }

    return $pages;
}

// Function to get published sections with page titles
function get_published_sections_with_page_titles() {
   global $conn;

    // Fetch published sections with page titles from the database
    $sql = "SELECT sections.*, pages.title AS page_title 
            FROM sections 
            INNER JOIN pages ON sections.page_id = pages.id 
            WHERE sections.published = 1";
    $result = $conn->query($sql);

    $sections = array();
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $sections[] = $row;
        }
    }

    return $sections;
}

// Function to get unpublished sections with page titles
function get_unpublished_sections_with_page_titles() {
    global $conn;

    // Fetch unpublished sections with page titles from the database
    $sql = "SELECT sections.*, pages.title AS page_title 
            FROM sections 
            INNER JOIN pages ON sections.page_id = pages.id 
            WHERE sections.published = 0";
    $result = $conn->query($sql);

    $sections = array();
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $sections[] = $row;
        }
    }

    return $sections;
}









?>