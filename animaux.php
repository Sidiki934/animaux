<?php
include_once 'db_connect.inc.php';
// Teste si session est active ou non 
session_start();
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
  <title>PETGAME</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="shortcut icon" href="pics/monkey.png" type="image/x-icon">
  <link rel="stylesheet" href="css/header.css">
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
  <?php
  if(isset($_SESSION['type']) && $_SESSION['type']==1){
    echo 
'<a href="animaux_edit.php"><button type="button" class="btn btn-success mt-3">Ajouter un animal</button></a>
<a href="annonce_list.php"><button type="button" class="btn btn-danger mt-3 ml-3">La liste des annonces</button></a>';
}
  
?>
<div class="mt-3" style="display: <?php echo ($connected?'':'none')?>">
  
<label class="mt-3">Recherchez par région: </label>
<input type="text" id="region" class="form-control">
<label class="mt-3">Recherchez par générique: </label>
<input type="text" id="generique" class="form-control">
</div>
<div class="row" id="animaux" style="display: <?php echo ($connected?'':'none')?>">

	 <?php
    $sql = 'SELECT p.fname AS anim, g.nom AS gener, c.fname AS client, r.regionName AS reg, p.gender AS gend, p.photo AS tof, p.pet_id AS pet_id FROM pet p JOIN contacts c ON p.cli_id=c.cli_id JOIN generique g ON p.gen_id=g.gen_id JOIN region r ON p.reg_id=r.reg_id';
    $data = $conn->prepare($sql);
    $data->execute();
   /* $data = $pdo->query($sql);*/
    $html = '';
    while ($row = $data->fetch()) {
      $html .= '<div class="card p-3 m-3" style="width: 15rem;">';
      $html .= '<img src="'.($row['tof']===null?'pics/generic.jpg':$row['tof']). '" class="card-img-top" style="width:13em;height:9.5em" />';
      $html .= '<div class="card-body">';
      $html .= '<h5 class="card-title">'.$row['anim'].'</h5>';
      $html .= '<p class="card-text"><strong>Propriétaire: </strong>'.$row['client'].'</p>';
      $html .= '<p class="card-text"><strong>Région: </strong>'.$row['reg'].'</p>';
      $html .= '<p class="card-text"><strong>Générique: </strong>'.$row['gener'].'</p>';
      $html .= '<p class="card-text"><strong>Genre: </strong>'.$row['gend']. '</p>';
      $html .= '<a  class="btn btn-success" href="annonce.php?pet_id='.$row['pet_id'].'">Afficher l\'annonce</a>';
      $html .= '</div>';
      $html .= '</div>';
    }
    echo $html;
    
  ?>
</div>
</div>
<footer>
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
      <script>
        document.getElementById('region').addEventListener('blur', function() {
            // Requête AJAX pour lecture dans BDD
            let xhr = new XMLHttpRequest();
            xhr.open('get', 'animaux_ajax.php?region=' +this.value, true);
            xhr.addEventListener('readystatechange', function() {
                if (xhr.status === 200 && xhr.readyState === 4) {
document.getElementById('animaux').innerHTML = xhr.responseText;
                }
            }, false);
            xhr.send();
        });

        document.getElementById('generique').addEventListener('blur', function() {
            // Requête AJAX pour lecture dans BDD
            let xhr = new XMLHttpRequest();
            xhr.open('get', 'generique_ajax.php?generique=' +this.value, true);
            xhr.addEventListener('readystatechange', function() {
                if (xhr.status === 200 && xhr.readyState === 4) {
document.getElementById('animaux').innerHTML = xhr.responseText;
                }
            }, false);
            xhr.send();
        });
    </script>
</body>
</html>