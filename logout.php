<?php
//Restaure la session à détruire
session_start();
//Détruit la variable super globale SESSION
session_unset();
//Arrête la session
session_destroy();

//Route vers le index.php
header('location: index.php');
?>