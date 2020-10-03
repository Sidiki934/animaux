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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
<link rel="shortcut icon" href="pics/monkey.png" type="image/x-icon">
  <link rel="stylesheet" href="css/header.css">
  <link rel="stylesheet" href="css/style.css">
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
<div class="container mb-3 mt-3" style="background-color: #afacac85; padding: 10px 30px;">

<div id="carouselExampleIndicators" class="carousel slide mt-3" data-ride="carousel" style="width: 50%; margin:0 auto;">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="pics/chat.jpg" class="d-block w-100" style="width: 100%; height: 50vh;">
    </div>
    <div class="carousel-item">
      <img src="pics/dog.jpg" class="d-block w-100" style="width: 100%; height: 50vh;">
    </div>
    <div class="carousel-item">
      <img src="pics/perroquet.jpg" class="d-block w-100" style="width: 100%; height: 50vh;">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
	<div class="pres">
	<h1>Les présentations</h1>
	<p style="margin-top: 35px; width: 50%; margin: 0 auto;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim incidunt corrupti, a deserunt, fugit sit quos nesciunt! Reprehenderit est rerum quibusdam debitis, accusamus ad, vel harum explicabo nisi repudiandae repellendus. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veniam est neque sequi rerum, obcaecati hic totam animi consequuntur ipsa optio libero, ab inventore nam deserunt illo nostrum tempore. Quaerat, inventore.</p>
	</div>
	<h1>Les horaires</h1>
	<div class="horaire">
	<ul style="list-style: none;">
		<li>Lundi 10h00-18h00</li>
		<li>Mardi 10h00-18h00</li>
		<li>Mercredi 10h00-18h00</li>
		<li>Jeudi 10h00-18h00</li>
		<li>Vendredi 10h00-18h00</li>
		<li>Samedi 10h00-18h00</li>
		<li>Dimanche Fermé</li>
	</ul>	
	<p class="moit">Ouvert aussi tous les jours fériés sauf le 25 décembre et le 1er mai </p>
	</div>
	<h1>Nos services</h1>
	<div class="ser">
	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas dolore reiciendis asperiores obcaecati ab voluptates ipsam quod consectetur deserunt ex ad, quibusdam esse velit quia voluptas? Magnam accusantium, corporis autem.</p>
	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dicta asperiores tempora non enim eaque, nobis odio hic suscipit dolores in incidunt sequi ratione consequatur saepe officiis fugit voluptate expedita unde.</p>
	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsam, pariatur velit, nulla labore odit at non necessitatibus. Architecto temporibus facilis minus, soluta iste corporis. Ea reiciendis labore quas distinctio maxime?</p>
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

</body>
</html>