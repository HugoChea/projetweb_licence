<?php
class Individu
{
	public function __construct() // Constructeur
	{
	}

	public function afficheTitre($id)
	{
		require('include/cobdd.php');
		$req = $dbh->prepare('SELECT NOM_IND,PREN_IND FROM INDIVIDUS where ID_IND=?');
		$req->execute(array($id));
		$res = $req->fetchAll(PDO::FETCH_ASSOC);
		foreach($res as $ligne){
			echo $ligne['PREN_IND'].' '.$ligne['NOM_IND'];
		}
	}

	public function afficheFiche($id)
	{
		require('include/cobdd.php');
		$req = $dbh->prepare('SELECT URL FROM PHOTO_INDIVIDU where ID_IND=?');
		$req->execute(array($id));
		$res = $req->fetch(PDO::FETCH_ASSOC);
		return $res['URL'];
	}

	public function afficheCreateur($id)
	{
		require('include/cobdd.php');
		$req = $dbh->prepare('SELECT ID_SERIE,TITRE_SERIE FROM INDIVIDUS NATURAL JOIN CREER NATURAL JOIN SERIES where ID_IND=? and CREATEUR="X"');
		$req->execute(array($id));
		$res = $req->fetchAll(PDO::FETCH_ASSOC);
		$end = end($res);
		if(!empty($res)){
			echo 'créateurs : ';
			foreach($res as $ligne){
				if($ligne == $end){
					echo '<a href="fiche_serie.php?id='.$ligne['ID_SERIE'].'">'.$ligne['TITRE_SERIE'].'</a>';
				}
				else{
					echo '<a href="fiche_serie.php?id='.$ligne['ID_SERIE'].'">'.$ligne['TITRE_SERIE'].'</a>, ';
				}
			}
		}
	}

	public function afficheProducteur($id)
	{
		require('include/cobdd.php');
		$req = $dbh->prepare('SELECT ID_SERIE,TITRE_SERIE FROM INDIVIDUS NATURAL JOIN PRODUIRE NATURAL JOIN SERIES where ID_IND=? and PRODUCTEUR="X"');
		$req->execute(array($id));
		$res = $req->fetchAll(PDO::FETCH_ASSOC);
		$end = end($res);
		if(!empty($res)){
			echo 'producteurs : ';
			foreach($res as $ligne){
				if($ligne == $end){
					echo '<a href="fiche_serie.php?id='.$ligne['ID_SERIE'].'">'.$ligne['TITRE_SERIE'].'</a>';
				}
				else{
					echo '<a href="fiche_serie.php?id='.$ligne['ID_SERIE'].'">'.$ligne['TITRE_SERIE'].'</a>, ';
				}
			}
		}
	}

	public function afficheRealisateur($id)
	{
		require('include/cobdd.php');
		$req = $dbh->prepare('SELECT ID_SERIE,TITRE_SERIE FROM INDIVIDUS NATURAL JOIN REALISER NATURAL JOIN SERIES where ID_IND=? and REALISATEUR="X"');
		$req->execute(array($id));
		$res = $req->fetchAll(PDO::FETCH_ASSOC);
		$end = end($res);
		if(!empty($res)){
			echo 'réalisateurs : ';
			foreach($res as $ligne){
				if($ligne == $end){
					echo '<a href="fiche_serie.php?id='.$ligne['ID_SERIE'].'">'.$ligne['TITRE_SERIE'].'</a>';
				}
				else{
					echo '<a href="fiche_serie.php?id='.$ligne['ID_SERIE'].'">'.$ligne['TITRE_SERIE'].'</a>, ';
				}
			}
		}
	}

	public function afficheActeur($id)
	{
		require('include/cobdd.php');
		$req = $dbh->prepare('SELECT ID_SERIE,TITRE_SERIE FROM INDIVIDUS NATURAL JOIN JOUER NATURAL JOIN SERIES where ID_IND=? and ACTEUR="X"');
		$req->execute(array($id));
		$res = $req->fetchAll(PDO::FETCH_ASSOC);
		$end = end($res);
		if(!empty($res)){
			echo 'acteurs : ';
			foreach($res as $ligne){
				if($ligne == $end){
					echo '<a href="fiche_serie.php?id='.$ligne['ID_SERIE'].'">'.$ligne['TITRE_SERIE'].'</a>';
				}
				else{
					echo '<a href="fiche_serie.php?id='.$ligne['ID_SERIE'].'">'.$ligne['TITRE_SERIE'].'</a>, ';
				}
			}
		}
	}
}
?>
