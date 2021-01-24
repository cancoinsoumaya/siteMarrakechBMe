<?php 
// je met une condition si les champs ne pas vide 
  if(!empty($_POST) && !empty($_POST['email'])) {
    //   je prépare la requette 
      require_once 'include_compte/db.php';
      require_once 'include_compte/fonctionCompte.php';
      
      $req=$pdo->prepare('SELECT * FROM utilisateurs WHERE email= ? AND validation_at IS NOT NULL ');
      $req->execute([$_POST['email']]);
    
      $user = $req->fetch();
    //  J'ai rajouter une condition pour faire la verification de mot de passse entré
    if($user){
        // j'ai generer un npuveau token
        session_start();
        $reset_token = str_random(60);
        $pdo->prepare('UPDATE utilisateurs SET reset_token = ? , reset_at = NOW() WHERE id = ?')->execute([$reset_token, $user->id]);
        $_SESSION['flash']['success'] = "Les instructions de rappel de mot de passe vous ont été envoyées";
        $message="Bonjour" ."".$_POST['username']." A fin de renitialiser votre mot de passe merci de cliquer sur ce lien\n\nhttp://localhost/MarrakechByMe/reset.php?id={$user->id}&token=$reset_token";
        
        mail($_POST['email'],'Reinitialisation de mot de passe' ,$message );
        header('location: login.php');
        exit();
    }else{
        $_SESSION['flash']['danger'] = "Aucun compte ne correspond a cet adresse";
  
    }
  }
?>

<?php
require 'include/header.php';?>
<div class=" pConnexion">
<h1> Mot de passe oublié</h1>
</div >
<form action="" method="POST">
<!-- div qui contient les element de formulaire -->
     <div class="formconnexion">
        
         
         <input type="email" name="email"  id="defaultContactFormName" class="form-control mb-4"placeholder="Votre Mail" />
    
        

         <button class="btn btn-info btn-block" type="submit"> Se connecter</button>
     </div>
</form>
<br><br>

<?php require 'include/footer.php';?>