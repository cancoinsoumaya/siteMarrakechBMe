<?php
// J'ai creer pour se connecter a ala base de donneés 
// j'ai utiliser pdo
$pdo = new PDO('mysql:dbname=marrakechbyme;host=localhost', 'root', '');

// definir quelque des attribut j'ai utiliser setAttribut
// envoyer des exeption en cas d'erreur
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// recuperer les information sous forme d'objet
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);