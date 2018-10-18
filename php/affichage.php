<?php
	require("include/cobdd.php");
	session_start();
	try{
		$sql="SELECT * FROM CHAT ORDER BY ID_MES DESC LIMIT 10";
		$req=$dbh->query($sql);
		echo '<table>';
		foreach($req->FetchAll(PDO::FETCH_ASSOC) as $ligne){
			echo '<tr>';
			if($ligne['PSEUDO']==$_SESSION['login'])
				echo '<td class="msg_moi">'.$ligne['PSEUDO'].'</td>';
			else
				echo '<td class="msg_user">'.$ligne['PSEUDO'].'</td>';
			echo '<td class="msg_contenu">'.$ligne['MES'].'</td></tr>';
		}
		echo '</table>';
	}
	catch(PDOException $e){
		print "Erreur!:".$e->getMessage()."</br>";
		die();
	}
?>
