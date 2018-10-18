<?php
	require('Utilisateur.php');
	require('include/cobdd.php');
	$a=new Utilisateur();
	if(isset($_GET["val"]) and strlen($_GET["val"])>5){
		$req = $dbh->prepare("SELECT ID_SERIE,TITRE_SERIE FROM SERIES WHERE SUBSTR(TITRE_SERIE,1,".strlen($_GET["val"]).")=?");
		$req->execute(array($_GET["val"]));
		$res = $req->fetchAll(PDO::FETCH_ASSOC);
		foreach($res as $ligne){
			echo "<li><a href='fiche_serie.php?id=".$ligne['ID_SERIE']."'>".$ligne['TITRE_SERIE']."</a></li>";
		}
		$recherche = explode(" ", $_GET['val']);
		if(isset($recherche[1])){
			$req = $dbh->prepare("SELECT ID_IND,NOM_IND,PREN_IND FROM INDIVIDUS WHERE SUBSTR(NOM_IND,1,".strlen($recherche[1]).")=? AND SUBSTR(PREN_IND,1,".strlen($recherche[0]).")=?");
			$req->execute(array($recherche[1],$recherche[0]));
			$res = $req->fetchAll(PDO::FETCH_ASSOC);
			foreach($res as $ligne){
				echo "<li><a href='fiche_individu.php?id=".$ligne['ID_IND']."'>".$ligne['PREN_IND']." ".$ligne['NOM_IND']."</a></li>";
			}
		}
		else{
			$req = $dbh->prepare("SELECT ID_IND,NOM_IND,PREN_IND FROM INDIVIDUS WHERE SUBSTR(PREN_IND,1,".strlen($_GET['val']).")=?");
			$req->execute(array($_GET['val']));
			$res = $req->fetchAll(PDO::FETCH_ASSOC);
			foreach($res as $ligne){
				echo "<li><a href='fiche_individu.php?id=".$ligne['ID_IND']."'>".$ligne['PREN_IND']." ".$ligne['NOM_IND']."</a></li>";
			}
		}
	}
	$a->search();
?>
