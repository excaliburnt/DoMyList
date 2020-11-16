<?php
require_once '../session.php';
if(isset($_POST['title'])){
    require '../db_conn.php';

    $title = $_POST['title'];

    if(empty($title)){
        header("Location: ../index.php?mess=error");
    }else {
        $stmt = $conn->prepare("INSERT INTO todos(username, title) VALUE(?,?)");
		$stmt->bind_param('ss', $userSql, $titleSql); //binds parameters to place holders
		$userSql = $_SESSION['username'];
		$titleSql=$title;
        $res = $stmt->execute();

        if($res){
            header("Location: ../index.php?mess=success"); 
        }else {
            header("Location: ../index.php");
        }
		$stmt->close();
        $conn->close();
        exit();
    }
}else {
    header("Location: ../index.php?mess=error");
}