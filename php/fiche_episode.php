<?php
	require("Episode.php");
	require("Utilisateur.php");
	$a=new Utilisateur();
	session_start();
	if(isset($_GET['id']) AND is_numeric($_GET['id']))
	{
		$c=new Episode();
		if(!isset($_SESSION['login'])){
			$_SESSION['login']="";
		}
		if(isset($_POST['noter'])){
			$c->noter($_GET['id']);
		}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link type="text/css" rel="stylesheet" href="../css/default.css"/>
		<title>Fiche Episode</title>
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
				<h2 id="head"><?php $c->afficheTitre($_GET['id']);
					echo ' (Saison ';
					$c->afficheSaison($_GET['id']);
					echo ')';?></h2>
				<article id="main">
					<table>
						<tr>
							<td id="ficheLeft"><div>
								<?php echo '<img src="'.$c->afficheFiche($_GET['id']).'" alt="image série"/>'; ?>
							</div></td>
							<td id="ficheRight">
								<div>
									<p>Date de diffusion : <?php $c->afficheAnnee($_GET['id']);?></p>
									<p>Pays : <?php $c->affichePays($_GET['id']);?></p>
									<p>Durée : <?php $c->afficheDuree($_GET['id']);
										echo 'mins';?></p>
									<p>créateurs : <?php $c->afficheCreateur($_GET['id']);?></p>
									<p>producteurs : <?php $c->afficheProducteur($_GET['id']);?></p>
									<p>réalisateurs : <?php $c->afficheRealisateur($_GET['id']);?></p>
									<p>acteurs : <?php $c->afficheActeur($_GET['id']);?></p>
									<p>note : <?php $c->afficheNote($_GET['id']);?></p>
									<p><?php $c->afficheResume($_GET['id']);?> </p>
								</div>
							</td>
						</tr>
					</table>
					<table>
						<?php $c->afficheCommentaire($_GET['id']); ?>
					</table>
					<?php if($_SESSION['login']!=""){ ?>
						<form class="form_com" accept-charset="utf-8" action="fiche_episode.php?id=<?php echo $_GET['id']; ?>" method="post">
							<label for="note">Note</label>
							<input type="text" placeholder="Note" id="note" name="note" value="" required>
							<h3>Laisser un commentaire</h3>
							<textarea id="comment" name="comment" required class="normal" placeholder="Votre commentaire.."></textarea>
							<p class="form-submit">
								<input name="submit" type="submit" id="submit" class="submit" value="Poster un commentaire">
							</p>
							<input type="hidden" name="noter" value="1"/>
						</form>
					<?php } ?>
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
