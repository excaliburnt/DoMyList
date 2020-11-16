<?php
require_once '../session.php';
if(isset($_POST['id'])){
    require '../db_conn.php';

    $id = $_POST['id'];

    if(empty($id)){
       echo 0;
    }else {
        $stmt = $conn->prepare("DELETE FROM todos WHERE id=?");
		$stmt->bind_param('i', $idSql);
		$idSql= (int)$id;
        $res = $stmt->execute();

        if($res){
            echo 1;
        }else {
            echo 0;
        }
		$stmt->close();
        $conn ->close();
        exit();
    }
}else {
    header("Location: ../index.php?mess=error");
}
