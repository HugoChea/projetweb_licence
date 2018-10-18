<?php
	$dsn = 'mysql:host=localhost;dbname=projetweb;charset=utf8';
	$login = 'root';
	$pass = '';
	try{
		$dbh = new PDO($dsn, $login, $pass);
	}
	catch(PDOException $e) {
		print "Erreur! :".$e->getMessage()."<br/>";
		die();
	}
?>
