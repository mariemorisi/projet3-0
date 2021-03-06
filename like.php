<?php
session_start();
$title = 'Like';
require("include/connecbdd.php");
require_once("include/header.php");

// ajouter like 
if (!empty($_POST['vote']))
{
$id_user= $_SESSION['id_users'];
$id_acteur = $_POST['id_acteur'];

    switch($_POST['vote'])
    {
        case 'like':
            // verifier si l'utilisateur à déja voté
            $req_vote = $bdd->prepare('SELECT vote FROM vote WHERE id_user= :id_user AND id_acteur = :id_acteur');
            $req_vote-> execute(array(
            'id_user' => $id_user,
            'id_acteur' => $id_acteur));

            $voteexist = $req_vote->rowcount('like');
            if ($voteexist == 0) 
            //ajouter à la base de données
            { 
                $add_like = $bdd->prepare('INSERT into vote (id_user, id_acteur, vote) VALUES (:id_user, :id_acteur, 1)');
                $add_like-> execute(array(
                    'id_user' => $id_user,
                    'id_acteur' => $id_acteur));
                $ok = 'Votre vote est bien enregistré ! </br> </br>
                    <a href="index_membre.php"> Retour à l\'accueil </a>';
            }    
            else 
            {
                $err = '<p> Vous avez déja voté ! </br> </br>
                <a href="index_membre.php"> Retour à l\'accueil </a></p>';
            }
        break;

        case 'dislike' :
            $delete_like = $bdd->prepare('DELETE from vote where id_user = :id_user');
            $delete_like-> execute(array(
                'id_user' => $id_user));
            $ok_dislike = 'Votre like à bien été supprimé ! </br> </br> 
            <a href="index_membre.php"> Retour à l\'accueil </a>';
        break;
    }
}
?>

<div id="form_commentaire">
    <?php 
    if(isset($err)) {echo $err;}; 
    if(isset($ok)) {echo $ok;}; 
    if(isset($ok_dislike)) {echo $ok_dislike;}; 
    ?> 
</div>    
<?php require_once('include/footer.php');?> 		
