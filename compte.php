<?php 
// je commence la session
session_start();
require 'include_compte/fonctionCompte.php';
inscrit_uni();
?>
<?php
include 'include/header.php';?>

<h1> Bonjour <?=$_SESSION['auth']->username;?><h1>


<?php include 'include/footer.php'?>
