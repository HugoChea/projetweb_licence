<?php
	session_start();
	require('Utilisateur.php');
	$a=new Utilisateur();
	if(isset($_POST['connecte']) and $_POST['connecte']){
		$a->connexion();
	}
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Connexion</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link type="text/css" rel="stylesheet" href="../css/default.css"/>
	</head>
	<body>
		<header>
			<h1><img src="../img/logo.png" alt="logo"/></h1>
			<form action ="search.php" method="get">
				<input id="search" type="text" name="search" class = "recherche" placeholder="Recherche"/>
				<input type="submit" value = " Q " id = "valider" class = "recherche" />
				<div id="proposition">
					<ul></ul>
				</div>
			</form>
		</header>
		<?php require("include/nav.php"); ?>
		<main>
			<section id="connexion">
				<h2>Connexion</h2>
				<form accept-charset="utf-8" action="connexion.php" method="post">
					<input type="text" name="login" placeholder="Identifiant" value="" required/>
					<input type="password" name="password" placeholder="Mot de passe" autocomplete="off"/>
					<input type="submit" class="login login-submit" value="Se connecter"/>
					<a href="">Mot de passe oublié ?</a>
					<input type="hidden" name="connecte" value="1"/>
				</form>	
			</section>
		</main>
		<script src="../js/jquery-2.2.1.min.js"></script>
		<script src="../js/search.js"></script>
		<script src="../js/preference.js"></script>
<?php require("include/footer.php"); ?>
