<?php
include 'include/header.php'; 
// requierir le fichier function qui va ma peremettre de recuperer les different requet 
require_once('config/function.php');
// une variable article qui sera egal a la fonction get arcticle 
$articles= getArticles();

?>
     <div class="pBlog">
         <h1> Blog</h1>
             <section id="section2">
    
                 <a href="#articleContener"><span></span></a>
             </section> 
    </div>
<br><br>
     <div id="articleContener">
<?php 
         
         foreach ($articles as $articles)
 :?>
     <div class="article">
     <!-- le titre de l'article -->
          <h2><?= $articles->Titre?></h2>
          <br><br>7
    <!-- l'image de l'article -->
              <img src="imageBlog/<?=$articles->image?>"/>
          <br>
          <!-- petit paragraphe -->
               <p><?= $articles->Description?></p>
        <!-- la date de création de l'article -->
               <time><?= $articles->Date?></time>
<br>
<br>
<!-- le lien pour la -->
              <a href="article.php?id= <?= $articles->id ?>">lire la suite</a>
<br>
</div>

<?php endforeach; ?>
</div>


<?php include 'include/footer.php';?>