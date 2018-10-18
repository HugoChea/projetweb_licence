<?php
	require('Utilisateur.php');
	session_start();
	$a=new Utilisateur();
	if(isset($_POST['changemdp'])){
		$a->changemdp();
	}
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Profil</title>
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
				<h2 id="head">Votre profil</h2>
				<article id="main">
					<table>
						<tr>
							<td><div id="profilLeft">
								<h2><?php echo $_SESSION['login'] ?></h2>
								<?php echo '<img src="'.$_SESSION['photo'].'" alt="logo"/>';
									echo '<p>Date de naissance : '.$_SESSION['date_birth'].'</p>'; ?>
							</div></td>
							<td><div id="profilRight">
								<h2>Modification de votre profil</h2>
								<h3>Votre mot de passe</h3>
								<form accept-charset="utf-8" action="profil.php" method="POST">
									<label for="password">Mot de passe</label>
									<input placeholder="Mot de passe" required autocomplete="off" id="password" type="password" name="password">
									<label for="password_confirmation">Confirmer le mot de passe</label>
									<input type="submit" class="login login-submit" value="Modifier"/>
									<input type="hidden" name="changemdp" value="1"/>
								</form>
							</div></td>
						</tr>
					</table>
				</article>
			</section>
		</main>
		<script src="../js/jquery-2.2.1.min.js"></script>
		<script src="../js/search.js"></script>
		<script src="../js/preference.js"></script>
<?php require("include/footer.php"); ?>
