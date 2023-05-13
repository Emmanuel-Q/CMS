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
            <button type='submit' class="btn btn-primary">Create Page</button>
        </form>
    </div>







<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
</body>
</html>