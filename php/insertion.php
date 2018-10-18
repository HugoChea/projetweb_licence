<?php
	session_start();
	if(!empty($_SESSION['login']) and !empty($_POST['message'])){	
		require("include/cobdd.php");
		$user=$_SESSION['login'];
		$msg=htmlentities($_POST['message']);
		try{
			$req=$dbh->prepare("INSERT INTO CHAT(PSEUDO,MES) VALUES (:user,:msg)");
			$req->execute(array(":user"=>$user,"msg"=>$msg));
		}
		catch(PDOException $e){
			print "Erreur!:".$e->getMessage()."</br>";
			die();
		}
	}
?>
