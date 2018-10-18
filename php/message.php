<?php
	session_start();
	require("Utilisateur.php");
	$a=new Utilisateur();
	require("Discussion.php");
	$g=new Discussion($_SESSION['login']);
	if(isset($_GET['id']) and is_numeric($_GET['id']))
	{
		if (isset($_POST['poster']) AND $_POST['poster']==1){
			$g->repondre($_GET['id'], $_POST['message']);
		}
		if (isset($_POST['nouveau']) AND isset($_POST['serie']) AND isset($_POST['titre']) AND $_POST['nouveau']==1){
			$g->nouveau($_GET['id'], $_POST['serie'],$_POST['titre'], $_POST['message']);
		}
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
					<table>
  						<tr><th id="auteur">Auteur</th><th>Messages</th></tr>
						<tr class="sujet">
							<td class="auteur">
								<a href=""><p><?php $g->afficheAuteurMessage($_GET['id']); ?><img width="150" src="../img/Mikasa.png" alt="avatar"></p></a>
							</td>
							<td>
								<p><?php $g->afficheMessage($_GET['id']);?></p>
							</td>
						</tr>
	<?php
		$g->afficheReponse($_GET['id']);
	?>
					</table>
	<?php 
		if (isset($_SESSION['login']) AND !empty($_SESSION['login']))
		{
	?>
					<form method="post" class="form-newsujet" action="message.php?id=<?php echo $_GET['id']; ?>">
						<textarea name="message"></textarea>
						<input type="hidden" name="poster" value="1" />
						<div class="form-group">
							<input id="submit" name="EditerTexte" type="submit" value="Send" class="login login-submit">
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
		else{
			header('Location:unautorized_access.php');
		}
	?>
