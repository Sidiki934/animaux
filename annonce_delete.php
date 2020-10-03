<?php
// Teste si ID passe en paramètres
if(isset($_GET['pet_id']) && !empty($_GET['pet_id'])){
try{
include_once 'db_connect.inc.php';
$sql= 'DELETE FROM pet WHERE pet_id = ?';
$params = array($_GET['pet_id']);
$data = $conn->prepare($sql);
$data->execute($params);
unset($conn);
header('location: annonce_list.php');
} catch(PDOException $err){
echo '<p>'.$err->getMessage().'</p>';
}
}

?>