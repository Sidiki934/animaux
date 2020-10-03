<?php
// Imports
// Se connecter à la BDD
include_once 'db_connect.inc.php';
include_once 'fonctions.inc.php';

// Verifier que l'adresse mail est nouvelle (pas de doublon)
$sql = 'SELECT COUNT(*) AS Nb FROM contacts WHERE mail = ?';
$params = array($_POST['mail']);
$data = $conn->prepare($sql);
$data->execute($params);
$row = $data->fetch();

var_dump($params);
if((int) $row['Nb'] === 0){
	// Insérer les données dans la table SUBSCRIBERS
	$sql = 'INSERT INTO contacts(fname, mail, phone dob, gender, type, pass, reg_id) VALUES(:fname, :mail, :dob, :gender, :type, :phone, :pass, :reg_id)';
	//Préparer la requête SUBSCRIBERS
	$data =$conn->prepare($sql);
	// Solution 2 avec ARRAY
	$pass = get_password(); //'basique'; 
	$hash = sha1(md5($pass).sha1($_POST['mail']));
	$params = array(
		':fname' => htmlspecialchars($_POST['fname']),
		':mail' => htmlspecialchars($_POST['mail']),
		':dob' => htmlspecialchars($_POST['dob']),
		':gender' => htmlspecialchars($_POST['gender']),
		':type' => htmlspecialchars($_POST['type']),
		':phone' => htmlspecialchars($_POST['phone']),
		':reg_id' => htmlspecialchars($_POST['reg_id']),
		':pass' => $hash
	);
	$data->execute($params);

	// Envoyer un mail de confirmation d'inscription
	
	$html = '<p>Bienvenue ' .$_POST['fname'].',';
	$html .= '<p>Nous vous confirmons votre inscription à Petgame, vous pouvez désormais vous connecter en tant que membre en utilisant les accréditations suivantes :';
	$html .= '<ul>';
	$html .= '<li> Identifiant:' .$_POST['mail'];
	$html .= '<li> Mot de passe:' .$pass;
	$html .= '</ul>';
	$html .= '<p> A très vite sur PETGAME';

	//Header du mail: TRES IMPORTANT

	$header = "MIME-Version: 1.0 \n"; // Version MIME
	$header .= "Content-type: text/html, charset=utf8 \n"; // Format du mail
	$header .= "From: sidcoma@outlook.fr \n"; //Expéditeur
	$header .= "Reply to: grec@faim.com \n";
	$header .= "Disposition-Notification-To: cocorico@poule.fr \n"; // Accusé de reception
	$header .= "X-Priority: 1\n";
	$header .= "X-MSMailPriority: High \n";

	// Envoi du mail
	mail($_POST['mail'], 'Confirmation inscription', $html, $header);

	// Renvoie vers INDEX
	header('location: index.php');

	echo '<p>OK';
}else{
	echo 'L\'adresse mail existe déjà dans la base de données !';
}



?>