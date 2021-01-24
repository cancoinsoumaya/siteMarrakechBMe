<?php
// j'ai créer une fonction pour debeuger les variables
function debug($variable){
    echo '<pre>' .print_r($variable, true) .'</pre>';
}
// j'ai créer une fonction pour generer une chaine de carractere pour valider le compte
function str_random($lenght){
    // j'ai créer une variable pour mettre mes chiffre et mes lettre en maniscule et en majiscule 
    $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";

    // j'ai effectue str_repeat pour repeter la variable 60 fois pour compliqué la chaine 
    // j'ai melange la chaine 
    // j'ai effectuer un substr pour generer une chaine de carractére de 60 en aleatoire

    return substr(str_shuffle(str_repeat($alphabet,$lenght)),0,$lenght);
    

}
// fonction pour s'inscrir une seule fois 
function inscrit_uni(){
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
    if(!isset($_SESSION['auth'])){
        $_session['flash']['danger'] = "Vous n'avez pas le droit d'accéder a cette page";
        header('location: login.php');
        exit();
    }
}
// fonction pour se reconnecter si l'utilisateur a mis remember me 

// je verifier si le compte d'utilisateur se trouve dans les cookies
function reconnect_from_cookie(){
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
if(isset($_COOKIE['remember']) && !isset($_SESSION['auth'])){
    require_once 'include_compte/db.php';
    // j'ai passer la variable pdo en global pour que il sera accepter partout dans le code
    
    if(!isset($pdo)){

        global $pdo;
    }
    
    $remember_token = $_COOKIE['remember'];
    // je separe le member token par ==
    $parts = explore('==', $remember_token);
    $user_id = $parts[0];
    $req = $pdo->prepare('SELECT * FROM utilisateurs WHERE id=?');
    $req->execute([$user_id]);
    $user = $req->fetch();
    if($user){
        // je recupere le cookie que j'ai fait je stocke cette information dans une variable
        $expected= $user_id. '==' .$user->remember_token . sha1($user_id. 'marrakech');;
    //   j'ai rajouter une condition pour comparer le cookie 
         if($expected == $remember_token){
            session_start();
            $_SESSION['auth'] = $user;
            // je renialise le token remember
            setcookie('remember', $remember_token, time() + 60 *60 * 24 *7);
     
            
         }else{
            setcookie('remember' , NULL, -1);  

         }
    }else {
        setcookie('remember' , NULL, -1);    
    }
}

}