<?php
session_start();
$title = 'Accueil membre';
require("include/connecbdd.php");
require_once("include/header.php");
?>

<div id="presentation">
	<h1> Bienvenue sur l'extranet de GBAF </h1>
	<p> Le GBAF est le représentant de la profession bancaire et des assureurs sur tous
	les axes de la réglementation financière française. Sa mission est de promouvoir
	l'activité bancaire à l’échelle nationale. C’est aussi un interlocuteur privilégié des
	pouvoirs publics.</p>
	<div id="banniere_image">
		<img src="acteurs-partenaires/banniere.jpg" alt="banniere">
	</div>
</div>
<!-- On affiche les acteurs -->
<div id="separateur"></div>
<div id="bloc_acteur">
	<div id="bloc_titre">
		<h2> Acteurs et Partenaires </h2>
		<p> Présentation de la liste des différents acteurs du système bancaire français.</p>
	</div>
	<div id="separateur"></div>
	<div id="acteur">
		<?php
		$req = $bdd->query('SELECT * FROM acteur');
		while($donnees = $req->fetch())
		{
		?>	
		<div class="styleacteur">
			<img class="logo_acteur_mini" src="<?php echo $donnees['logo']; ?>"/> <br/>
			<div class="texteacteur">
				<?php echo '<h2>' . $donnees['acteurs'] . '</h2>';
				 echo substr($donnees['description'], 0, 100).'...'; ?>
				<a href="acteur.php?id=<?php echo $donnees['id_acteur']; ?>">
					<input class="bouton_suite" type="button" value="Lire la suite" class="bouton">
				</a>
			</div>	
		</div>	
		<?php } //fin de la boucle acteur ?>			
	</div>
</div>
<?php require_once('include/footer.php');?> 		
