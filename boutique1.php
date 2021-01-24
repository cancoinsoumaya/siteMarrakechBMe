<?php
    session_start();
    
    // connexion avec la base de données
 
    $bdd= new PDO('mysql:host=localhost:3306; dbname=marrakechbyme;charset=utf8','root','');
    $bdd->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
     // la requette pour ajouter le produit au tableau
     if (isset($_POST["add"])){
        // si on est a la session avec la cle cart 
        if (isset($_SESSION["cart"])){
            // retourner la valeur d'id recuperer par bl'input
            $item_array_id = array_column($_SESSION["cart"],"product_id");
            if (!in_array($_GET["id"],$item_array_id)){
                $count = count($_SESSION["cart"]);

                // variablke pour stocké les information recupérer de formulaire
                $item_array = array(
                    'product_id' => $_GET["id"],
                    'item_name' => $_POST["hidden_name"],
                    'product_price' => $_POST["hidden_price"],
                    'item_quantity' => $_POST["quantity"],
                );
                $_SESSION["cart"][$count] = $item_array;
                header ('location: boutique1.php');
            }else{
                echo '<script>alert("Ce produit est déja ajouter a vitre panier")</script>';
                echo '<script>window.location="boutique1.php"</script>';
            }
        }else{
            $item_array = array(
                'product_id' => $_GET["id"],
                'item_name' => $_POST["hidden_name"],
                'product_price' => $_POST["hidden_price"],
                'item_quantity' => $_POST["quantity"],
            );
            $_SESSION["cart"][0] = $item_array;
        }
    }

    if (isset($_GET["action"])){
        // requette pour supprimer un produit
        if ($_GET["action"] == "delete"){
            foreach ($_SESSION["cart"] as $keys => $value){
                if ($value["product_id"] == $_GET["id"]){
                    unset($_SESSION["cart"][$keys]);
                
                    header ('location: boutique1.php');
                  
                }
            }
        }
    }
?>


  
<!-- iclure le header -->
<?php include 'include/header.php';?>

<div class="pboutique">
<h1> Boutique</h1>
<section id="section2">
    
    <a href="#boutiqueContener"><span></span></a>
    </section> 
</div>

 

        <?php

        // recuperer tous les information dans le tableau produits de la base cde données
        $result=$bdd->query("SELECT * FROM produits ORDER BY id ASC ");
         ?>
             
            <?php if($result->rowCount()  >0)  {?>
                <div id="boutiqueContener">
                <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    
                    ?>
                   <div class="boutique">
                         
                    <!-- formulaire de produit -->
      
                        <form method="post" action="boutique1.php?action=add&id=<?php echo $row["id"]; ?>" class="photo2">

                            
                                <img src="image/<?php echo $row["photo"]; ?>" class="img-responsive">
                                <h5 ><?php echo $row["nom"]; ?></h5>
                                <h5 ><?php echo $row["prix"]; ?>€</h5>
                                <input type="text" name="quantity" class="form-control" value="1">
                                <input type="hidden" name="hidden_name" value="<?php echo $row["nom"]; ?>">
                                <input type="hidden" name="hidden_price" value="<?php echo $row["prix"]; ?>">
                                <input type="submit" name="add"  class="btn btn-success" value="Ajouter">
                            
                        </form>
                
                    </div>
                
                <br><br>
          
                    <?php
                }
            }
        ?>
</div>
<div style="clear: both"></div>
        <h3 class="title2">Votre panier</h3>
        <div class="table-responsive">
            <table class="table table-bordered">
            <tr>
                <th >Nom de Produit</th>
                <th >Quantité</th>
                <th>Prix</th>
                <th >Prix Total</th>
                <th >supprimer</th>
            </tr>

            <?php
                if(!empty($_SESSION["cart"])){
                    $total = 0;

                    // une boucle avec condition pour parcourir les valeur de formulaire cmme clé
                    foreach ($_SESSION["cart"] as $key => $value) {
                        ?>

                        <!-- tableau de panier -->
                        <tr>
                            <td><?php echo $value["item_name"]; ?></td>
                            <td><?php echo $value["item_quantity"]; ?></td>
                            <td> <?php echo $value["product_price"]; ?>€</td>
                            <td>

                            <!-- formater le nombre pour l'afficher -->
                                <?php echo number_format($value["item_quantity"] * $value["product_price"], 2); ?>€</td>
                            <td><a href="boutique1.php?action=delete&id=<?php echo $value["product_id"]; ?>"><span
                                        class="text-danger" id="alerts">supprimer</span></a></td>

                        </tr>
                        <?php
                        // variable pour stocke le prix total
                        $total = $total + ($value["item_quantity"] * $value["product_price"]);
                    }
                        ?>
                        <tr>
                            <td colspan="3" >Prix Total</td>
                            <th > <?php echo number_format($total, 2); ?>€</th>
                            <td></td>
                        </tr>
                        <?php
                    }
                ?>
            </table>
            <br><br>
            <input type="submit" name="commender"  class="btn btn-success" value="commender">
        </div>

    </div>
<br><br><br>
<?php include 'include/footer.php'; ?>
      