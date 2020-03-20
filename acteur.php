<?php
session_start();
require("include/connecbdd.php");
require("include/header.php");
?>
<!DOCTYPE html>
<html lang="zxx">
    <head>
        <meta charset="utf-8">
        <title>Accueil</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <?php 
        // Présentation acteur 
        $req = $bdd->prepare('SELECT * FROM acteur WHERE id_acteur = ?');
        $req->execute(array($_GET['id']));
        
        $donnees = $req->fetch();
        ?>
        <div class="bloc_description">
            <div class="bloc_logoacteur">
                <img class="logoacteur" src="<?php echo $donnees['logo']; ?>" class="logoacteur"/> <br/>
            </div>
            <div class="description_acteur">
                <?php 
                echo '<h2>' . $donnees['acteurs'] . '</h2>';
                echo $donnees['description'];
                ?> 
            </div>
        </div>
        <!-- Section commentaire --> 
        <div id="bloc_commentaire"> 
            <div class="vote">
            <?php 
                // Compter le nombre de commentaires 
                $nbr_comm = $bdd->prepare('SELECT COUNT(post) as countpost FROM post WHERE id_acteur =:id_acteur');
                $nbr_comm -> execute(array(
                    'id_acteur' => $_GET['id']));
                while( $result = $nbr_comm->fetch())
                {
                    echo  '<h3>' . $result['countpost'] . ' commentaires </h3>';
                }
                ?>
                <!--Ajouter un commentaire -->
                <div class="vote_boutons">
                    <a href="commentaire_post.php?id=<?= $_GET['id']?>"> <input type="button" class="bouton_comm" value="Ajoutez un commentaire"> </a> 
                    
                    <!-- Boutons like et dislike -->
                    <form method="post" action="like.php" class="formlike">
                        <input type="hidden" name="id_acteur" id = "id_acteur" value="<?php echo $_GET['id']; ?>" />
                        <button type="submit" class="vote_bouton"  name="vote" value="like">

                            <!-- Afficher le nombre de like et dislike -->
                            <?php 
                            $nbr_like = $bdd->prepare('SELECT COUNT(vote) as countvote FROM vote WHERE id_acteur =:id_acteur');
                            $nbr_like -> execute(array(
                                'id_acteur' => $_GET['id']));
                            while( $result = $nbr_like->fetch())
                            {
                                echo  $result['countvote'] ;
                            }
                            ?>
                            <img class="iconlike" src="acteurs-partenaires/like.jpg" alt="like" style="cursor:pointer">
                        </button>
                    </form>
                    <form method="post" action="like.php" class="formlike">
                        <input type="hidden" name="id_acteur" id = "id_acteur" value="<?php echo $_GET['id']; ?>" />
                        <button type="submit" class="vote_bouton" name="vote" value="dislike"> 
                            <img class="iconlike" src="acteurs-partenaires/dislike.jpg" alt="dislike" style="cursor:pointer">
                        </bouton>
                    </form>
                </div>
            </div>
            <div class="affichage_comm">
                <?php
                $req->closeCursor();
                //req JOIN tables membres et post pour récuperer commentaires
                $req = $bdd->prepare('SELECT post.id_post, post.id_user, membres.prenom, post.post, 
                DATE_FORMAT(date_add, \'%d/%m/%Y \') AS date_commentaire_fr
                FROM post INNER JOIN membres ON post.id_user = membres.id_users 
                WHERE id_acteur = ? ORDER BY date_add DESC');
                $req->execute(array(
                $_GET['id']));
            
                while ($donnees = $req->fetch())
                {
                ?>
                    <p class="nom_com"><?php echo $donnees['prenom']; ?>, le <?php echo $donnees['date_commentaire_fr']; ?> :</p>
                    <p class="com"><?php echo $donnees['post']; ?></p>
                <?php
                } // Fin de la boucle des commentaires
                $req->closeCursor();?>
            </div>
        </div>
    </body>	
    <footer>
        <p> <a href="#"> Mentions légales </a> | <a href="#"> Contact </a>
    </footer>
</html>
 
