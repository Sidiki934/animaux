<?php

/**
*Génère un mot de passe aléatoire basé sur un dico de caratères
* @param {int} $len - taille en caractères du mot de passe
* @return {string} mot de passe généré
*/

function get_password($len=8) : string {
$dico = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789_&@$*';
$pass = str_shuffle($dico);
$pass = substr($pass, 0, $len);
return $pass;
}
?>