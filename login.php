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
      <form action="login_act.php" method="post" class="container mt-3">
      <div class="modal-body">
      		<div class="form-group">
      			<label for="mail">Identifiant</label>
      			<input type="Email" name="mail" id="mail" class="form-control" placeholder="quiqui@gmail.com" required="">
      		</div>
      		<div class="form-group">
      			<label for="pass">Mot de passe</label>
      			<input type="password" name="pass" id="pass" class="form-control" required="">
      		</div>
          <div class="form-group">
            <label for="captcha">Captcha :</label>
            <input type="text" name="captcha" id="captcha" class="form-control">
              <div class="mt-3"><img src="captcha.php"></div>
          </div>
      	<div class="modal-footer">
        <input type="submit" value="Se connecter" class="btn btn-success mr-3">
        <a href="index.php" class="btn btn-warning">Retour</a>
      </div>
      </div>
       <?php

			if (isset($_GET['auth'])&& !empty($_GET['auth'])&& $_GET['auth'] === 'false'){
		echo '<div class="alert alert-danger mt-3" role="alert">c\'est faux </div>';
		}
		?>
    <a href="register.php" style="text-decoration: none; text-align: center;" class="mb-3"><p>Pas inscrit ? Créez vous un compte !</p></a>
      </form>
    </div>
   
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