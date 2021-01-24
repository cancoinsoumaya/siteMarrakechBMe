<?php
// realiser une requete php raison de securité
// si ily'a pas d'id ou l'id n'est pas valeur une valeur numérique 
if(!isset($_GET['id']) OR !is_numeric($_GET['id']))
     header('Location: blog.php');

else {
    extract ($_GET);
    // effectue une securité suplementaire qui va supprimé l html
    $id = strip_tags($id);

    require_once('config/function.php');
    // la verfication de post pour me formulaire 
    if(!empty($_POST)){
        // si le poste n'est pas vide on exrait le post et j'ai créer un tableau pour les erreur 
        extract($_POST);
        $erreurs = array();
        // j'ai utilseer la fonction strip_tag qui va supprimer les balise html pour securiser
        $auteur = strip_tags($auteur);
        $commentaire = strip_tags($commentaire);
        // on va verifier les champs
        if (empty ($auteur))
            // si le chmpas est vide j'affiche un message que j'ai stocker dans le array
           array_push($erreurs, "Entrez un pseudo correct");
        
        if(empty($commentaire))
            array_push($erreurs, "veuillez entrez un commentaire ");
       
        // si il y'a pas d'erreur 
        if(count($erreurs) ==0){
            $commentaire = addComment($id, $auteur, $commentaire);
            // afficher un message que le commentaire est bien envoyer
            $bienEnvoyer = 'Votre commentaire a été publié';
            // vider les champs de formulaire apres 
            unset($auteur);
            unset($commentaire);
        }

    }
    $article = getArticle($id);
    $commentaires = getComment($id);
}
?>
<?php include 'include/header.php';?>
<br><br>
<div class="cpa"> 
<div class="ph-pa">
<img src="imageBlog/<?= $article->image ?>" class="ph-a">
</div>
<div class="p-pa">
<h1> <?= $article->Titre ?></h1>
<br><br>

<p><?= $article->Contenue ?></p>
</div > 
</div>
<hr/>
<!-- Affichage de message quand le commentaire est bien envoyé a la base de données -->
<?php 
if (isset($bienEnvoyer))
    echo $bienEnvoyer;
 if (!empty($erreurs)):?>

<?php foreach($erreurs as $erreur):?>
<p><?= $erreur ?></p>
<?php endforeach;?>
<?php endif; ?>                  
<!-- formulaire pour laisser un commentaire  -->
<!-- avec action la méme page avec l'dentifiant de l'article  -->
<form class="text-center border border-light p-5" action="article.php?id=<?= $article->id ?>" method="post">
<p> <label for="auteur" >Pseudo : </label><br>
<input type ="text" name="auteur"  class="form-control mb-4" id="auteur" value="<?php if(isset($auteur)) echo $auteur?>"></p>
<!-- le champs de commentaire -->
<!-- POUR garder les information et le champs reste remplie si le champs de pseudo est vide apres l'affichage de message d'erreur -->
<div class="form-group">
<p><label for="commentaire">Votre commentaire : </label><br>
<textarea  class="form-control rounded-0" name="commentaire" id="commentaire" cols="40" rows="8" ><?php if(isset($commentaire)) echo $commentaire?></textarea></p>
</div>
<br><br>
<button class="btn btn-info btn-block" type="submit">Envoyer</button>

</form>

<br>
<div class="comment">

<h2 class="Tcomment"> <strong>les commetaire :</strong></h2>
<!-- afficher les commentaire a l'aide d'un foreach -->

<?php foreach($commentaires as $com): ?>
    <div class ="commentp">
        <div class="commentp1">
<img src="images/pcom.jpg">
</div>
<!-- recuperer le pseudo -->
<div class="commentp2">
 <h3><?= $com->Auteur ?></h3>
 <!-- recuperer la date  -->
 <time><?= $com->Date?></time>
 <!-- recupere le commentaire -->
 <p> <?= $com->commentaire ?></p>
 </div>
</div>

<?php endforeach; ?>
 </div>
<?php include 'include/footer.php';?>