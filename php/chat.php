<?php
	session_start();
	require("Utilisateur.php");
	$a=new Utilisateur();
?>
<!doctype html>
<html>
	<head>
		<title>CHAT</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<link type="text/css" rel="stylesheet" href="../css/default.css"/>
	</head>
	<body>
	<?php require("include/nav.php"); ?>
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
				<h2>Chat</h2>
				<div id="chat"></div>
				<form method="post">
					<label for="message">Message</label>
					<input type="textarea" id="message" name="message"/><br/>
					<input type="submit" id="envoi" value="Envoyer"/>
				</form>
			</section>
		</main>
		<script src="../js/jquery-2.2.1.min.js"></script>
		<script src="../js/search.js"></script>
		<script src="../js/preference.js"></script>
		<script src="../js/chat.js"></script>
<?php require("include/footer.php"); ?>
