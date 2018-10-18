<?php
	require('Utilisateur.php');
	$a=new Utilisateur();
	if(isset($_POST['inscrit'])){
		$a->inscription();
		header('Location:index.php');
	}
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Formulaire</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" type="text/css" href="../css/default.css">
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
				<h2>Inscription</h2>
				<form accept-charset="utf-8" action="inscription.php" method="post">
					<input type="text" name="login" placeholder="Identifiant" value="" required/>
					<input type="password" name="password" placeholder="Mot de passe" required autocomplete="off"/>
					<input type="date" name="date_birth" value="1920-01-01" required/>
					<input type="text" name="photo" placeholder="url de photo profil" value="" required/>
					<label for="genderH">Homme</label>
					<input name="gender" type="radio" id="genderH" value="H">
					<label for="genderF">Femme</label>
					<input name="gender" type="radio" id="genderF" value="F"/>
					<input type="submit" class="login login-submit" value="S'inscrire"/>
					<input type="hidden" name="inscrit" value="1"/>
				</form>
			</section>
		</main>
		<script src="../js/jquery-2.2.1.min.js"></script>
		<script src="../js/search.js"></script>
		<script src="../js/preference.js"></script>
<?php require("include/footer.php"); ?>
