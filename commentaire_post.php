<?php
session_start();
$title = 'Commentaire';
require("include/connecbdd.php");
require_once("include/header.php");
//si on submit
if(isset($_POST['submit']))    
    {
    $prenom = htmlspecialchars($_POST['prenom']);
    $id_user = $_POST['id_user'];
    $id_acteur = $_POST["id_acteur"];
    $post = htmlspecialchars($_POST['commentaire']);
    $prenom = htmlspecialchars($_POST['prenom']); 

    // verifier si l'utilisateur a déja commenté
    $req_comm = $bdd->prepare('SELECT post FROM post WHERE id_user= :id_user AND id_acteur = :id_acteur');
    $req_comm-> execute(array(
    'id_user' => $id_user,
    'id_acteur' => $id_acteur));

    $comm_exist = $req_comm->rowcount();
        if ($comm_exist == 0)  
        {
            // si les champs sont remplis 
            if(!empty($_POST['prenom']) AND !empty($_POST['commentaire'])) 
            {
            //on insere dans la bdd
            $addcomm = $bdd->prepare('INSERT INTO post(id_user, id_acteur, date_add, post) VALUES (:id_user, :id_acteur, NOW(), :post)');
            $addcomm->execute(array(
                'id_user' => $id_user,
                'id_acteur' => $id_acteur, 
                'post' => $post 
            ));
            header('location: validation_com.php?ok=comm'); 
            }
            else
            {
                $erreur = '<p style="color:  rgb(252, 116, 106);"> Veuillez remplir tous les champs !</p>'; 
            }
        }
        else
        {
            header('location: validation_com.php?err=comm');
        }    
    }
?>
 
<div id="form_commentaire">
    <form class="form" method="POST" action="commentaire_post.php?id=<?php echo $_GET['id']; ?>">
        <input class="input" type="hidden" name="prenom" value="<?php echo $_SESSION['prenom']?>" /> 
            <h3>  <?php echo $_SESSION['prenom']?>, donnez nous votre avis </h3>
        <textarea class="textarea" name="commentaire" placeholder="Veuillez saisir votre commentaire"></textarea> <br/> <br/> 
        <input class="bouton_connexion" type="submit" value="Valider" name="submit" /> <br/>
        <input type="hidden" name="id_acteur" id = "id_acteur" value="<?php echo $_GET['id']; ?>" />
        <input type="hidden" name="id_user" id = "id_user" value="<?php echo $_SESSION['id_users']; ?>" />
    </form> 

    <?php if(isset($erreur)) {echo $erreur;}?>
    <?php if(isset($ok_commentaire)) {echo $ok_commentaire;}?>
</div>
<?php require_once('include/footer.php');?> 		

  
