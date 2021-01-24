<?php
// j'ai créer une fonction qui récupére tous les articles de la base de donner 

function getArticles(){
    // recupérer le fichier connect
    require ('config/connect.php');
    // creer une variable 
    $req= $bdd->prepare('SELECT id, Titre, image, Description, Date FROM arcticles ORDER BY id DESC');
    // on execute la requete
    $req->execute();
    // créer une variable ou j'ai stoqué tous ce que j'ai recuperer au forme d'un objet
     $data = $req->fetchAll(PDO::FETCH_OBJ);
     return $data;
     $req->closeCursor();

}
// la fonction qui recupere un ariticle parraport a son id
function getArticle($id)
{
    require ('config/connect.php');
    // prepare la requete pour selectionner tous les article 
    $req = $bdd->prepare('SELECT * FROM arcticles WHERE id =?');
    // on va mettre la valeur de l'id
    $req->execute(array($id));
    // si ily'a une correspendance 
    if($req->rowCount() == 1)
    {
        $data = $req->fetch(PDO::FETCH_OBJ);
        return $data;
    }
    else 
         header('Location: blog.php');
         $req->closeCursor();   

}
// la fonction qui va rajouter le commentaire dans la base de donnéer 
// la fonction va prendre comme parametre l'id de l'article l'auteur et le commentaire 

function addComment($articleId,$auteur,$commentaire){
    require('config/connect.php');
    // on prepare la requete qui va inserer sur la tableau commentaire 
    $req= $bdd->prepare('INSERT INTO commentaire (article_id, Auteur, commentaire, Date) VALUES (?, ?, ?, NOW())');
    $req->execute(array($articleId,$auteur,$commentaire));
    $req->closeCursor();
}
// Une fonction pour recuperer les commentaires d'un article 

function getComment($id){
     require('config/connect.php');
     $req= $bdd->prepare('SELECT * FROM commentaire WHERE article_id = ?');
     $req->execute(array($id));
     $data = $req->fetchAll(PDO::FETCH_OBJ);
     return $data;
     $req->closeCursor();
}
?>