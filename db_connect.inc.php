<?php
try{
    // Crée une connexion à la BDD
      $conn = new PDO(
        'mysql:host=localhost;dbname=petgame;charset=utf8', 
        'root',
        ''
      );

      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
      //echo '<p class=" alert alert-success mt-3" >Connexion OK'; 
    //Crée la requête à exécuter
      //Parcours chaque ligne du résultat de la requête

    }catch(PDOException $err){

  // Affiche le message si erreur
      echo '<p class="alert alert-danger">'.$err->getMessage();
    }
?>
