<!-- demarer la session -->
<?php session_start();?>
<?php include 'include/header.php'?>
<!-- page contact -->
<!-- petit paragrahphe pour présenté la page de contact  -->
<div class="pContact">

  <p>Nous vous proposons d'utiliser le formulaire ci-dessous pour nous contacter. Nous mettons tout en oeuvre pour vous répondre .merci de préciser l'objet de votre demande.</p>
  <section id="section2">
    
    <a href="#contactcontener"><span></span></a>
    </section> 
</div>
    <?php
    // affichage de message d'erreur
     if(array_key_exists('errors',$_SESSION)):?>
     <div class="alert alert-danger">
     <?= implode('<br>', $_SESSION['errors']);?>

     </div>

     <?php unset($_SESSION['errors']); endif;?>
     <?php
    //  affichage de message de reuissite
     if(array_key_exists('errors',$_SESSION)):?>
     <div class="alert alert-danger">
     <?= implode('<br>', $_SESSION['errors']);?>

     </div>

     <?php unset($_SESSION['errors']); endif;?>
<!-- Default form contact -->
<section id="contactcontener">
<form class="text-center border border-light p-5" action="post_contact.php" method="POST">

    <p class="h4 mb-4">Contacter nous</p>

    <!-- Nom -->
  
    <input type="text"  name="name" id="defaultContactFormName" class="form-control mb-4" placeholder="Nom">

    <!-- Email -->
    <input type="email" name ="email" id="defaultContactFormEmail" class="form-control mb-4" placeholder="Mail">

    <!-- Subet -->
    <input type="text"  name="sujet"id="defaultContactFormName" class="form-control mb-4" placeholder="Sujet">
    

    <!-- Message -->
    <div class="form-group">
        <textarea class="form-control rounded-0" name ="message" id="exampleFormControlTextarea2" rows="3" placeholder="Message"></textarea>
    </div>

    

    <!--envoyer le message -->
    <button class="btn btn-info btn-block" type="submit">Envoyer</button>

</form>
     </section>
<!-- Default form contact -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

<?php include 'include/footer.php';?>
</body>
</html>