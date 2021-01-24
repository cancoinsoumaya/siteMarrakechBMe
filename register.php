<?php require 'include_compte/fonctionCompte.php';

session_start();

//    verfier est ce que les données etait poster
 if(!empty($_POST)){

    // j'ai créer une variable tableau pour verifier tous les erreurs rencontrer 
    $errors = array();
    require_once 'include_compte/db.php';

    // je verifier le champ pseudo
    // si le champ est vide et si les carractere n'est alphanumerique
    if(empty($_POST['username']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['username'])){
       $errors['username']= "votre pseudo n'est pas valide ";
    }
    // j'ai rajouter une condition si le pseudo est n'est pas deja enregistrer
    else{
        // je verifier si l'username enregistrer dans la base de données n'est celui la 

        $req=$pdo->prepare('SELECT id FROM utilisateurs WHERE username= ?');
        $req->execute([$_POST['username']]);
        // j'ai utiser la methose fetch
        $user = $req->fetch();
        // je renvoi l'erreur en cas de presence de pseudo dans ma base de données

        if($user){
            $errors['username'] = 'ce pseudo est déja pris';
        }
    }
    // la fonction pour debeuger les variables 
    // debug($errors);

    // verifier le champs email
    // si le champs est vide et si la forme de l'email n'est pas valide avec la fonction filtar_var
    if(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
         $errors['email']= "votre email n'est pas valide";
    }
    else{
        // je verifier si le mail n'est  enregistrer dans la base de données n'est celui la 

        $req=$pdo->prepare('SELECT id FROM utilisateurs WHERE email= ?');
        $req->execute([$_POST['email']]);
        // j'ai utiser la methose fetch
        $user = $req->fetch();
        // je renvoi l'erreur en cas de presence de mail dans ma base de données

        if($user){
            $errors['email'] = 'ce mail est déja utiliser pour un autre compte';
        }
    }
     

    // verifier le champs de mot de passe
    // si il est vide et si c'est le meme dans le champ valider votre mot de passe 
    if(empty($_POST['password'])|| $_POST['password'] != $_POST['password_confirm']){
        $errors['password'] = "vous devez rentrer un  mot de passe  valide ";
    }
    // si le tableau des erreurs est vide on va executer la requette 

    if(empty($errors)){
    // j'appel le dossier db pour relier a la base de données
    
    // Soquer la requete preparer dans une variable
    $req2 = $pdo ->prepare("INSERT INTO utilisateurs SET username = ?, password= ?, email = ?, validation_token= ?");

    // j'ai utiliser password_hash pour securiser le mot de passe d'utilisateur
    $password = password_hash($_POST['username'], PASSWORD_BCRYPT);
    // j'ai créer une variable pour stoqué une chaine de carractere generer par une fonction str_random
    $token =  str_random(60);
    
    $req2->execute([$_POST['username'], $password, $_POST['email'], $token]);
    //  j'au utliser la fonction mail pour envoyer le code de validation a l'utilisateur
    $message="Bonjour" .$_POST['username']." !\n\nVotre inscription au site MarrakechByMe vous est confirmée, \n\nA fin de valider votre compte merci de cliquer sur ce lien\n\nhttp://localhost/MarrakechByMe/confirm.php?id=$utilisateur_id&token=$token .";
    // j'ai créer une variable pour stocké la id de dernier utilisateur
    $utilisateur_id = $pdo->lastInsertId();
    mail($_POST['email'],'Confirmation de votre inscription' ,$message );
    $_SESSION['flash']['success'] = 'vous avez recus un mail de confirmation';
    header('location: login.php');
    exit();


    // envoyer le message de ruessir l'inscription
   
    }
  
 }
?>
<?php require 'include/header_compte.php';?>
<div class="pInscription">
<h1> Inscription</h1>
</div>
<!-- j'ai creer un formulaire pour enregistrer les infos pour s'enregitrer -->
<!-- le formulaire sant method pour se deriger vers la meme page -->
<!-- method post -->

<!-- j'ai creer une alerte pour afficher tous les message en relation avec le tableau d'erreurs -->
 
<?php if(!empty($errors)):?>
<div class="alert alert-danger">
<p> Vous n'avez pas rempli le formulaire correctement</p>
<ul>
<?php foreach($errors as $error):?>
<li><?=$error;?></li>
<?php endforeach; ?>
</ul>
</div>
<?php endif;?>
<form class="text-center border border-light p-5" action="" method="POST">
<!-- div qui contient les element de formulaire -->
     <div class="forminscription">
         
         <input type="text" name="username" id="defaultContactFormName" class="form-control mb-4" placeholder="Nom"/>
       
         <input type="text" name="email" id="defaultContactFormEmail" class="form-control mb-4" placeholder="Mail" />
         
         <input type="password" name="password" id="defaultContactFormEmail" class="form-control mb-4" placeholder="Mot de passe"/>
       
         <input type="password" name="password_confirm" id="defaultContactFormEmail" class="form-control mb-4" placeholder="Confirmer votre mot de passe"/>
        

         <button class="btn btn-info btn-block" type="submit"> S'inscrire</button>
     </div>
</form>
<?php require 'include/footer.php';?>