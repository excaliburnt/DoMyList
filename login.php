<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration system</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
    <h2>Login</h2>
  </div>

  <form method="post" action="login.php">
    <?php include('errors.php'); ?>
    <div class="input-group">
      <label>Username</label>
      <input type="text" name="username" required>
    </div>
    <div class="input-group">
  		<label>Password</label>
  		<input type="password" name="password" required>
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="login_user">Login</button>
  	</div>
    <p>
      Not a user? <a href="register.php">Sign up</a>
    </p>
    <p>
    <a href="changepassword.php">Change password</a>
  </p>
  </form>
</body>
</html>
