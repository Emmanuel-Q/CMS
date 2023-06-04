<?php require_once 'admin/config/db_connect.php'; ?>

<!DOCTYPE html>
<html>

<head>
    <title>My CMS</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<style>
    .error-container {
      text-align: center;
      margin-top: 140px;
    }

    .error-container h1 {
      font-size: 48px;
      margin-bottom: 20px;
    }

    .error-container p {
      font-size: 24px;
      margin-bottom: 20px;
    }

    .error-container a {
      font-size: 18px;
      text-decoration: none;
      color: #000;
      background-color: #88f8;
      padding: 10px 20px;
      border-radius: 4px;
    }
  </style>
<body>

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="home.php?url=home">My CMS</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <?php
            // Get the URL of the requested page
             $url = isset($_GET['url']) ? $_GET['url'] : 'home';

            // Display the pages in the navigation bar
            $result = $conn->query("SELECT * FROM pages WHERE published = 1");
            if ($result && $result->num_rows > 0) {
                echo "<ul class='navbar-nav ml-auto'>";
                while ($page = $result->fetch_assoc()) {
                    $active = ($url == $page['url']) ? 'active' : '';
                    echo "<li class='nav-item $active'><a class='nav-link' href='home.php?url=" . $page['url'] . "'>" . $page['title'] . "</a></li>";
                }
                echo "</ul>";
            }
            ?>
            <a href="admin/pages/samples/login.php" class="btn btn-primary">Login</a>
        </div>
    </nav>


  <div class="error-container">
    <h1>404</h1>
    <p>Oops! Page not found.</p>
    <a href="index.php">Go back to Homepage</a>
  </div>

</body>
</html>


