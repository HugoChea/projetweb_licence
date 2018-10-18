<?php
class Discussion
{
	private $_user = null;
	public function __construct($pseudo) // Constructeur
	{
		$this->_user = $pseudo;
	}
	////  FORUM  ////
	function afficheForum(){
		require('include/cobdd.php');
		$req = $dbh->query('SELECT * FROM SERIES NATURAL JOIN PHOTO_SERIE');
		$res = $req->fetch(PDO::FETCH_ASSOC);
		if($res)
		{
			do
			{
				foreach($res as $c =>$v)
				{
					if($c=="ID_SERIE")
						$id = $v;
					if($c=="TITRE_SERIE")
						$titre = $v;
					if($c=="SUM_SERIE")
						$sum = $v;
					if($c=="URL"){
						$url= $v;
					}
				}
			echo '<tr>
					<td>
						<a href="sujet.php?id='. $id .'"><h2>'. $titre .'</h2></a>
					</td>
				</tr>
				<tr>
					<td class="pair">
						<div class="presentation"><img src="'. $url .'" alt="image_forum" width="80" height="80">'. substr($sum, 0, 300) .'...
						</div>
					</td>
					<td class="impair">
						<div class="last"><a href="message.php">La fin du monde en...</a><br>Le 25 décembre à 18:05<br>
						</div>
					</td>
				</tr>';
			}while($res = $req->fetch(PDO::FETCH_ASSOC));
		}
	}

	////  SUJET  ////
	function verifieSerieExiste($id){
		require('include/cobdd.php');
		$req = $dbh->prepare('SELECT * FROM SERIES where ID_SERIE=?');
		$req->execute(array($id));
		$res = $req->fetch(PDO::FETCH_ASSOC);
		if($res)
			return true;
		else
			return false;
	}

	function afficheListeMessage($id)
	{
		require("include/cobdd.php");
		if(is_numeric($_GET['id'])){
			$req = $dbh->prepare('SELECT * FROM MESSAGES where ID_SERIE=?');
			$req->execute(array($id));
			$res = $req->fetch(PDO::FETCH_ASSOC);
			if($res)
			{
				do
				{
					foreach($res as $c =>$v)
					{
					if($c=="ID_MSG")
						$id = $v;
					if($c=="PSEUDO")
						$name = $v;
					if($c=="TITRE_MSG")
						$titre = $v;
					}
					echo '<tr class="sujet"><td><a href="message.php?id=' . $id .'">' . $titre . '</a></td><td class="rep">'. $this->compterNombreRep($id) .'</td><td class="vu">'. $this->compterNombreRep($id) .'</td><td class="der">'. $name .'</td></tr>';
				}while($res = $req->fetch(PDO::FETCH_ASSOC));
			}
		} else {
			header("Location:unautorized_access.php");
		}
	}
	
	function compterNombreRep($id){
		require('include/cobdd.php');
		$req = $dbh->prepare('SELECT COUNT(ID_RPS) AS NB_REP FROM REPONSES where ID_MSG=?');
		$req->execute(array($id));
		$res = $req->fetch(PDO::FETCH_ASSOC);
		return $res['NB_REP'];
	}

	function recupLastIdMSG()
	{
		require("include/cobdd.php");
		$id=0;	
		$req = $dbh->prepare('SELECT ID_MSG FROM MESSAGES');
		$req->execute();		
		$res = $req->fetch(PDO::FETCH_ASSOC);
		if (!empty($res))
		{
			do
			{
				foreach($res as $v)
				{
				}
			}while($res = $req->fetch(PDO::FETCH_ASSOC));
			$id=$v+1;
			return $id;
		}
		else
			return 0;
	}

	//// MESSAGE ////
	function verifieSujetExiste($id){
		require('include/cobdd.php');
		$req = $dbh->prepare('SELECT * FROM MESSAGES where ID_MSG=?');
		$req->execute(array($id));
		$res = $req->fetch(PDO::FETCH_ASSOC);
		if($res)
			return true;
		else
			return false;
	}
	
	function repondre($id, $msg){
		require("include/cobdd.php");
		$msg=htmlentities($msg);
		$id_rps = $this->recupLastId();
		try{
			$req = $dbh->prepare('INSERT INTO REPONSES(ID_RPS, PSEUDO, ID_MSG, TXT_RPS) VALUES (:id_rps, :pseudo, :id_msg, :msg)');
				$req->execute(array(
				'id_rps'=>$id_rps,
				'pseudo'=>$this->_user,
				'id_msg'=>$id,
				'msg'=>$msg,
				));
		}
		catch(PDOException $e){
			print "Erreur!:".$e->getMessage()."</br>";
			die();
		}
	}

	function recupLastId()
	{
		require("include/cobdd.php");
		$id=0;	
		$req = $dbh->prepare('SELECT ID_RPS FROM REPONSES');
		$req->execute();		
		$res = $req->fetch(PDO::FETCH_ASSOC);
		if (!empty($res))
		{
			do
			{
				foreach($res as $v)
				{
				}
			}while($res = $req->fetch(PDO::FETCH_ASSOC));
			$id=$v+1;
			return $id;
		}
		else
			return 0;
	}

	function nouveau($id, $serie, $titre, $msg){
		require("include/cobdd.php");
		$titre=htmlentities($titre);
		$msg=htmlentities($msg);
		try{
			$req = $dbh->prepare('INSERT INTO MESSAGES(ID_MSG, PSEUDO, ID_SERIE, TITRE_MSG, TXT_MSG) VALUES (:id_msg, :pseudo, :serie ,:titre, :msg)');
			$req->execute(array(
				'id_msg'=>$id,
				'pseudo'=>$this->_user,
				'serie'=>$serie,
				'titre'=>$titre,
				'msg'=>$msg,
				));
		}
		catch(PDOException $e){
			print "Erreur!:".$e->getMessage()."</br>";
			die();
		}
	}

	function afficheAuteurMessage($id){
		require('include/cobdd.php');
		$req = $dbh->prepare('SELECT PSEUDO FROM MESSAGES where ID_MSG=?');
		$req->execute(array($id));
		$res = $req->fetch(PDO::FETCH_ASSOC);
		echo $res['PSEUDO'];
	}

	function afficheMessage($id){
		require('include/cobdd.php');
		$req = $dbh->prepare('SELECT TXT_MSG FROM MESSAGES where ID_MSG=?');
		$req->execute(array($id));
		$res = $req->fetch(PDO::FETCH_ASSOC);
		echo $res['TXT_MSG'];
	}

	function afficheReponse($id){
		require("include/cobdd.php");
		$req = $dbh->prepare('SELECT * FROM REPONSES where ID_MSG=? order by DATE_RPS DESC');
		$req->execute(array($id));	
		$res = $req->fetch(PDO::FETCH_ASSOC);
		if($res)
		{
			do
			{
				foreach($res as $c =>$v)
				{
					if($c=="ID_RPS")
						$id = $v;
					if($c=="PSEUDO")
						$name = $v;
					if($c=="TXT_RPS")
						$texte = $v;
				}
				echo '<tr class="sujet"><td class="auteur"><a href=""><p>' . $name . '<img width="150" src="../img/Mikasa.png" alt="avatar"></p></a></td><td>
		<p>'. $texte .'
		</p>
		</td></tr>';
			}while($res = $req->fetch(PDO::FETCH_ASSOC));
		}
	}
}
?>
