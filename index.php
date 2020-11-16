<?php
require_once 'session.php';
require 'db_conn.php';
$stmt= $conn -> prepare("SELECT image FROM users WHERE username=?");
$stmt -> bind_param('s', $username);
$username = $_SESSION["username"];
$success = $stmt -> execute();
$imagePath = "";
if ($success) {
	$result = $stmt->get_result();
	$imagePath = $result -> fetch_assoc()["image"];
}
else {
	echo "Query failed".$stmt->error;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>To-Do List</title>
    <link rel="stylesheet" href="css/style.css">
	<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet">
</head>
<body>

  
		<form action="session.php" method="get">
			<input id="logout" type="submit" name="logout" value="Logout">
		</form>

<div id="flexMain">
	<section id="userInfo">
		
		<img src="<?php echo $imagePath;?>">
		<?php echo "<span id='userName'>Hello</span> ".$_SESSION["username"]; ?>
		<hr>
		<form method="post" action="upload.php"  enctype="multipart/form-data">
			<div>
				<input type="file" name="imageUpload" accept="image/*">
			</div>
		<input type="submit" name="upload" value="upload image">
        </form>
    </section>
	
   <main>
		<h1>Do My List</h1>
		<div class="add-section">
          <form action="app/add.php" method="POST" autocomplete="off">
             <?php if(isset($_GET['mess']) && $_GET['mess'] == 'error'){ ?>
                <input type="text"
                     name="title"
                     style="border-color: #ff6666"
                     placeholder="This field is required" />
              <button type="submit">Add &nbsp; <span>&#43;</span></button>

             <?php }else{ ?>
              <input type="text"
                     name="title"
                     placeholder="what stuff do you need to do bro?" />
              <button type="submit">Add &nbsp; <span>&#43;</span></button>
             <?php } ?>
          </form>
       </div>

	   <!--Displays tasks-->
       <?php
          $stmt = $conn->prepare("SELECT * FROM todos WHERE username=? ORDER BY id DESC");
		  $stmt ->bind_param('s',$username);
		  $username=$_SESSION["username"];
		  $stmt->execute();
		  $todos=$stmt->get_result();

       ?>
       <div class="show-todo-section">
            <?php if($todos->num_rows<= 0){ ?>
                <div class="todo-item">
                    <div class="empty">
                        <h2>You have no tasks to do!</h2>
                    </div>
                </div>
            <?php }

			?>

            <?php while($todo = $todos->fetch_assoc()) { ?>
                <div class="todo-item">
                    <span id="<?php echo $todo['id']; ?>"
                          class="remove-to-do">x</span>
                    <?php if($todo['checked']){ ?>
                        <input type="checkbox"
                               class="check-box"
                               data-todo-id ="<?php echo $todo['id']; ?>"
                               checked />
                        <h2 class="checked"><?php echo $todo['title'] ?></h2>
                    <?php }else { ?>
                        <input type="checkbox"
                               data-todo-id ="<?php echo $todo['id']; ?>"
                               class="check-box" />
                        <h2><?php echo $todo['title'] ?></h2>
                    <?php } ?>
                    <br>
                    <small>created: <?php echo $todo['date_time'] ?></small>
                </div>
            <?php } ?>
       </div>
</div>
    <main>

    <script src="js/jquery-3.2.1.min.js"></script>

    <script>
        $(document).ready(function(){
            $('.remove-to-do').click(function(){
                const id = $(this).attr('id');
                $.post("app/remove.php",
                      {
                          id: id
                      },
                      (data)  => {
                         if(data){
                             $(this).parent().hide(600);
                         }
                      }
                );
            });

            $(".check-box").click(function(e){
                const id = $(this).attr('data-todo-id');

                $.post('app/check.php',
                      {
                          id: id
                      },
                      (data) => {
                          if(data != 'error'){
                              const h2 = $(this).next();
                              if(data === '1'){
                                  h2.removeClass('checked');
                              }else {
                                  h2.addClass('checked');
                              }
                          }
                      }
                );
            });
        });
    </script>
</body>
</html>
