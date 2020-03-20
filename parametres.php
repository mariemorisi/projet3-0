<?php
session_start();
require("include/connecbdd.php");
require("include/header.php");

// maj des données sauf mdp dans la bdd 

if (isset($_POST['valider'])) 
	{
		if (!empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['choix'] AND !empty($_POST['reponse'])))
		{
		$nom = htmlspecialchars($_POST['nom']);
		$prenom = htmlspecialchars($_POST['prenom']) ;
		$question = ($_POST['choix']) ;
		$reponse = htmlspecialchars($_POST['reponse']) ;
		$username = ($_SESSION['pseudo']);
		
		$maj = $bdd->prepare('UPDATE membres SET nom= :nom, prenom= :prenom, question= :question, reponse= :reponse WHERE username= :username');
		$maj ->execute(array(
			'nom' => $nom,
			'prenom' => $prenom,
			'question' => $question,
			'reponse' => $reponse,
			'username' => $username));

			$ok = '<p style="color: rgb(50,205,50);">Vos données ont bien été modifiées ! </p>'; 
		}
		else
		{
			$erreur = '<p style="color: rgb(255, 0, 0);"> Veuillez remplir tous les champs !</p>'; 
		}
	}	
	// $maj -> closeCursor();
		
	// maj mdp dans la bdd 
	
	if (isset($_POST['valider_mdp'])) 
	{
		if(!empty($_POST['password']))
		{
		$pass_hache = password_hash($_POST['password'], PASSWORD_DEFAULT);
		$username = ($_SESSION['pseudo']);
		
		$majmdp = $bdd->prepare('UPDATE membres SET password=:password  WHERE username= :username');
    	$majmdp ->execute(array(
		'password' => $pass_hache,
		'username' => $username));
		
		$ok_mdp = '<p style="color: rgb(50,205,50);">Vote mot de passe à bien été modifié ! </p>'; 
		}
		else
		{
			$erreur_mdp = '<p style="color: rgb(255, 0, 0);"> Veuillez choisir un nouveau mot de passe !</p>'; 
		}
	}	
?>

<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Parametres du compte</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<div id="inscription">
			<p><h3>Modifiez les données de votre compte :</h3>
				<!-- formulaire toutes données sauf mdp -->
				<form class="form" method="post" action="parametres.php">
					<label for="nom">Nom :</label></br>
					<input class="input" type="text" name="nom"></br>
					<label for="prenom">Prénom :</label>
					<input class="input" type="text" name="prenom">
					<label  for="question">Question secrète :</label> <br>
					<select class="input" name="choix">
							<option value="choix1">Le nom de jeune fille de votre mère</option>
							<option value="choix2">Le nom de votre premier animal de compagnie</option>
							<option value="choix3">La ville de naissance de votre père</option>
						</select> <br>
					<label for="reponse">Réponse à la question secrète :</label>
					<input class="input" type="reponse" name="reponse">
					<input class="bouton_connexion" type="submit" name="valider" value="Valider">
				</form>
				<?php if(isset($erreur)) {echo $erreur;}?>
				<?php if(isset($ok)) {echo $ok;}; ?>

				<p><h3>Modifiez votre mot de passe :</h3>
				<!-- formulaire mdp  -->
				<form class="form" method="post" action="parametres.php">
				<label for="password">Votre nouveau mot de passe :</label>
					<input class="input" type="password" name="password">
					<input class="bouton_connexion" type="submit" name="valider_mdp" value="Valider">
				</form>
				<?php 
				if(isset($erreur_mdp)) {echo $erreur_mdp;}; 
				if(isset($ok_mdp)) {echo $ok_mdp;}; 
				?>
		</div>

	</body>

	<footer>
	<p> <a href="#"> Mentions légales </a> | <a href="#"> Contact </a>
	</footer>

</html>


