<?php 
 if(session_status() == PHP_SESSION_NONE){
     session_start();
 }
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link type="text/css" rel="stylesheet" href="styles/site-css.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css?family=Oleo+Script:400,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Teko:400,700" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

<title>MarrakechByMe</title>
</head>
<body>
<header>
    
    <!-- l'entete du site  -->
        <!-- div contentenu de nav barre  -->
<div class="navSite" id="nav">
        <div class="containerNav">
              <div class="logo">
    
           <a href="accueil.php" > <img  src="images/logo.png" alt="lelogo" ></a>
               </div>
      
        <!-- la barre de nav avec le logo  -->
        <div class="ligne" id="ligneNav">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div class="links">
        <ul>
            <!-- le contenu de barre de nav -->
            <!-- une div pour travailler la position de chaque partie de la nav avec une class navlist -->
           
            <li ><a  href="activité.php" >Activités</a></li>
            <li ><a  href="boutique.php">Boutique</a></li>
            <li ><a href="blog.php">Blog</a></li>
            <li><a  href="aproposdenous.php">Apropos</a></li>
            <?php 
            // je change la barre de navigation en cas de connexion de l'utilisateur
               if(isset($_SESSION['auth'])):
            ?>
            <li><a href="sedeconnecter.php">Se deconnecter</a></li>
     
               <?php else:?>
            <li><a href="register.php">Inscription</a></li>
            <li><a href="login.php">Se connecter</a></li>
               <?php endif;?>
            <li><a href="contact.php">Contact</a></li>
        </ul>
        <div class="clearfix"></div>
    </div>
       
</div>  
       
</div>

    
</header>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<script type ="text/javascript" src="script_site.js"></script> 

<?php
    if(isset($_SESSION['flash'])):
?>
<?php foreach($_SESSION['flash'] as $type => $message): ?>

<div class="alert-erreur">
 <?= $message;?></div>
<?php endforeach;?>
<?php unset($_SESSION['flash']); ?>
<?php endif;?>