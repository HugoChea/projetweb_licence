<?php
class Serie
{
	public function __construct() // Constructeur
	{
	}

	public function afficheTitre($id)
	{
		require('include/cobdd.php');
		$req = $dbh->prepare('SELECT TITRE_SERIE FROM SERIES where ID_SERIE=?');
		$req->execute(array($id));
		$res = $req->fetch(PDO::FETCH_ASSOC);
		echo $res['TITRE_SERIE'];
	}

	public function afficheAnnee($id)
	{
		require('include/cobdd.php');
		$req = $dbh->prepare('SELECT ANNEE_SERIE FROM SERIES where ID_SERIE=?');
		$req->execute(array($id));
		$res = $req->fetch(PDO::FETCH_ASSOC);
		echo $res['ANNEE_SERIE'];
	}

	public function affichePays($id)
	{
		require('include/cobdd.php');
		$req = $dbh->prepare('SELECT PAYS_SERIE FROM SERIES where ID_SERIE=?');
		$req->execute(array($id));
		$res = $req->fetch(PDO::FETCH_ASSOC);
		echo $res['PAYS_SERIE'];
	}

	public function afficheFiche($id)
	{
		require('include/cobdd.php');
		$req = $dbh->prepare('SELECT URL FROM PHOTO_SERIE where ID_SERIE=?');
		$req->execute(array($id));
		$res = $req->fetch(PDO::FETCH_ASSOC);
		return $res['URL'];
	}

	public function afficheCreateur($id)
	{
		require('include/cobdd.php');
		$req = $dbh->prepare('SELECT ID_IND,PREN_IND,NOM_IND FROM INDIVIDUS NATURAL JOIN CREER where ID_SERIE=?');
		$req->execute(array($id));
		$res = $req->fetchAll(PDO::FETCH_ASSOC);
		$end = end($res);
		foreach($res as $ligne){
			if($ligne == $end){
				echo '<a href="fiche_individu.php?id='.$ligne['ID_IND'].'">'.$ligne['PREN_IND'].' '.$ligne['NOM_IND'].'</a>';
			}
			else{
				echo '<a href="fiche_individu.php?id='.$ligne['ID_IND'].'">'.$ligne['PREN_IND'].' '.$ligne['NOM_IND'].'</a>, ';
			}
		}
	}

	public function afficheProducteur($id)
	{
		require('include/cobdd.php');
		$req = $dbh->prepare('SELECT ID_IND,PREN_IND,NOM_IND FROM INDIVIDUS NATURAL JOIN PRODUIRE where ID_SERIE=?');
		$req->execute(array($id));
		$res = $req->fetchAll(PDO::FETCH_ASSOC);
		$end = end($res);
		foreach($res as $ligne){
			if($ligne == $end){
				echo '<a href="fiche_individu.php?id='.$ligne['ID_IND'].'">'.$ligne['PREN_IND'].' '.$ligne['NOM_IND'].'</a>';
			}
			else{
				echo '<a href="fiche_individu.php?id='.$ligne['ID_IND'].'">'.$ligne['PREN_IND'].' '.$ligne['NOM_IND'].'</a>, ';
			}
		}
	}

	public function afficheRealisateur($id)
	{
		require('include/cobdd.php');
		$req = $dbh->prepare('SELECT ID_IND,PREN_IND,NOM_IND FROM INDIVIDUS NATURAL JOIN REALISER where ID_SERIE=?');
		$req->execute(array($id));
		$res = $req->fetchAll(PDO::FETCH_ASSOC);
		$end = end($res);
		foreach($res as $ligne){
			if($ligne == $end){
				echo '<a href="fiche_individu.php?id='.$ligne['ID_IND'].'">'.$ligne['PREN_IND'].' '.$ligne['NOM_IND'].'</a>';
			}
			else{
				echo '<a href="fiche_individu.php?id='.$ligne['ID_IND'].'">'.$ligne['PREN_IND'].' '.$ligne['NOM_IND'].'</a>, ';
			}
		}
	}

	public function afficheActeur($id)
	{
		require('include/cobdd.php');
		$req = $dbh->prepare('SELECT ID_IND,PREN_IND,NOM_IND FROM INDIVIDUS NATURAL JOIN JOUER where ID_SERIE=?');
		$req->execute(array($id));
		$res = $req->fetchAll(PDO::FETCH_ASSOC);
		$end = end($res);
		foreach($res as $ligne){
			if($ligne == $end){
				echo '<a href="fiche_individu.php?id='.$ligne['ID_IND'].'">'.$ligne['PREN_IND'].' '.$ligne['NOM_IND'].'</a>';
			}
			else{
				echo '<a href="fiche_individu.php?id='.$ligne['ID_IND'].'">'.$ligne['PREN_IND'].' '.$ligne['NOM_IND'].'</a>, ';
			}
		}
	}

	public function afficheNote($id)
	{
		require('include/cobdd.php');
		$req = $dbh->prepare('SELECT TRUNCATE(AVG(NOTE_NS),1) AS NS FROM NOTER_SERIES where ID_SERIE=?');
		$req->execute(array($id));
		$res = $req->fetch(PDO::FETCH_ASSOC);
		echo $res['NS'];
	}

	public function afficheCommentaire($id)
	{
		require('include/cobdd.php');
		$req = $dbh->prepare('SELECT PSEUDO,CMT_NS,DATE_NS FROM NOTER_SERIES where ID_SERIE=?');
		$req->execute(array($id));
		$res = $req->fetchAll(PDO::FETCH_ASSOC);
		foreach($res as $ligne){
			echo '<tr><td class="auteur"><a href=""><p>' . $ligne['PSEUDO'] . '<img width="150" src="../img/Mikasa.png" alt="avatar"></p></a></td><td>
		<p>'. $ligne['CMT_NS'] .'
		</p>
		</td></tr>';
		}
	}

	public function afficheResume($id)
	{
		require('include/cobdd.php');
		$req = $dbh->prepare('SELECT SUM_SERIE FROM SERIES where ID_SERIE=?');
		$req->execute(array($id));
		$res = $req->fetch(PDO::FETCH_ASSOC);
		echo $res['SUM_SERIE'];
	}

	public function noter($id)
	{
		require('include/cobdd.php');
		if(is_numeric($_POST['note'])){
			$com=htmlentities($_POST['comment']);
			try{
				$req = $dbh->prepare('INSERT INTO NOTER_SERIES (PSEUDO, ID_SERIE, NOTE_NS,CMT_NS) VALUES (?,?,?,?)');
				$req->execute(array($_SESSION['login'],$id,$_POST['note'],$com));
			}
			catch(PDOException $e){
				print "Erreur!:".$e->getMessage()."</br>";
				die();
			}
		}
		else{
			header("Location:fiche_serie.php?id=".$id_serie);
		}
	}

	public function afficheSerie(){
		require('include/cobdd.php');
		$req = $dbh->prepare('SELECT * FROM SERIES NATURAL JOIN PHOTO_SERIE NATURAL JOIN EPISODES ORDER BY DATE_EP DESC LIMIT 0,5');
		$req->execute();
		$res = $req->fetchAll(PDO::FETCH_ASSOC);
		$i=0;
		foreach($res as $ligne){
			echo '<li class="slide slide' . $i . '">';
			echo '<div><a href="fiche_serie.php?id=' . $ligne["ID_SERIE"] . '"><img class="slide'.$i.'" src="'.$ligne["URL"].'" alt="'.$ligne["TITRE_SERIE"].'"/> </a></div>';
			echo '<p>'.$ligne["TITRE_SERIE"].'</p>';
			echo '</li>';
			$i++;
		}
	}

	public function afficheListeEpisode($id){
		require('include/cobdd.php');
		$req = $dbh->prepare('SELECT ID_EP,NOM_EP FROM EPISODES NATURAL JOIN SERIES WHERE ID_SERIE=?');
		$req->execute(array($id));
		$res = $req->fetchAll(PDO::FETCH_ASSOC);
		foreach($res as $ligne){
			echo '<li><a href="fiche_episode.php?id='.$ligne['ID_EP'].'">'.$ligne['NOM_EP'].'</a></li>';
		}
	}
}
?>
