<?php
// le code pour se deconnecter 
session_start();
// je detruit le cookiers pour se rappeler de moi qand l'utilisateur se deconnecter

setcookie('remember' , NULL, -1);
unset($_SESSION['auth']);
// on stocke un message flash de succe
$_SESSION['flash']['success'] = "Abientot, Vous étes maintenant deconnecter";
header('location: login.php');