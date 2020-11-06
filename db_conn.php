 <?php
 
 $sName = "localhost";
 $uName = "root";
 $pass="";
 $db_name ="domylist";

 try{
	$conn = new PDO("mysql:host=$sName;db_name=$db_name",
					$uName, $pass);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	echo "You're connected dude!";
 }catch(PDOException $e){
   echo "Conection failed! : ". $e->getMessage();
 }