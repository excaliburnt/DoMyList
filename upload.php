<?php
require_once 'session.php';
// Check if image file is a actual image or fake image
if(isset($_POST["upload"])) {
	$target_dir = "images/";
	$target_file = $target_dir . basename($_FILES["imageUpload"]["name"]);
	echo $target_file;
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	$check = getimagesize($_FILES["imageUpload"]["tmp_name"]);
	if($check !== false) {
		echo "File is an image - " . $check["mime"] . ".";
		$uploadOk = 1;
	} else {
		echo "File is not an image.";
		$uploadOk = 0;
	}
	require 'db_conn.php';



	if(!$uploadOk){
	   echo 'error';
	}else {		
		if (move_uploaded_file($_FILES["imageUpload"]["tmp_name"], $target_file)) {
			echo "The file ". htmlspecialchars( basename( $_FILES["imageUpload"]["tmp_name"])). " has been uploaded.";
			if ($stmt = $conn->prepare("UPDATE users SET image=? WHERE username=?")) {
				$stmt -> bind_param('ss', $imagePath, $username);
				$imagePath = $target_file;
				$username = $_SESSION["username"];
				$success = $stmt -> execute();
			}
			else {
				echo "Error ". $conn->error;
			}
			
			$conn -> close();
		} else {
			echo "Sorry, there was an error uploading your file.";
		}
	}
}
header("Location: index.php");

?>