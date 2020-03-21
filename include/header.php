
<?php
// connexion a la bdd
require("include/connecbdd.php")
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <?php if(!empty($title)){ ?>
        <title><?= $title; }?></title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <header> 
            <!-- On affiche nom prénom session --> 
            <a href="page_connexion.php">
                <div id="logo">
                    <img class="logo" src="acteurs-partenaires/logo-gbaf.png" alt="logo">
                </div>
            </a>
            <div id="nomsession">
                <div class="nomprenom">
                <?php 
                if(!empty($_SESSION['id_users']) AND !empty($_SESSION['pseudo']) AND !empty($_SESSION['nom']) AND !empty($_SESSION['prenom'])) 
                    {
                    echo '<img class="iconlog" src="acteurs-partenaires/iconlog.png" alt="iconelog"/> ' . $_SESSION['nom'] .' '. $_SESSION['prenom'] ;
                    ?>
                </div>    
                <p><a href="parametres.php"><input type="button" class="bouton_parametre" value= "Parametres du compte"></a> </p>
                <p><a href="page_deconnexion.php"> <input type="button" class="bouton_deconnexion" value= "Déconnexion"></a></p> 
                <?php
                }
                else 
                {
                    header('location: page_connexion.php');
                
                }
                ?>
            </div>
        </header>
    
