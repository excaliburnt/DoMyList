<?php
require 'db_conn.php'
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Do My List</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<main>
		<section class="add-section">
			<form action="">
				<input type="text" 
						name="title" 
						placeholder="Enter a task">
				<button type ="submit">Add &nbsp; <span>&#43; </span></button>
			</form>
		</section>
		<?php
			$domylist = $conn ->query("SELECT * FROM domylist ORDER BY id DESC");
		?>
		<section class="todo-section">
		<?php if($domylist->rowCount() <= 0){ ?>
			<div class="todo-item">
				<div class="empty">
					<h1>Add a task bro!</h1>
				</div>
			</div>
		<?php }?>
		
			<div class="todo-item">
			    <input type="checkbox">
				<h2>Workout</h2>
				<br>
				<small>11/6/2020</small>
			</div>
		</section>
	</main>
</body>
</html>