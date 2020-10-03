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
	<a href="">Nos Produits</a>	
	<a href="http://animaux/wordpress/?page_id=39">Contacts</a>	
	</div>
</nav>  
	<div class="container">
		<a href="animaux.php"><button type="button" class="btn btn-danger mt-3 ml-3 mb-3">Retour</button></a>
        <h1 class="mt-3">Ajout des animaux</h1>
	<?php
    try{
        // Si on est en mode mise à jour (si hot_id dans l'URL)
         if (isset($_GET['pet_id']) && !empty($_GET['pet_id'])) {
        $sql = 'SELECT * FROM pet WHERE pet_id = ?';
        $params = array($_GET['pet_id']);
        $data = $conn->prepare($sql);
        $data->execute($params);
        $row = $data->fetch();
        $update = true;

    }else{
        $row = array(
            'fname' => '',
            'cli_id' => '',
            'gen_id' => '',
            'reg_id' => '',
            'description' => '',
            'race' => '',
            'gender' => ''
        );
        $update = false;
    }
    }catch(PDOException $err){
    echo '<div class="alert alert-danger">'.$err->getMessage().'</div>';
    }

	 
    
    ?>

 <form action="animaux_act.php?pet_id=<?php echo ($update?$_GET['pet_id']: '');  ?>" method="post" enctype="multipart/form-data">
        <div class="group-control mt-3">
            <label for="fname">Nom de l'animal :</label>
            <input type="text" class="form-control" value="<?php echo $row['fname']; ?>" id="fname" name="fname" maxlength="50" required>
        </div>
         <div class="form-group mt-3">
        <label for="gen_id">Nom générique de l'animal :</label>
        <select name="gen_id" id="gen_id" class="form-control">
            <option>
                ---Faites votre choix---
                 <?php
            $val = $conn->query('SELECT gen_id, nom FROM generique');
            $html='';
            foreach ($val as $row1) {
                
                $html .= '<option value="'.$row1['gen_id'].'">'.$row1['nom'].'</option>';
                
            }
            echo $html;
            ?>
            </option>
            
        </select>
    </div>

        <div class="form-group">
        <label for="gender">Genre :</label>
        <select name="gender" id="gender" class="form-control">
            <option>
                ---Faites votre choix---
            </option>
            <option value="F">Femelle</option>
            <option value="M">Mâle</option>
        </select>
    </div>
         <div class="form-group">
            <label for="reg_id">Région: </label>
        <select name="reg_id" id="reg_id" class="form-control">
            <option>--Sélectionnez votre région--</option>
       <?php
            $val = $conn->query('SELECT c.reg_id AS reg, r.regionName AS region FROM contacts c LEFT JOIN region r ON c.reg_id = r.reg_id');
            $html='';
            foreach ($val as $row1) {
                
                $html .= '<option value="'.$row1['reg'].'">'.$row1['region'].'</option>';
                
            }
            echo $html;
      ?>    
        </select>
    </div>
    <div class="form-group mt-3">
         <label for="cli_id">Propriétaire :</label>
        <select name="cli_id" id="cli_id" class="form-control">
            <option>
                ---Faites votre choix---
                 <?php
            $val = $conn->query('SELECT cli_id, fname FROM contacts');
            $html='';
            foreach ($val as $row1) {
                
                $html .= '<option value="'.$row1['cli_id'].'">'.$row1['fname'].'</option>';
                
            }
            echo $html;
            ?>
            </option>
            
        </select>
    </div>
    <div class="form-group mt-3">
         <label for="cli_id">Mail du propriétaire :</label>
        <select name="cli_id" id="cli_id" class="form-control">
            <option>
                ---Faites votre choix---
                 <?php
            $val = $conn->query('SELECT cli_id, mail FROM contacts');
            $html='';
            foreach ($val as $row1) {
                
                $html .= '<option value="'.$row1['cli_id'].'">'.$row1['mail'].'</option>';
                
            }
            echo $html;
            ?>
            </option>
            
        </select>
    </div>
    <div class="form-group mt-3">
         <label for="cli_id">Phone du propriétaire :</label>
        <select name="cli_id" id="cli_id" class="form-control">
            <option>
                ---Faites votre choix---
                 <?php
            $val = $conn->query('SELECT cli_id, phone FROM contacts');
            $html='';
            foreach ($val as $row1) {
                
                $html .= '<option value="'.$row1['cli_id'].'">'.$row1['phone'].'</option>';
                
            }
            echo $html;
            ?>
            </option>
            
        </select>
    </div>
 <div class="group-control mt-3">
            <label for="race">Race de l'animal :</label>
            <input type="text" class="form-control" value="<?php echo $row['race']; ?>" id="race" name="race">
        </div>
            <p class="mt-3">Description :</p>
            <textarea name="description" class="mt-2" id="description" value="<?php echo $row['description']; ?>" cols="90" rows="10"></textarea>
        <div class="group-control">
            <label for="photo">Photo de l'animal :</label>
            <input type="hidden" name="MAX_FILE_SIZE" value="1048576">
            <input type="file" class="form-control" id="photo" name="photo">
        </div>
       
        <div class="group-control mt-3">
            <input type="submit" class="btn btn-info" value="<?php echo ($update?'Mettre à jour': 'Ajouter'); ?>">
        </div>

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