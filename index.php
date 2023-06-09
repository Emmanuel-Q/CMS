<?php require_once 'admin/config/db_connect.php';

// Get the URL of the requested page
$url = isset($_GET['url']) ? $_GET['url'] : 'home';

// Fetch published pages from the database
$result = $conn->query("SELECT * FROM pages WHERE url = '$url' AND published = 1 LIMIT 1");

// If no matching page is found, redirect to the 404 page
if (!$result || $result->num_rows === 0) {
    http_response_code(404);
    include('404.php');
    exit();
}

?>


<!DOCTYPE html>
<html>

<head>
    <title>My CMS</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php?url=home">My CMS</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <?php

            // Display the pages in the navigation bar
            $result = $conn->query("SELECT * FROM pages WHERE published = 1");
            if ($result && $result->num_rows > 0) {
                echo "<ul class='navbar-nav ml-auto'>";
                while ($page = $result->fetch_assoc()) {
                    $active = ($url == $page['url']) ? 'active' : '';
                    echo "<li class='nav-item $active'><a class='nav-link' href='index.php?url=" . $page['url'] . "'>" . $page['title'] . "</a></li>";
                }
                echo "</ul>";
            }
            ?>
            <a href="admin/pages/samples/login.php" class="btn btn-primary">Login</a>
        </div>
    </nav>

    <!-- Header Section -->
    <div class="jumbotron jumbotron-fluid p-0 m-0 position-relative">
        <?php
        // Get the page content
        $result = $conn->query("SELECT * FROM pages WHERE url = '$url' AND published = 1 LIMIT 1");
        if ($result && $result->num_rows > 0) {
            $page = $result->fetch_assoc();
            $page_id = $page['id'];
            ?>
            
        <!-- <div class="container-fluid"> -->
            <img src="<?= $page['banner'] ?>" class="img-fluid w-100" style="height: 450px;" alt="Banner">
            <div class="overlay"></div>
            <div class="content position-absolute top-50 start-50 translate-middle text-center" style="z-index: 2; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                <h2 class="text-center text-white"><?= $page['title'] ?></h2>
                <p class="text-center text-white"><?= $page['header'] ?></p>
            </div>
        <!-- </div> -->
    </div>

    <div class="container mt-4">
        <?php
        // Fetch published sections from the database
        $sections = $conn->query("SELECT * FROM sections WHERE published = 1 AND page_id = $page_id");

        while ($section = $sections->fetch_assoc()) {
            ?>
            <div class="row">
                <div class="col-md-6">
                    <img src="<?= $section['image'] ?>" class="img-fluid mb-4" alt="Image">
                </div>
                <div class="col-md-6">
                    <h3><?= $section['name'] ?></h3>
                    <p><?= $section['content'] ?></p>
                </div>
            </div>
            <hr>
            <?php
        }
        ?>

        <?php
        if ($sections->num_rows === 0) {
            echo "No published sections found";
        }
        ?>
    </div>

    <footer class="bg-dark text-white py-3">
        <div class="container">
            <div class="row">
            <div class="col-12 col-md-6">
                <p><?= $page['footer'] ?></p>
                <p class="mb-0">© 2023 My Company, Inc. All rights reserved.</p>
            </div>
            <div class="col-12 col-md-6">
                <ul class="list-unstyled mb-0 d-flex justify-content-end">
                <li class="mx-3"><a href="#" class="text-white">Privacy Policy</a></li>
                <li class="mx-3"><a href="#" class="text-white">Terms of Service</a></li>
                <li class="mx-3"><a href="#" class="text-white">Contact Us</a></li>
                </ul>
            </div>
            </div>
        </div>
    </footer>


    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>
<?php } ?>