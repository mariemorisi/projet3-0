<?php 
// connexion à la bdd
require("include/connecbdd.php");

?>

<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Connexion</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<header>
			<div id="header2">
				<a href="page_connexion.php">
					<img class="logo2" src="acteurs-partenaires/logo-gbaf.png" alt="logo">
				</a>  
			</div>  
		</header>
	<div id="bloc_page">
		<div id="login">
			<h2>Se connecter</h2>
			<p><div class="form">
				<form method="post" action="verif_connexion.php">
					<label for="username"> Pseudo</label> </br>
					<input class="input" type="pseudo" name="username"> </br>
					<label for="password"> Mot de passe </label> </br>
					<input class="input" type="password" name="password"> </br>
					<a href="mdp_oublie.php"> Mot de passe oublié ? </a></br>
					<input class="bouton_connexion" type="submit" value="Connexion"> <br>
				</form>
				</div>
			</p>
				<?php 
				//affiche une erreur si mdp faux
				if(!empty($_GET['err']) && $_GET['err']== "password")
					{
					echo '<p style="color: rgb(252, 116, 106);"><strong> Mot de passe ou pseudo incorrect ! </strong></p>'; 
					}
				// affiche une validation si mdp modifié 
				if(!empty($_GET['ok']) && $_GET['ok']== "password")
					{
					echo '<p style="color: lightgreen;"><strong>Votre mot de passe a bien été modifié ! </strong> </p>'; 
					}
				// affiche une erreur si tous les champs ne sont pas remplis
				if(!empty($_GET['err']) && $_GET['err']== "champs")
				{
				echo '<p style="color: rgb(252, 116, 106);"><strong> Tous les champs doivent être remplis ! </strong></p>';  
				}	
				?>
			<div class ="nouveaumembre">
			<p> Nouveau membre ?
				<a href="page_inscription.php"><button class="bouton_connexion"> Inscription</button> </a>
			</p>
			</div>
		</div>
	</div>
	</body>
	<footer>
		<p> <a href="#"> Mentions légales </a> | <a href="#"> Contact </a>
	</footer>
	</html>