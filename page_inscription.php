<?php
$title = 'Inscription';
require("include/connecbdd.php");
require_once("include/header_public.php");
?>
<div id="bloc_page">
	<div id="inscription">
		<p><h3>Inscription</h3> 
			<?php //affiche une erreur si pseudo deja utlisé 
			if(!empty($_GET['err']) && $_GET['err']== "pseudo")
			{
				echo '<p style="color: rgb(252, 116, 106);"><strong> Pseudo déja utlisé ! </strong></p>'; 
			}
			// affiche une validation si tous les champs ne sont pas remplis 
			if(!empty($_GET['err']) && $_GET['err']== "champs")
			{
				echo '<p style="color: rgb(252, 116, 106);"><strong> Tous les champs doivent être remplis ! </strong></p>';  
			}
			?>
			<form class="form" method="post" action="inscription_bdd.php">
				<label for="nom">Votre nom :</label>
				<input class="input" type="text" name="nom">
				<label for="prenom">Votre prénom :</label>
				<input class="input" type="text" name="prenom">
				<label for="username">Votre pseudo :</label>
				<input class="input" type="pseudo" name="username">
				<label for="password">Votre mot de passe :</label>
				<input class="input" type="password" name="password">
				<label for="question">Votre question secrète :</label> <br>
				<select class="input" name="choix">
					<option value="choix1">Le nom de jeune fille de votre mère</option>
					<option value="choix2">Le nom de votre premier animal de compagnie</option>
					<option value="choix3">La ville de naissance de votre père</option>
				</select> <br>
				<label for="reponse">Réponse à la question secrète :</label>
				<input class="input" type="reponse" name="reponse">
				<input class="bouton_connexion" type="submit" name="valider" value="Valider">
			</form>
		</p>
	</div>
</div>
<?php require_once('include/footer.php');?> 

	