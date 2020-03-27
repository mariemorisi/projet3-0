<?php
require("include/connecbdd.php");
if(empty($_SESSION['id_users']) AND empty($_SESSION['pseudo']) AND empty($_SESSION['nom']) AND empty($_SESSION['prenom'])) 
{
    header('location: page_connexion.php');
}
else 
{?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php if(!empty($title)){?>
        <title><?= $title; }?></title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <header>
            <a href="page_connexion.php">
                <div id="logo">
                    <img class="logo" src="acteurs-partenaires/logo-gbaf.png" alt="logo">
                </div>
            </a>
            <div id="nomsession"><!-- On affiche nom prénom session --> 
                <button class="bouton_nom">
                    <?php
                        echo '<img class="iconlog" src="acteurs-partenaires/iconlog.png" alt="iconelog"/> ' . $_SESSION['nom'] .' '. $_SESSION['prenom'] ;
                    ?>
                </button>    
                    <button class="bouton_parametre" onclick= "window.location.href = 'parametres.php';"> Parametres du compte </button> 
                    <button class="bouton_deconnexion" onclick= "window.location.href = 'page_deconnexion.php';"> Déconnexion </button> 
                    <?php
                    }
                    ?>
            </div>
        </header>
    
