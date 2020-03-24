<?php
ob_start();
// connexion à la bdd
$title = 'Nouveau mot de passe';
require("include/connecbdd.php");
require_once("include/header_public.php");
session_start();
//ne pas afficher la page si la session n'est pas ouverte 
if (!empty($_SESSION['id_users']))
{
    //si on submit 
    if (isset($_POST['submit']))
    { 
        if(!empty($_POST['password']))
        {       
            $pass_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
            //inserer nouveau mdp dans bdd 
            $new_mdp = $bdd->prepare('UPDATE membres SET password = :password WHERE username = :username');
            $new_mdp ->execute(array(
            'password' => $pass_hash,
            'username' => $_SESSION['pseudo']));
            header('Location: page_connexion.php?ok=password');
        }
        else
        {
            echo '<p style="color: rgb(255, 0, 0);"> Tous les champs doivent être remplis ! </p>' ; 
        } 
    }    
}
else 
{
    header('location: page_connexion.php');
}
?>

<div id="login">  
    <form class="form" method="post" action="mdp_bdd.php">
        <label for="password"> Votre nouveau mot de passe :</label> <br>
        <input class="input" type="password" name="password"> <br>
        <input class="bouton_connexion" type="submit" value="Valider" name="submit"> <br>
    </form>
    <?php // if(isset($erreur)) {echo $erreur;}?>
    <?php // if(isset($mdp_ok)) {echo $mdp_ok;}?>
</div>
<?php require_once('include/footer.php');?> 

