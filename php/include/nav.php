<?php
if(!empty($_SESSION['login']))
{
?>	
	<nav>
			<ul>
				<li><a href="index.php">Accueil</a></li>
				<li><a href="deconnexion.php">Deconnexion</a></li>
				<li><a href="profil.php">Profil</a></li>
				<li><a href="forum.php">Forum</a></li>
				<li><a href="preference.php">Préférences</a></li>
				<li><a href="chat.php">Chat</a></li>
			</ul>
	</nav>
<?php
}
else{
?>
	<nav>
		<ul>
			<li><a href="index.php">Accueil</a></li>
			<li><a href="connexion.php">Connexion</a></li>
			<li><a href="inscription.php">Inscription</a></li>
			<li><a href="forum.php">Forum</a></li>
		</ul>
	</nav>

<?php
}

?>
