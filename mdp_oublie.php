<?php
ob_start();
// connexion à la bdd
$title = 'Mot de passe oublié';
require("include/connecbdd.php");
require_once("include/header_public.php");
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

        // On compare la reponse envoyée via le formulaire avec la bdd
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
            header('Location: mdp_bdd.php');
        }
    }
    else
    {
        $champs = '<p style="color: rgb(255, 0, 0);"> Tous les champs doivent être remplis ! </p>' ; 
    }       
}
?>
<!-- Formulaire pseudo -->
<div id="login">
    <form class="form" method="post" action="mdp_oublie.php">
        <label for="username"> Votre pseudo </label> <br>
        <input class="input" type="text" name="username" id="username"> 
        <label for="question">Votre question secrète :</label> <br>
        <select class="input" name="question" id="question">
            <option value="choix1">Le nom de jeune fille de votre mère</option>
            <option value="choix2">Le nom de votre premier animal de compagnie</option>
            <option value="choix3">La ville de naissance de votre père</option>
        </select> <br>
        <label for="reponse">Réponse à la question secrète :</label>
        <input class="input" type="text" name="reponse" id="reponse">
        <input class="bouton_connexion" type="submit" value="Valider" name="submit"> <br>
    </form>
    <?php if(isset($erreur)) {echo $erreur;}?>
    <?php if(isset($champs)) {echo $champs;}?>
</div>
<?php require_once('include/footer.php');?> 

   