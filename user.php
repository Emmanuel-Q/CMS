<!DOCTYPE html>
<html>
<head>
  <title>Login Page</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <style>
    .login-form {
      width: 300px;
      margin: 0 auto;
      margin-top: 150px;
    }
  </style>
</head>
<body>
  <div class="login-form">
    <h2 class="text-center">Login</h2>
    <form action="login.php" method="post">
      <div class="form-group">
        <input type="text" name="username" class="form-control" placeholder="Username" required="required">
      </div>
      <div class="form-group">
        <input type="password" name="password" class="form-control" placeholder="Password" required="required">
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-primary btn-block">Log in</button>
      </div>
    </form>
  </div>
</body>
</html>
