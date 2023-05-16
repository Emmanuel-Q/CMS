<?php 
  
    session_start();

    if (!isset($_SESSION['loggedin'])) {
        header('Location: user.php');
    }

    include 'config/db_connect.php'; 
    include 'functions.php';

?>


<!DOCTYPE html>
<html>
<head>
  <title>CMS Admin Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <!-- Bootstrap css CDN -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <!-- CKEditor -->
  <script src="js/ckeditor/ckeditor.js"></script>
</head>
<body class="m-4">

<!-- The navigation tabs -->
<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link active" data-toggle="tab" href="#dashboard">Dashboard</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#create_page">Create Page</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#create_section">Create Section</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#view_pages">View Pages</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#view_sections">View Sections</a>
  </li>
  <li class="nav-item ml-auto">
    <h5>Hello <?=$_SESSION['username']?>!</h5>
  </li>
  <li class="nav-item ml-2">
    <a href="logout.php" class="btn btn-danger"><i class="bi bi-box-arrow-left"></i> Logout</a>
  </li>
</ul>

<!-- Page content -->
<div class="tab-content">
  <div id="dashboard" class="tab-pane fade show active">
    <div class="main">
      <h1>Dashboard</h1>
      <p>This is the dashboard tab.</p>
    </div>
  </div>

  <!-- Section to create pages -->
  <div id="create_page" class="tab-pane fade">
    <div class="container"><br>
        <h2>Create Page</h2>
        <form action="page.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for='url'>URL:</label>
                <input type='text' name='url' id='url' class="form-control">
            </div>
            <div class="form-group">
                <label for='title'>Title:</label>
                <input type='text' name='title' id='title' class="form-control">
            </div>
            <div class="form-group">
                <label for='header'>Header:</label>
                <input type='text' name='header' id="header" class="form-control">
            </div>
            <div class="form-group">
                <label for='footer'>Footer:</label>
                <input type='text' name='footer' id='footer' class="form-control">
            </div>
            <div class="form-group">
                <label for='banner'>Banner:</label>
                <input type='file' name='banner' id='banner' class="form-control">
            </div>
            <button type='submit' class="btn btn-success">Create Page</button>
        </form>
    </div>
  </div><br>

  <!-- Create section page -->
  <div id="create_section" class="tab-pane fade">
  <div class="container">
        <form action="section.php" method="post" enctype="multipart/form-data">
            <h2>Create Section</h2>
            <div class="form-group">
                <label for='name'>Name:</label>
                <input type='text' name='name' id='name' class="form-control">
            </div>
            <div class="form-group">
                <label for='content'>Content:</label>
                <textarea name='content' id='editor' class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for='image'>Image:</label>
                <input type='file' name='image' id='image' class="form-control">
            </div>
            <div class="form-group">
                <label for='page_id'>Page:</label>
                <select name='page_id' id='page_id' class="form-control">
                    <?php $result = $conn->query("SELECT id, title FROM pages");
                        while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['id'] . "'>" . $row['title'] . "</option>";
                        } ?>
                </select>
            </div>
            <button type='submit' class="btn btn-success">Create Section</button>
        </form>
    </div>
  </div>

  <!-- Section to view all pages -->
  <div id="view_pages" class="tab-pane fade">
    <div class="">
        <table class="table table-hover">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>URL</th>
                <th>Header</th>
                <th>Footer</th>
                <th>Banner</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <h2>All Pages</h2>
            <?php
                // Fetch all pages from the database
                $pages = get_all_pages();

                foreach ($pages as $page) {
                    ?>
                    <tr>
                        <td><?php echo $page['id']; ?></td>
                        <td><?php echo $page['title']; ?></td>
                        <td><?php echo $page['url']; ?></td>
                        <td><?php echo $page['header']; ?></td>
                        <td><?php echo $page['footer']; ?></td>
                        <td><?php echo $page['banner']; ?></td>
                        <td>
                            <a href="edit_page.php?id=<?php echo $page['id']; ?>" title="Edit" class="btn btn-sm btn-warning"><i class="bi bi-pencil-square"></i></a>
                            <a href="delete_page.php?id=<?php echo $page['id']; ?>" title="Delete" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this page?')"><i class="bi bi-trash3"></i></a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>

  </div>

  <!-- View all sections page -->
  <div id="view_sections" class="tab-pane fade">
    <div class="">
        <table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Content</th>
                    <th>Image</th>
                    <th>Page</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <h2>All Sections</h2>
                <?php
                // Fetch all sections with corresponding page titles from the database
                $sections = get_all_sections_with_page_titles();

                foreach ($sections as $section) {
                    ?>
                    <tr>
                        <td><?php echo $section['id']; ?></td>
                        <td><?php echo $section['name']; ?></td>
                        <td><?php echo substr($section['content'], 0,80); ?></td>
                        <td><?php echo $section['image']; ?></td>
                        <td><?php echo $section['page_title']; ?></td>
                        <td>
                            <a href="edit_section.php?id=<?php echo $section['id']; ?>" title="Edit" class="btn btn-sm btn-warning"><i class="bi bi-pencil-square"></i></a>
                            <a href="delete_section.php?id=<?php echo $section['id']; ?>" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this section?')"><i class="bi bi-trash3"></i></i></a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>

    </div>
  </div>
</div>


<script>
     CKEDITOR.replace('editor');
</script>
</body>
</html>
