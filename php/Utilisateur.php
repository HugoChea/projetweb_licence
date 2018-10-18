<?php
	class Utilisateur {

		public function __construct(){
		}

		function inscription(){
			if(!empty($_POST['login']) and !empty($_POST['password']) and !empty($_POST['gender']) and !empty($_POST['date_birth']) and !empty($_POST['photo'])){
				require('include/cobdd.php');
				$login=htmlentities($_POST['login']);
				$password=htmlentities($_POST['password']);
				$passwordsha1=sha1($password);
				$date_birth=htmlentities($_POST['date_birth']);
				$photo=htmlentities($_POST['photo']);
				$sexe=htmlentities($_POST['gender']);
				try{
					$req=$dbh->prepare("INSERT INTO UTILISATEURS (PSEUDO, PWD, DATE_BIRTH, PHOTO, SEXE) VALUES (:login,:password,:date_birth,:photo,:sexe)");
					$req->execute(array(":login"=>$login,":password"=>$passwordsha1,":date_birth"=>$date_birth,":photo"=>$photo,":sexe"=>$sexe));
				}
				catch(PDOException $e){
					print "Erreur!:".$e->getMessage()."</br>";
					die();
				}
			}
		}

		function connexion(){
			if(!empty($_POST['login']) and !empty($_POST['password'])){
				require('include/cobdd.php');
				$pseudo=htmlentities($_POST['login']);
				$password=htmlentities($_POST['password']);
				$passwordsha1=sha1($password);
				echo $passwordsha1;
				try{
					$req = $dbh->prepare("SELECT * FROM UTILISATEURS WHERE PSEUDO=? AND PWD=?");
					$req->execute(array($pseudo,$passwordsha1));
					$res = $req->fetch(PDO::FETCH_ASSOC);
					if($res){
						$_SESSION['login']=$res['PSEUDO'];
						$_SESSION['date_birth']=$res['DATE_BIRTH'];
						$_SESSION['photo']=$res['PHOTO'];
						header('Location:index.php');
					}
					else{
						header('Location:connexion.php');
					}
				}
				catch(PDOException $e){
					print "Erreur!:".$e->getMessage()."</br>";
					die();
				}
			}
		}
		
		function afficheUtilisateur(){
			require('include/cobdd.php');
			$req = $dbh->prepare("SELECT PSEUDO,PHOTO FROM UTILISATEURS WHERE SUBSTR(DATE_BIRTH,6,5)=SUBSTR(CURRENT_DATE(),6,5) ORDER BY RAND() LIMIT 1 ");
			$req->execute();
			$res = $req->fetch(PDO::FETCH_ASSOC);
			if($res != ""){
				echo '<h1>
					<img width="210" height="285" alt="logo" src="'.$res['PHOTO'].'">
				</h1>
				<div class="colonne">
					<h2>'.$res['PSEUDO'].'</h2>
					<p>C\'est son anniversaire OMG !</p>
					<p>Un pas en plus vers la tombe</p>
				</div>';
			}
		}

		function changemdp(){
			require('include/cobdd.php');
			$password=htmlentities($_POST['password']);
			try{
				if($_SESSION['login']!=""){
					$sql = "UPDATE UTILISATEURS SET PWD=:password WHERE PSEUDO=:login";
					$sth = $dbh->prepare($sql,array(PDO::ATTR_CURSOR=>PDO::CURSOR_FWDONLY));
					$sth->execute(array(':login'=>$_SESSION['login'],':password'=>$password));
					$res = $sth->fetchAll(PDO::FETCH_ASSOC);
					header('Location:index.php');
				}
				else {
					header('Location:profil.php');
				}
			}
			catch(PDOException $e){
				print "Erreur!:".$e->getMessage()."</br>";
				die();
			}
		}

		function search(){
			if(!empty($_GET['search'])){
				require('include/cobdd.php');
				$search=htmlentities($_GET['search']);
				try{
					$req = $dbh->prepare("SELECT ID_SERIE FROM SERIES WHERE TITRE_SERIE=?");
					$req->execute(array($_GET['search']));
					$res = $req->fetch(PDO::FETCH_ASSOC);
					$id = $res['ID_SERIE'];
					if($id!=""){
						header('Location:fiche_serie.php?id='.$id);
					}
					else if($id=="") {
						$search=explode(" ", $_GET['search']);
						$req = $dbh->prepare("SELECT ID_IND FROM INDIVIDUS WHERE NOM_IND=? and PREN_IND=?");
						$req->execute(array($search[1],$search[0]));
						$res = $req->fetch(PDO::FETCH_ASSOC);
						$id = $res['ID_IND'];
						if($id!=""){
							header('Location:fiche_individu.php?id='.$id);
						}
						else{
							header('Location:index.php');
						}
					}
				}
				catch(PDOException $e){
					print "Erreur!:".$e->getMessage()."</br>";
					die();
				}
			}
		}
	}
?>
