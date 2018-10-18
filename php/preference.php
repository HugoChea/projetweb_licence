<?php
	require('Utilisateur.php');
	session_start();
	$a=new Utilisateur();
	if(isset($_POST['setPreference'])){
		header("Location:index.php");
	}
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Préférences</title>
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
			<section>
				<h2 id="head">Vos préférences</h2>
				<article id="main">
					<div class="pref">
						<h2>Paramètres par défaut</h2>
						<button id="paramDef" onclick="themeDefaut()">Paramètres par défaut</button>
					</div>
					<div class="pref">
						<h2>Changer le thème</h2>
						<button type="button" name="blue" onclick="changeTheme('1')">Thème 1</button>
						<button type="button" name="green" onclick="changeTheme('2')">Thème 2</button>
						<button type="button" name="yellow" onclick="changeTheme('3')">Thème 3</button>
					</div>
					<div class="pref">
						<h2>Changer la police</h2>
						<button type="button" name="arial" onclick="changePolice('arial')">Police 1</button>
						<button type="button" name="comic" onclick="changePolice('comic')">Police 2</button>
						<button type="button" name="century" onclick="changePolice('century')">Police 3</button>
					</div>
					<p>
						<form action="preference.php" method="post">
							<input type="submit" class="login login-submit" value="retour à l'accueil"/>
							<input type="hidden" name="setPreference" value="1"/>
						</form>
					<p>
				</article>
			</section>
		</main>
		<script src="../js/jquery-2.2.1.min.js"></script>
		<script src="../js/search.js"></script>
		<script src="../js/preference.js"></script>
<?php require("include/footer.php"); ?>
