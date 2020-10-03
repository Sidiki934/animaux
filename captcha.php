<?php
// Taille du captcha: 6 caractères

define('LENGTH', 6); // ou const LENGTH = 6

// Crée le tableau de caractères pour générer le captcha

$num = array(0, 1, 3,4,5,6,7,8,9); // archaïque

$lower = range('a', 'z');
$upper = range('A', 'Z');
$symbol = array('*', '+', '$', '&', '!', '?');
$mix = array_merge($num, $lower, $upper, $symbol);
shuffle($mix);

// Piocher au hasard 6 caractères dans le tableau MIX

$captcha = '';
for($i = 0; $i<LENGTH; $i++){
	$captcha .= $mix[rand(0,count($mix)-1)];
}

// Stocke la valeur du captcha dans la variable de session
session_start();
$_SESSION['captcha'] = $captcha;

// Ecrit le captcha dans une image générer par GD 
$zd = imagecreatetruecolor(160, 90);
$pen = imagecolorallocate($zd, 230, 230, 230);
$back = imagecolorallocate($zd, 23, 23, 23);
$fonts = 'fonts/MISTRALL.TFF';
imagefilledrectangle($zd, 0, 0, 160, 90, $back);
imagestring($zd, 5, 30, 40, $captcha, $pen);
//imagefttext($zd, 30, 20, 30, 70, $pen, $fonts, $captcha);

// Renvoie l'image au format PNG (donc binaire !!!)

header('content-type: image/png');
imagepng($zd);
imagedestroy($zd);

?>