<?php
	session_start();
	require("Utilisateur.php");
	$a=new Utilisateur();
	require("Discussion.php");
	$f=new Discussion($_SESSION['login']);
	
	if(isset($_GET['id']) AND is_numeric($_GET['id']) AND $f->verifieSerieExiste($_GET['id']))
	{
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
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
					<table id="sujet">
						<tr><th>Annonces/Sujets</th><th class="rep">Réponses</th><th class="vu">Vues</th><th class="der">Auteur</th></tr>
 	<?php
		$f->afficheListeMessage($_GET['id']);
	?>
					</table>
	<?php 
		if (isset($_SESSION['login']) AND !empty($_SESSION['login']))
		{
	?>
					<form method="post" class="form-newsujet" action="message.php?id=<?php echo $f->recupLastIdMSG(); ?>">
						<label>Créer un nouveau sujet</label><br>
						<input type="text" name="titre" placeholder="titre" value="" /><br>
						<textarea name="message"></textarea>
						<input type="hidden" name="nouveau" value="1" />
						<input type="hidden" name="serie" value="<?php echo $_GET['id']; ?>" />
						<div class="form-group">
							<input class="login login-submit" name="EditerTexte" type="submit" value="Send">
						</div>
					</form>
	<?php
		}
	?>
				</article>
			</section>
		</main>
		<script src="../js/jquery-2.2.1.min.js"></script>
		<script src="../js/search.js"></script>
		<script src="../js/preference.js"></script>
<?php require("include/footer.php"); 

}
else
{
	header("Location:unautorized_access.php");
}
?>
