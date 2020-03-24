<?php
// connexion a la bdd
require("include/connecbdd.php")?>
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
            <a href="page_connexion.php">
                <div id="logo">
                    <img class="logo" src="acteurs-partenaires/logo-gbaf.png" alt="logo">
                </div>
            </a>
            <div id="nomsession"> <!-- On affiche nom prénom session --> 
                <button class="bouton_nom">
                    <?php 
                    if(!empty($_SESSION['id_users']) AND !empty($_SESSION['pseudo']) AND !empty($_SESSION['nom']) AND !empty($_SESSION['prenom'])) 
                    {
                        echo '<img class="iconlog" src="acteurs-partenaires/iconlog.png" alt="iconelog"/> ' . $_SESSION['nom'] .' '. $_SESSION['prenom'] ;
                        ?>
                        </button>    
                
                        <button class="bouton_parametre" onclick= "window.location.href = 'parametres.php';"> Parametres du compte </button> 
                        <button class="bouton_deconnexion" onclick= "window.location.href = 'page_deconnexion.php';"> Déconnexion </button> 
                        <?php
                    }
                    else 
                    {
                        header('location: page_connexion.php');
                    
                    }
                    ?>
            </div>
        </header>
    
