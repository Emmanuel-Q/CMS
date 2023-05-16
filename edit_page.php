<?php require_once 'config/db_connect.php';
    include 'functions.php';

// Retrieve the page data based on the ID
$pageId = $_GET['id']; 
$page = get_page_by_id($pageId);

if (!$page) {
    // Handle the case when the page is not found
    echo "Page not found.";
    exit;
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

    <div class="container mt-5">
        <h2 class="text-center">Edit Page</h2>
        <a href="admin.php" class="btn btn-primary">Back</a>
        <form method="POST" enctype="multipart/form-data" action="update_page.php">
            <input type="hidden" name="page_id" value="<?php echo $page['id']; ?>">
            
            <div class="form-group">
                <label for="url">URL</label>
                <input type="text" name="url" id="url" class="form-control" value="<?php echo $page['url']; ?>">
            </div>
            
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="<?php echo $page['title']; ?>">
            </div>
            
            <div class="form-group">
                <label for="header">Header</label>
                <textarea name="header" id="header" class="form-control"><?php echo $page['header']; ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="footer">Footer</label>
                <textarea name="footer" id="footer" class="form-control"><?php echo $page['footer']; ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="banner">Banner Image</label>
                <input type="file" name="banner" id="banner" class="form-control">
            </div>
            
            <button type="submit" class="btn btn-success">Update Page</button>
        </form> 
    </div>

     <!-- Scripts -->
     <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>

