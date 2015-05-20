<?php
require_once "config/DBConfig.php"; 

	try
		{
			//Create Connection
			$conn = new PDO('mysql:host='.$DBhost.';dbname='.$DBname, $DBuser, $DBpass);
	
			//Delete Data
			$sql = "DELETE FROM t_member WHERE id = :id";
			$q = $conn->prepare($sql);
			$q->execute(array(':id'=>$_GET['id']));
		}
	catch (PDOException $pe)
		{
			die("Could not connect to the database $DBname :" . $pe->getMessage());
		}

echo "<script language=javascript>parent.location.href='rekap.php';</script>";
?>
