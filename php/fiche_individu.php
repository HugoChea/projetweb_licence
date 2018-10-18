<?php
	require("Individu.php");
	require("Utilisateur.php");
	$a=new Utilisateur();
	session_start();
	if(isset($_GET['id']) AND is_numeric($_GET['id']))
	{
		$d=new Individu();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link type="text/css" rel="stylesheet" href="../css/default.css"/>
		<title>Fiche Individu</title>
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
				<h2 id="head"><?php $d->afficheTitre($_GET['id']);?></h2>
				<article id="main">
					<table>
						<tr>
							<td id="ficheLeft"><div>
								<?php echo '<img src="'.$d->afficheFiche($_GET['id']).'" alt="image individu"/>'; ?>
							</div></td>
							<td id="ficheRight"><div>
								<p>Rôles dans les séries en tant que :</p>
								<p><?php $d->afficheCreateur($_GET['id']);?></p>
								<p><?php $d->afficheProducteur($_GET['id']);?></p>
								<p><?php $d->afficheRealisateur($_GET['id']);?></p>
								<p><?php $d->afficheActeur($_GET['id']);?></p>
							</div></td>
						</tr>
					</table>
				</article>
			</section>
		</main>
		<script src="../js/jquery-2.2.1.min.js"></script>
		<script src="../js/search.js"></script>
		<script src="../js/preference.js"></script>
<?php
		require("include/footer.php");
	}
	else{
		header("Location:unautorized_access.php");
	}
?>
