<?php
include_once 'db_connect.inc.php';
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
  <h1 class="mt-3">Formulaire d'inscription</h1>
  <form action="register_act.php" method="post">
  	<div class="form-group">
  		<label for="fname">
  			Prenom
  		</label>
  		<input type="text" id="fname" name="fname" class="form-control" maxlength="30" 
  		 pattern="[A-Za-zàâäéèêëôöîïûü\- ]{3,30}" required>
  	</div>
  	<div class="form-group">
  		<label for="mail">Email</label>
  		<input type="email" name="mail" id="mail" required class="form-control">
  	</div>
    <div class="form-group">
      <label for="mail">Numéro de téléphone</label>
      <input type="text" name="phone" id="phone" class="form-control">
    </div>
  	<div class="form-group">
  		<label for="dob">Date de naissance</label>
  		<input type="date" name="dob" id="dob" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" class="form-control">
  	</div>
    <div class="form-group">
            <label for="reg_id" class="mt-3">Région: </label>
        <select id="reg_id" name="reg_id" class="form-control">
            <option>--Sélectionnez votre région--</option>
            <?php
            $val = $conn->query('SELECT reg_id, regionName FROM region ORDER BY reg_id');
            $html='';
            foreach ($val as $row1) {
                
                $html .= '<option value="'.$row1['reg_id'].'">'.$row1['regionName'].'</option>';
                
            }
            echo $html;
            ?>
        </select>
    </div>
    <div class="form-group">
      <label for="type">Particulier ou Propriétaire:</label>
      <select name="type" id="type" class="form-control">
        <option value="type">
          ---Faites votre choix---
        </option>
        <option value="0">Particulier</option>
        <option value="1">Propriétaire</option>
      </select>
    </div>
  	<div class="form-group">
  		<label for="gender">Genre</label>
  		<select name="gender" id="gender" class="form-control">
  			<option value="">
  				---Faites votre choix---
  			</option>
  			<option value="F">Féminin</option>
  			<option value="M">Masculin</option>
  			<option value="N">Neutre</option>
  		</select>
  	</div>
  	<input type="submit" value="S'inscrire" class="btn btn-info mb-3">
  </form>
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