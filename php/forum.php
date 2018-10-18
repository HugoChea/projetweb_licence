<?php
	session_start();
	require("Utilisateur.php");
	$a=new Utilisateur();
	require("Discussion.php");
	$f=new Discussion($_SESSION['login']);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link type="text/css" rel="stylesheet" href="../css/default.css"/>
		<title>Forum</title>
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
				<article id="forum">
					<div class="en-tete">
						<p>Forum</p>
					</div>
					<table id="theme">
						<?php $f->afficheForum(); ?>
						
					</table>
				</article>
			</section>
		</main>
		<script src="../js/jquery-2.2.1.min.js"></script>
		<script src="../js/search.js"></script>
		<script src="../js/preference.js"></script>
<?php require("include/footer.php"); ?>
