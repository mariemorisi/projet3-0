<?php 
// connexion à la bdd
require("include/connecbdd.php");

session_start();

    //si on submit 
    if (isset($_POST['submit']))
    {       
        $username = htmlspecialchars($_POST['username']);
        $question = htmlspecialchars($_POST['question']);
        $reponse = htmlspecialchars($_POST['reponse']);

        // et que les champs sont remplis
        if (!empty($_POST['username']) AND !empty($_POST['reponse']))
        {
            $req = $bdd->prepare('SELECT id_users, nom, prenom, username, question, reponse FROM membres WHERE username = :username');
            $req->execute(array('username' => $username));
            $resultat = $req->fetch();

                // Comparaison de la reponse envoyée via le formulaire avec la bdd
                $isAnswerCorrect = (($_POST['username'] == $resultat['username']) AND ($_POST['reponse'] == $resultat['reponse']));
                if (!$isAnswerCorrect) 
                { 
                   $erreur = '<p style="color: rgb(255, 0, 0);"> Données incorrectes !</p>';
                }
                else 
                { 
                // renvoyer l'username + reponse vers mdp_bdd 
                $_SESSION['id_users'] = $resultat['id_users'];
                $_SESSION['pseudo'] = $resultat['username'];
                $_SESSION['nom']= $resultat['nom'];
                $_SESSION['prenom']= $resultat['prenom'];
                ?>  
                 <form class="renvoie_id_users" method="post" action="mdp_bdd.php">
                    <input type="hidden" name="renvoi_username" value="<?php echo $_POST["username"]?>">
                    <input type="hidden" name="renvoi_reponse" value="<?php echo $_POST["reponse"]?>">
                </form>
                <?php
                header('location: mdp_bdd.php');
                }
        }
        else
        {
        $message = '<p style="color: rgb(255, 0, 0);"> Tous les champs doivent être remplis ! </p>' ; 
        }       
    }
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css">
        <title>Mot de passe oublié</title>
    </head>
    <body>
        <header>
			<div id="header2">
				<a href="page_connexion.php">
					<img class="logo2" src="acteurs-partenaires/logo-gbaf.png" alt="logo">
				</a>  
			</div>  
		</header>
        <!-- Formulaire pseudo -->
        <div id="login">
        <form class="form" method="post" action="mdp_oublie.php">
            <label for="username"> Votre pseudo </label> <br>
            <input class="input" type="pseudo" name="username"> 

        <!-- Choisir et répondre à la question secrète -->
            <label for="question">Votre question secrète :</label> <br>
                <select class="input" name="question">
                    <option value="choix1">Le nom de jeune fille de votre mère</option>
                    <option value="choix2">Le nom de votre premier animal de compagnie</option>
                    <option value="choix3">La ville de naissance de votre père</option>
                </select> <br>
            <label for="reponse">Réponse à la question secrète :</label>
            <input class="input" type="reponse" name="reponse">
            <input class="bouton_connexion" type="submit" value="Valider" name="submit"> <br>
        </form>
        <?php if(isset($erreur)) {echo $erreur;}?>
        <?php if(isset($message)) {echo $message;}?>
    </div>
    </body>
</html>