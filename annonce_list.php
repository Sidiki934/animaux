<?php
include_once 'header.inc.php';
// Imports
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
  <title>PETGAME</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="shortcut icon" href="pics/monkey.png" type="image/x-icon">
  <link rel="stylesheet" href="css/header.css">
  <link rel="stylesheet" href="css/footer.css">
  <link rel="stylesheet" href="css/annonce.css">
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
	<a href="animaux.php"><button type="button" class="btn btn-danger mt-3 ml-3 mb-3">Retour</button></a>
        <h1 class="mt-3 mb-3">Liste des annonces</h1>
	<?php
	try {

// Préparation et exécution requête
		$sql = 'SELECT p.pet_id AS "Code", p.fname AS "Nom de l\'animal" , g.nom AS "Générique", c.fname AS "Propriétaire", r.regionName AS "Région", p.gender AS "Genre", p.photo AS "Photo" FROM pet p JOIN contacts c ON p.cli_id=c.cli_id JOIN generique g ON p.gen_id=g.gen_id JOIN region r ON p.reg_id=r.reg_id';
		$data = $conn->prepare($sql);
$data->execute(); // Renvoie dataset avec colonnes et lignes

// Crée le tableau/en-tête
$html = '<table class="table table-striped table-hover">';
$html .= '<thead><tr>';

for ($i = 0; $i < $data->columnCount(); $i++) {
// Affiche le nom des colonnes extrait du dataset
// $html .= '<th>Colonne ' . ($i + 1) . '</th>';
	$meta = $data->getColumnMeta($i);
	$html .= '<th>' . $meta['name'] . '</th>';
// stocke dans un tableau associatif le nom de la colonne
// associé à son type de données
	$types[$meta['name']] = $meta['native_type'];
}
$html .= '</tr></thead>';

// crée le corp du tableau
$html .= '<tbody>';
while ($row = $data->fetch()) { // Pour chaque ligne du dataset
	$html .= '<tr>';
foreach ($row as $col=>$val) { // Pour chaque colonne de la ligne
//teste le type de la colonne
	switch ($types[$col]) {
		case 'FLOAT':
		case 'INT':
		case 'INTEGER':
		case 'NEWDECIMAL':
		$align = 'align="right"';
		break;
		case 'DATE':
		case 'DATETIME':
		$align = 'align="center"';
		break;
		default:
		$align = 'align="left"';
		break;
	}
// A joute la donnée dans sa cellule ou dans une image
	if ($types[$col] === 'BLOB' && $val !== null) {
		$html .= '<td><img src="' . $val . '" style="width:8em;height:4.5em"</td>';
	} else {
		$html .= '<td .'. $align .'>' . $val . '</td>';
	}
}
// Ajoute bouton MAJ et SUPPR
$html .= '<td><a class="btn btn-warning" href="animaux_edit.php?pet_id='.$row['Code'].'">Modifier</a>';
$html .= '<td><a class="btn btn-danger" href="annonce_delete.php?pet_id='.$row['Code'].'">Supprimer</a>';
$html .= '</tr>';
}
// Ajoute bouton MAJ et SUPPR
$html .= '</tbody>';
$html .= '</table>';
echo $html;
} catch (PDOException $err) {
	echo '<p class="alert alert-danger">' . $err->getMessage() . '</p>';
}

?>
</div>
<script>
	// Branche un écouteur sur l'évènement window.ONLOAD
	window.addEventListener(
		'load',
		function(){
			// Branche un écouteur sur l'évènement A.BTN-DANGER->ONCLICK
			let buttons = document.querySelectorAll('a.btn-danger');
			for(let i=0; i < buttons.length; i++){
				buttons[i].addEventListener(
					'click',
					function(evt){
						evt.preventDefault();
						let answer = confirm('Voulez-vous vraiment supprimer cette ligne ?');
						if(answer){
							location.href = evt.target.href;
						}
					},
					false
				);
			}
		},
		false

	);
</script>

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

</body>
</html>