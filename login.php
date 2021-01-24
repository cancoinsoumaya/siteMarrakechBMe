<?php 
  require_once 'include_compte/fonctionCompte.php';
      
reconnect_from_cookie();

// si l'utilisateur est déja connecter
if(isset($_SESSION['auth'])){

    header('location: compte.php'); 
    exit();
}
// je met une condition si les champs ne pas vide 
  if(!empty($_POST) && !empty($_POST['username']) && !empty($_POST['password'])){
    //   je prépare la requette 
      require_once 'include_compte/db.php';
    
      $req=$pdo->prepare('SELECT * FROM utilisateurs WHERE (username=:username OR email = :username) AND validation_at IS NOT NULL ');
      $req->execute(['username'=> $_POST['username']]);
    //   je recupere l'utilisateur
      $user = $req->fetch();
    //  J'ai rajouter une condition pour faire la verification de mot de passse entré
    if(password_verify($_POST['password'], $user->password)){
        
        $_SESSION['auth'] = $user;
        $_SESSION['flash']['success'] =  "Vous étes maintenant connecté";
       
        // la rrequette pour se rappeler de moi
        // si ila coche
        if($_POST['remember']){

            $remember_token = str_random(250);
            $pdo->prepare('UPDATE  utilisateurs SET remember_token=? WHERE id=?')->execute([$remember_token, $user->id]);
            // je le sauvegarde dans une cookies
            setcookie('rememeber', $user->id. '==' .$remember_token . sha1($user->id. 'marrakech'),time() + 60 * 60 * 24 * 7 );

        }
     
        header('location: compte.php');
        exit();
    }else{
        $_SESSION['flash']['danger'] ="Votre identifiant ou votre mot de passe incorrecte";
    }
  }
?>

<?php
require 'include/header_compte.php';?>
<div class="pConnexion">
<h1> Se connecter </h1>
</div>
<form action="" method="POST">
<!-- div qui contient les element de formulaire -->
     <div class="formconnexion">
         
         <input type="text" name="username" id="defaultContactFormName" class="form-control mb-4" placeholder="Pseudo ou Mail" />
    
         
         <input type="password" name="password" id="defaultContactFormName" class="form-control mb-4" placeholder="Mot de passe" />
         <a href="oublier.php">(J'ai oublie mon mot de passe)</a>
 
    <div class="">
    
       <input type="checkbox" name="remember" value="1"/>Se souvenir de moi
   
    </div>
         <button class="btn btn-info btn-block" type="submit"> Se connecter</button>
     </div>
</form>
<br><br>
<?php require 'include/footer.php';?>