<?php 

// connexion a la base de données
    try
    {
        $bdd = new PDO('mysql:host=db5000339568.hosting-data.io;dbname=dbs330355;charset=utf8', 'dbu451396', 'Mm-914270.plg',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }
    catch (Exception $e)
    {
          die('Erreur : ' . $e->getMessage());
    }
?>