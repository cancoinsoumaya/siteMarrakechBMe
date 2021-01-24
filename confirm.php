<?php
// je recupere les paramétres

$utilisateur_id = $_GET['id'];
$token = $_GET['token'];
// se connecter a la base de données
require  'include_compte/db.php';
// j'ai préparer la requete pour selectionner l'utlisateur qui correspond a l'id
$req = $pdo->prepare('SELECT * FROM utilisateurs WHERE id=? ');
$req->execute([$utilisateur_id]);
$user = $req->fetch();
session_start();

// je verifier si il y a un utilisateur qui correspond et un token qui correspond
if($user && $user->validation_token == $token){
    // je demare la session
   
   $req = $pdo->prepare('UPDATE utilisateurs SET validation_token = NULL, validation_at = NOW() WHERE id = ?');
   $req->execute([$utilisateur_id]);
//    envoyer un message de success
    $_SESSION['flash']['success'] = "Votre compte a bien été valider";
    // j'ai créer un index
    $_SESSION['auth'] = $user;
    header('location: compte.php');
    
}else{
    // j'ai créer des message flach pour montrer a l'utilisateur l'erreur effectuer
    $_SESSION['flash']['danger'] = "ce token n'est plus valide";
    header('location : login.php');
}

