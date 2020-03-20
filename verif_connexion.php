<?php
session_start();
require("include/connecbdd.php");
    //  Récupération de l'utilisateur et de son password hashé
    $req = $bdd->prepare('SELECT id_users, nom, prenom, password FROM membres WHERE username = ?');
    $req->execute(array($_POST['username']));
    $resultat = $req->fetch();

    if (!empty($_POST['username']) AND !empty($_POST['password'])) 
    {
    // Comparaison du password envoyé via le formulaire avec la base
    $isPasswordCorrect = password_verify($_POST['password'], $resultat['password']);
    
        if (!$isPasswordCorrect) 
        {
            header('Location: page_connexion.php?err=password');
            
        }
        else 
        {
            $_SESSION['id_users'] = $resultat['id_users'];
            $_SESSION['pseudo'] = $_POST['username'];
            $_SESSION['nom']= $resultat['nom'];
            $_SESSION['prenom']= $resultat['prenom'];
            header('Location: index_membre.php');
        }
    }
    else
    {
        header('Location: page_connexion.php?err=champs');
    
    }        
?>