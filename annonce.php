<?php
include_once 'header.inc.php';
include_once 'db_connect.inc.php';

if(isset($_SESSION['connected'])&& !empty($_SESSION['connected'])&& $_SESSION['connected'] === true){
  $connected = true;
}else{
  $connected =false;
}
?>

<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PETGAME</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="shortcut icon" href="pics/monkey.png" type="image/x-icon">
  <link rel="stylesheet" href="css/header.css">
  <link rel="stylesheet" href="css/annonce.css">
  <link rel="stylesheet" href="css/footer.css">
</head>
<body>
<nav>
	<div class="head">
	<div class="logo">
    <a href="index.php"><img src="animals.png" style="width: 45px;" onclick="this.style.transform='rotate(180deg)'"></a>
    <p class="mt-2" style="font-size: 15px; font-weight: bolder; margin-bottom: 0px;">Petgame</p>
    <p>Ici les animaux sont les maîtres !</p>
    </div>
	  <div class="connexion">
    <div class="lol">
    <a href="login.php"><img src="pics/web.png" style="width: 15px; height: 15px; margin-right: 20px; display: <?php echo ($connected?'none':'')?>">
    <p style="margin-right: 20px; display: <?php echo ($connected?'none':'')?>">Connexion</p></a>
    </div>
    <div class="lol">
      <a href="logout.php"><img src="pics/web.png" style="width: 15px; height: 15px; display: <?php echo ($connected?'':'none')?>">
    <p style="display: <?php echo ($connected?'':'none')?>">Deconnexion</p></a>
    </div>
  </div>
</div>
<div class="menu" >
	<a href="animaux.php">Animaux</a>	
	<a href="http://animaux/wordpress/?post_type=product">Nos Produits</a>	
	<a href="http://animaux/wordpress/?page_id=39">Contacts</a>	
	</div>
</nav>  
<div class="container">
<a href="animaux.php"><button type="button" class="btn btn-danger mt-3 ml-3">Retour</button></a>
<?php
try{
    	// Si on est en mode mise à jour (si hot_id dans l'URL)
    	 if (isset($_GET['pet_id']) && !empty($_GET['pet_id'])) {
        $sql = 'SELECT p.fname AS anim, g.nom AS gener, c.fname AS client, r.regionName AS reg, p.gender AS gend, p.race AS race, c.phone AS phone, c.mail AS mail, p.description AS description, p.photo AS tof, p.pet_id AS pet_id FROM pet p JOIN contacts c ON p.cli_id=c.cli_id JOIN generique g ON p.gen_id=g.gen_id JOIN region r ON p.reg_id=r.reg_id WHERE pet_id = ?';
        $params = array($_GET['pet_id']);
        $data = $conn->prepare($sql);
        $data->execute($params);
        $row = $data->fetch();
    }
    }catch(PDOException $err){
    echo '<div class="alert alert-danger">'.$err->getMessage().'</div>';
    }
    $html = '';
    $html .= '<div class="cont mt-3" style="background-color: #d5d6d7; border: 4px solid black; padding: 10px;">';
    $html .= '<div class="annonce-container mt-3" style="display: flex; flex-wrap: wrap; justify-content: space-around; margin: 0 auto;">';
    $html .= '<div class="annonce" style="width:50%";>';
    $html .= '<h1 style="text-align: left;"><strong>'.$row['anim']. '</strong></h1>';
    $html .= '<img class="co mt-3" src="'.($row['tof']===null?'pics/generic.jpg':$row['tof']). '"   />';
    $html .= '</div>';
    $html .= '<div class="ann" style="width: 50%; margin-top: 55px;">';
    $html .= '<p><strong>Nom de l\'animal: </strong>'.$row['anim'].'</p>';
    $html .= '<p><strong>Nom générique de l\'animal: </strong>'.$row['gener'].'</p>';
    $html .= '<p><strong>Propriétaire: </strong>'.$row['client'].'</p>';
    $html .= '<p><strong>Numéro de téléphone du propriétaire: </strong>'.$row['phone'].'</p>';
    $html .= '<p><strong>Mail du propriétaire: </strong>'.$row['mail'].'</p>';
    $html .= '<p><strong>Race: </strong>'.$row['race'].'</p>';
    $html .= '<p><strong>Région du propriétaire: </strong>'.$row['reg'].'</p>';
    $html .= '<p><strong>Genre: </strong>'.$row['gend'].'</p>';
    $html .= '<p ><strong>Description: </strong>'.$row['description'].'</p>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';
    echo $html;

?>
</div>
<footer class="mt-3">
	<div class="foot">
		<div>
			<h1 class="title">
				Nos informations
			</h1>
		</div>
		<div class="social">
			<a href=""><img src="pics/facebook-square.svg" style="width: 25px;"></a>
			<a href=""><img src="pics/google-plus-square.svg" style="width: 25px;"></a>
			<a href=""><img src="pics/tumblr-square.svg" style="width: 25px;" ></a>
			<a href=""><img src="pics/twitter-square.svg" style="width: 25px;" ></a>
		</div>
		<div class="question">
			<a href=""><p>Qui sommes-nous?</p></a>
			<a href=""><p>Mentions légales</p></a>
			<a href=""><p>Nos conseils</p></a>
		</div>
	</div>
	<div class="foo">
		<p>Credit Sidiki Camara Petgame &#xA9;</p>
	</div>
</footer>

</body>
</html>