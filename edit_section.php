<?php
    require_once 'config/db_connect.php';
    include 'functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    // Retrieve the section ID from the URL
    $sectionId = $_GET['id'];

    // Fetch the section details from the database
    $section = get_section_by_id($sectionId);
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
        <?php
        // Check if the section exists
        if ($section) {
            // Display the form to edit the section
            ?>
        <h2 class="text-center">Edit Section</h2>
        <a href="admin.php" class="btn btn-primary">Back</a>
        <form method="POST" action="update_section.php" enctype="multipart/form-data">
            <input type="hidden" name="section_id" value="<?php echo $section['id']; ?>">
            <div class="form-group">
                <label>Name:</label>
                <input type="text" class="form-control" name="name" value="<?php echo $section['name']; ?>" required>
            </div>
            <div class="form-group">
                <label>Content:</label>
                <textarea name="content" class="form-control" rows="5"
                    required><?php echo $section['content']; ?></textarea>
            </div>
            <div class="form-group">
                <label>Image:</label>
                <input type="file" class="form-control" name="image">
            </div>
            <div class="form-group">
                <label>Page:</label>
                <select name="page_id" class="form-control" required>
                    <?php
                    // Fetch all pages from the database
                    $pages = get_all_pages();

                    foreach ($pages as $page) {
                        $selected = ($page['id'] == $section['page_id']) ? 'selected' : '';
                        echo "<option value='" . $page['id'] . "' $selected>" . $page['title'] . "</option>";
                    }
                    ?>
                </select>
            </div>
                <button class="btn btn-success" type="submit">Update Section</button>

            <?php
                    } else {
                            echo "Section not found";
                    }
                }
                ?>
        </form>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>