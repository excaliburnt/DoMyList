<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration system</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
    <h2>Change Password</h2>
  </div>

  <form method="post" action="changepassword.php">
    <?php include('errors.php'); ?>
    <div class="input-group">
      <label>Username</label>
      <input type="text" name="username">
    </div>
    <div class="input-group">
  		<label>Current Password</label>
  		<input type="password" name="password">
  	</div>
    <div class="input-group">
  		<label>New Password</label>
  		<input type="password" name="newpassword">
  	</div>
    <div class="input-group">
  		<label>Confirm Password</label>
  		<input type="password" name="confirmnewpassword">
  	</div>
  	<div class="input-group">
  		<button type="submit" name="change_password" class="btn">Change Password</button>
  	</div>
    <p>
      Alreadly a user? <a href="login.php">Sign in</a>
    </p>
  </form>
</body>
</html>
