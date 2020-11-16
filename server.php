<?php
  session_start();

  $username = "";
  $email = "";
  $errors = array();

  //connects to database
  $db = mysqli_connect('localhost', 'root', '', 'to_do_list');

  //register user
  if(isset($_POST['reg_user'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmpassword =  $_POST['confirmpassword'];

    //form validation
    if (empty($username)) {
      array_push($errors, "Username is required");
    }
    if (empty($email)) {
      array_push($errors, "Email is required");
    }
    if (empty($password)) {
      array_push($errors, "Password is required");
    }
    if ($password != $confirmpassword) {
  	   array_push($errors, "The two passwords do not match");
    }

    //checks if users already has account
    $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
      if ($user['username'] === $username) {
        array_push($errors, "Username already exists");
      }
      if ($user['email'] === $email) {
        array_push($errors, "email already exists");
      }
    }

    // Register user if there are no errors in the form
    if (count($errors) == 0) {
    	$query = "INSERT INTO users (username, email, password) VALUES('$username', '$email', '$password')";
    	mysqli_query($db, $query);
    	$_SESSION['username'] = $username;
    	$_SESSION['success'] = "You are now logged in";
    	header('location: index.php');
    }
  }

  // login user
  if (isset($_POST['login_user'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username)) {
    	array_push($errors, "Username is required");
    }
    if (empty($password)) {
    	array_push($errors, "Password is required");
    }

    if (count($errors) == 0) {
    	$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    	$results = mysqli_query($db, $query);
    	if (mysqli_num_rows($results) == 1) {
    	  $_SESSION['username'] = $username;
    	  $_SESSION['success'] = "You are now logged in";
    	  header('location: index.php');
    	} else {
    		array_push($errors, "Wrong username/password combination");
    	}
    }
  }

  // change password
  if(isset($_POST['change_password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $newpassword = $_POST['newpassword'];
    $confirmnewpassword = $_POST['confirmnewpassword'];

    if (empty($username)) {
    	array_push($errors, "Username is required");
    }
    if (empty($password)) {
    	array_push($errors, "Password is required");
    }
    if (empty($newpassword)) {
    	array_push($errors, "Password is required");
    }
    if (empty($confirmnewpassword)) {
    	array_push($errors, "Password is required");
    }

    if (count($errors) == 0) {
      $query = "SELECT * FROM users WHERE username='$username'";
      $results = mysqli_query($db, $query);
      $row = mysqli_fetch_array($results);
      if (!$results) {
        echo "<script> alert('Username does not exist')</script>";
      } else if ($_POST["password"] == $row["password"]) {
          if ($newpassword == $confirmnewpassword) {
            $querys = "UPDATE users SET password='$newpassword' WHERE username='$username'";
            $output = mysqli_query($db,$querys);
            echo "<script> alert('Congratulations you have successfully changed your password')</script>";
          } else {
              echo "<script> alert('Passwords must match')</script>";
            }
        } else {
            echo "<script> alert('Password is not correct')</script>";
          }
    }
  }
?>
