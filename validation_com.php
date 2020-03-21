
<?php
session_start();
$title = 'Validation commentaire';

require("include/connecbdd.php");
require("include/header.php");
?>

<div id="form_commentaire">
    <?php 
    // on affiche une erreur si déja commenté 
    if(!empty($_GET['err']) && $_GET['err']== "comm")
        {
            echo '<p style="color: rgb(252, 116, 106);"> Vous ne pouvez commenter qu\'une seule fois !</p>
            <p> <a href="index_membre.php"> Retour à l\'accueil </a>';
        }

    // affiche une validation si commentaire ajouté  
    if(!empty($_GET['ok']) && $_GET['ok']== "comm")
        {
            echo '<p style="color: green;"> Merci pour votre commentaire <?php echo $_SESSION["prenom"]?> !</p> 
            <p> <a href="index_membre.php"> Retour à l\'accueil </a>';
        }
    ?> 
</div>   
<?php require_once('include/footer.php');?> 

   