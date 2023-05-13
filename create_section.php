<?php   require_once 'config/db_connect.php';
// // HTML form for creating a new section
// echo "<form method='POST' enctype='multipart/form-data'>";
// echo "<label for='name'>Name:</label>";
// echo "<input type='text' name='name' id='name'>";
// echo "<label for='content'>Content:</label>";
// echo "<textarea name='content' id='content'></textarea>";
// echo "<label for='image'>Image:</label>";
// echo "<input type='file' name='image' id='image'>";
// echo "<label for='page_id'>Page:</label>";
// echo "<select name='page_id' id='page_id'>";
// $result = $conn->query("SELECT id, title FROM pages");
// while ($row = $result->fetch_assoc()) {
// echo "<option value='" . $row['id'] . "'>" . $row['title'] . "</option>";
// }
// echo "</select>";
// echo "<button type='submit'>Create Section</button>";
// echo "</form>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>Admin Panel</title>
</head>
<body>
    <div class="container">
        <form action="section.php" method="post" enctype="multipart/form-data">
            <h2>Create Section</h2>
            <div class="form-group">
                <label for='name'>Name:</label>
                <input type='text' name='name' id='name' class="form-control">
            </div>
            <div class="form-group">
                <label for='content'>Content:</label>
                <textarea name='content' id='content' class="form-control"></textarea>
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
            <div class="form-group">
                <button type='submit' class="btn btn-primary">Create Section</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
</body>
</html>