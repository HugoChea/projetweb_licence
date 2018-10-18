<?php
class Episode
{
	public function __construct() // Constructeur
	{
	}

	public function afficheTitre($id)
	{
		require('include/cobdd.php');
		$req = $dbh->prepare('SELECT NOM_EP FROM EPISODES where ID_EP=?');
		$req->execute(array($id));
		$res = $req->fetch(PDO::FETCH_ASSOC);
		echo $res['NOM_EP'];
	}

	public function afficheAnnee($id)
	{
		require('include/cobdd.php');
		$req = $dbh->prepare('SELECT DATE_EP FROM EPISODES where ID_EP=?');
		$req->execute(array($id));
		$res = $req->fetch(PDO::FETCH_ASSOC);
		echo $res['DATE_EP'];
	}

	public function affichePays($id)
	{
		require('include/cobdd.php');
		$req = $dbh->prepare('SELECT PAYS_SERIE FROM SERIES where ID_SERIE=(SELECT ID_SERIE FROM EPISODES where ID_EP=?)');
		$req->execute(array($id));
		$res = $req->fetch(PDO::FETCH_ASSOC);
		echo $res['PAYS_SERIE'];
	}

	public function afficheFiche($id)
	{
		require('include/cobdd.php');
		$req = $dbh->prepare('SELECT URL FROM PHOTO_SERIE where ID_SERIE=(SELECT ID_SERIE FROM EPISODES where ID_EP=?)');
		$req->execute(array($id));
		$res = $req->fetch(PDO::FETCH_ASSOC);
		return $res['URL'];
	}

	public function afficheSaison($id)
	{
		require('include/cobdd.php');
		$req = $dbh->prepare('SELECT SAISON_EP FROM EPISODES where ID_EP=?');
		$req->execute(array($id));
		$res = $req->fetch(PDO::FETCH_ASSOC);
		echo $res['SAISON_EP'];
	}

	public function afficheDuree($id)
	{
		require('include/cobdd.php');
		$req = $dbh->prepare('SELECT DUREE_EP FROM EPISODES where ID_EP=?');
		$req->execute(array($id));
		$res = $req->fetch(PDO::FETCH_ASSOC);
		echo $res['DUREE_EP'];
	}

	public function afficheCreateur($id)
	{
		require('include/cobdd.php');
		$req = $dbh->prepare('SELECT ID_IND,PREN_IND,NOM_IND FROM INDIVIDUS NATURAL JOIN CREER where ID_SERIE=(SELECT ID_SERIE FROM EPISODES where ID_EP=?)');
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
		$req = $dbh->prepare('SELECT ID_IND,PREN_IND,NOM_IND FROM INDIVIDUS NATURAL JOIN PRODUIRE where ID_SERIE=(SELECT ID_SERIE FROM EPISODES where ID_EP=?)');
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
		$req = $dbh->prepare('SELECT ID_IND,PREN_IND,NOM_IND FROM INDIVIDUS NATURAL JOIN REALISER where ID_EP=?');
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
		$req = $dbh->prepare('SELECT ID_IND,PREN_IND,NOM_IND FROM INDIVIDUS NATURAL JOIN JOUER where ID_EP=?');
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
		$req = $dbh->prepare('SELECT TRUNCATE(AVG(NOTE_NE),1) AS NE FROM NOTER_EPISODES where ID_EP=?');
		$req->execute(array($id));
		$res = $req->fetch(PDO::FETCH_ASSOC);
		echo $res['NE'];
	}

	public function afficheCommentaire($id)
	{
		require('include/cobdd.php');
		$req = $dbh->prepare('SELECT PSEUDO,CMT_NE,DATE_NE FROM NOTER_EPISODES where ID_EP=?');
		$req->execute(array($id));
		$res = $req->fetchAll(PDO::FETCH_ASSOC);
		foreach($res as $ligne){
			echo '<tr class="sujet"><td class="auteur"><a href=""><p>' . $ligne['PSEUDO'] . '<img width="150" src="../img/Mikasa.png" alt="avatar"></p></a></td><td>
		<p>'. $ligne['CMT_NE'] .'
		</p>
		</td></tr>';
		}
	}

	public function afficheResume($id)
	{
		require('include/cobdd.php');
		$req = $dbh->prepare('SELECT SUM_EP FROM EPISODES where ID_EP=?');
		$req->execute(array($id));
		$res = $req->fetch(PDO::FETCH_ASSOC);
		echo $res['SUM_EP'];
	}

	public function noter($id)
	{
		require('include/cobdd.php');
		if(is_numeric($_POST['note'])){
			$com=htmlentities($_POST['comment']);
			$req = $dbh->prepare('SELECT ID_SERIE,SAISON_EP FROM EPISODES where ID_EP=?');
			$req->execute(array($id));
			$res = $req->fetch(PDO::FETCH_ASSOC);
			$id_serie = $res['ID_SERIE'];
			$saison = $res['SAISON_EP'];
			try{
				$req = $dbh->prepare('INSERT INTO NOTER_EPISODES (PSEUDO, ID_EP, SAISON_EP, ID_SERIE, NOTE_NE,CMT_NE) VALUES (?,?,?,?,?,?)');
				$req->execute(array($_SESSION['login'],$id,$saison,$id_serie,$_POST['note'],$com));
			}
			catch(PDOException $e){
				print "Erreur!:".$e->getMessage()."</br>";
				die();
			}
		}
		else{
			header("Location:fiche_episode.php?id=".$id_serie);
		}
	}
}
?>
