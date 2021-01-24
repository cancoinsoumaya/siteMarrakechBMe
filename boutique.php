<?php 
// requierir le fichier function qui va ma peremettre de recuperer les different requet 
require_once('inc/function_boutique.php');
// une variable article qui sera egal a la fonction get arcticle 
$produits= getProducts();

?>
<?php
include 'include/header.php';
?>
   
<div class="pboutique">
<h1> Boutique</h1>
</div>
<section id="section2">
    
    <a><span></span></a>
    </section> 

<div class="boutique">
<?php 
foreach ($produits as $produits)
 :?>
<br>
<div class='photo2'>
 <figure>
 <img  src="image/<?=$produits->photo?>" />
 <figcaption class="boutiquet"><h2><?= $produits->nom?></h2><br>
 <a href ="produit.php?id= <?=$produits->id?>"> Ajouter</a></figcaption>
</figure>
</div>
<?php endforeach; ?>
</div>
</body>
</html>