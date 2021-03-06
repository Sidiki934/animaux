<?php
include_once 'db_connect.inc.php';

// Crée ou restaure une session
session_start();

// Test saisie
if(isset($_POST['mail']) && !empty($_POST['mail']) && isset($_POST['pass']) && !empty($_POST['pass']) &&
isset($_POST['captcha']) && !empty($_POST['captcha'])){
	// Analyse et tranforme la saisie
	$mail=htmlspecialchars($_POST['mail']);
	$pass=htmlspecialchars($_POST['pass']);
	$pass=sha1(md5($pass).sha1($mail));

// Prépare la requête d'authentification
$sql = 'SELECT type, COUNT(*) AS Nb FROM contacts WHERE mail=? AND pass=? GROUP BY type';
$params = array($mail, $pass);
$data= $conn->prepare($sql);
$data->execute($params);
$row=$data->fetch();

// Test authentification
if((int) $row['Nb'] === 1){
	if($_POST['captcha'] === $_SESSION['captcha']){
		session_unset();
		session_destroy();
		// Créer une session
	session_start();
	$_SESSION['mail'] = $mail;
	$_SESSION['type'] = $row['type'];
	$_SESSION['connected'] = true;
	$_SESSION['connection_time'] = date('Y-m-d h:i:s');
	$_SESSION['ip'] = $_SERVER['REMOTE_ADDR']; // Pour IP Localisation par exemple
	// Créer un cookie
	setcookie('subscriber', json_encode($_SESSION), time()+30*24*60*60);
	// Redirection vers INDEX
	header('location:index.php');
}else{
	header('location:login.php?auth=false');
}
	
}

}else {
	header('location: login.php?auth=false');
}



/*var_dump($_POST);*/

?>