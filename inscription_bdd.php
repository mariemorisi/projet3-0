<?php
// connexion à la bdd
require("include/connecbdd.php");
	// vérification des données
	if (isset($_POST['valider'])) 
	{
		$nom = htmlspecialchars($_POST['nom']);
		$prenom = htmlspecialchars($_POST['prenom']) ;
		$username = htmlspecialchars($_POST['username']) ;
		$pass_hache = password_hash($_POST['password'], PASSWORD_DEFAULT);
		$question = ($_POST['choix']) ;
		$reponse = htmlspecialchars($_POST['reponse']) ;
		if (!empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['username']) AND !empty($_POST['password']) AND !empty($_POST['choix'] AND !empty($_POST['reponse'])))
		{		
			//pseudo libre ? 
			$requsername = $bdd->prepare("SELECT id_users FROM membres WHERE username = ?");
			$requsername->execute(array($_POST['username']));
			$usernameexist = $requsername->rowcount();
			if ($usernameexist == 0) 
			{
				// inserer dans la base de données 
				$req = $bdd->prepare('INSERT INTO membres(nom, prenom, username, password, question, reponse) VALUES(?, ?, ?, ?, ?, ?)');
				$req->execute(array($_POST['nom'], $_POST['prenom'], $_POST['username'],$pass_hache, $_POST['choix'], $_POST['reponse']));
				// Puis redirection du visiteur vers la page de connexion
				header('Location: page_connexion.php'); 
			}        
			else 
			{
				header('location: page_inscription.php?err=pseudo')  ;        		
			}
		}
		else
		{
			header('location: page_inscription.php?err=champs') ;
		}
	}
?>
