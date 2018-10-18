<?php
	session_start();
	require("Serie.php");
	require("Utilisateur.php");
	$b=new Serie();
	$a=new Utilisateur();
	if(!isset($_SESSION['login'])){
		$_SESSION['login']="";
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link type="text/css" rel="stylesheet" href="../css/default.css"/>
		<title>Accueil</title>
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
		<?php
		require("include/nav.php");
		?>
		<main>
			<section>
				<h2 id="head">Bienvenue <?php echo $_SESSION['login']; ?>!</h2>
				<article id="main">
					<div><img id="scarlett" src="../img/bann.jpg" alt="bann"/></div>
					<h2>Les dernières affiches</h2>
					<ul>
							<?php $b->afficheSerie(); ?>
					</ul>
					<img id="Left" src="../img/arrowLeft.png" alt="arrowLeft"/>
					<img id="Right" src="../img/arrowRight.png" alt="arrowRight"/>
				</article>
			</section>
		</main>
		<script src="../js/jquery-2.2.1.min.js"></script>
		<script src="../js/search.js"></script>
		<script src="../js/slide.js"></script>
		<script src="../js/preference.js"></script>
<?php require("include/footer.php"); ?>

