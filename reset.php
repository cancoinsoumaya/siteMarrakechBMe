<?php 
// on va verifier si les informatios sont correct
if(isset($_GET['id']) && isset($_GET['token'])){
    // on va recuperer l'utilisateur pour verifier si il existe 
    require 'include_compte/db.php';
    require 'include_compte/fonctionCompte.php';
    // on va faire la requette preparer
    // on va selecter la date inferieur de 30 min de la date now 
    $req = $pdo->prepare('SELECT * FROM utilisateurs WHERE id = ? AND reset_token IS NOT NULL AND reset_token = ? AND reset_at > DATE_SUB(NOW(), INTERVAL 30 MINUTE)');
    $req->execute([$_GET['id'], $_GET['token']]);
    $user = $req->fetch();
    if($user){
        //  je verifier si les données sont posté
        if(!empty($_POST)){
            // je verifier que les deux mot de passe se correspond
            if(!empty($_POST['password']) && $_POST['password'] == $_POST['password_confirm']){
                $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
                $pdo->prepare('UPDATE utilisateurs SET password = ?, reset_at = NULL, reset_token = NULL')->execute([$password]);
                session_start();
                $_SESSION['flash']['success'] = 'Votre mot de passe a bien été modifié';
                $_SESSION['auth'] = $user;
                header('location: accueil.php');
                exit();

            }
        }
    }else{
        $_SESSION['flash']['error'] = "Le token rentrer n'est pa valide";
        header('location: login.php');
        exit();
    }
}else{
    header('location: login.php');
    exit();
}
?>

<?php
require 'include/header.php';?>
<br><br>
<div>
<h1> Réinitialiser le mot de passe  </h1>
</div>
<form action="" method="POST">
<!-- div qui contient les element de formulaire -->
     <div class="formotdepasseoublie">
       
 
         <input type="password" name="password" id="defaultContactFormName" class="form-control mb-4" placeholder="Mot de passe" />


         <input type="password" name="password_confirm"id="defaultContactFormName" class="form-control mb-4" placeholder="Confirmation de mot de passe"  />
    


         <button class="btn btn-info btn-block" type="submit"> Réinitialiser mon mot de passe</button>
     </div>
</form>

<?php require 'include/footer.php';?>