<?php
// verification des données
// tableaux des serreurs
$errors = [];
// verification de nom 
if(empty($_POST['name']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['name'])){
    $errors['name']= "votre nom n'est pas valide ";
 }

//  verification du champs mail
 if(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
    $errors['email']= "votre email n'est pas valide";
}
// demarer la session
session_start();

// verification du champs message
if(empty($_POST['message'])){
    $errors['message']=" veuillez rentrer votre message";
 }
 if (!empty($errors)){

    //  message d'erreur
    
     $_SESSION['errors'] = $errors;
     header('location: contact.php');
 }else{
    //  message de reuissi
     $_SESSION['success'] = 1;
    $message = $_POST['message'];
    $headers = 'FROM: site@local.dev';

    //  envoi de mail
    mail('contact@local.dev','Formulaire de contact' , $message, $headers);
    header('location: contact.php');

 }
 
