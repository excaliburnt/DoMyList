<?php

if(isset($_POST['id'])){
    require '../db_conn.php';

    $id = $_POST['id'];

    if(empty($id)){
       echo 'error';
    }else {
        $todos = $conn->prepare("SELECT id, checked FROM todos WHERE id=?");
		$todos -> bind_param('i', $idSql);
		$idSql=$id;
        $todos->execute();
		$res=$todos->get_result();

        $todo = $res->fetch_assoc();
        $uId = $todo['id'];
        $checked = $todo['checked'];

        $uChecked = $checked ? 0 : 1;

        $res = $conn->query("UPDATE todos SET checked=$uChecked WHERE id=$uId");

        if($res){
            echo $checked;
        }else {
            echo "error";
        }
		$todos -> close();
        $conn -> close();
        exit();
    }
}else {
    header("Location: ../index.php?mess=error");
}