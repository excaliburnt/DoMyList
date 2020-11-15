<?php

if(isset($_POST['title'])){
    require '../db_conn.php';

    $title = $_POST['title'];

    if(empty($title)){
        header("Location: ../index.php?mess=error");
    }else {
        $stmt = $conn->prepare("INSERT INTO todos(title) VALUE(?)");
		$stmt->bind_param('s', $titleSql);
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