<?php
include_once 'db_connect.inc.php';
// Récupère les valeurs du formulaire : 2nde itération
    foreach ($_POST as $key=>$val) {
        if (isset($_POST[$key]) && !empty($_POST[$key])) {
            $params[':'.$key] = htmlspecialchars($val);
        } else {
            $params[':'.$key] = null;
        }
    }

// Récupération du fichier à téléverser
    if(isset($_FILES['photo'])&& $_FILES['photo']['error'] !== UPLOAD_ERR_NO_FILE){
    // Variables
    //var_dump($_FILES);
    // Extrait l'extension du nom de fichier
        $file_name = $_FILES['photo']['name'];
    // Extrait l'extension du fichier
        $file_ext = strtolower(substr($file_name, strrpos($file_name, '.')+1));

    // Taille du fichier
        $file_size = $_FILES['photo']['size'];

    // Type du fichier
        $file_type = $_FILES['photo']['type'];

    // Adresse du fichier temporaire
        $file_temp = $_FILES['photo']['tmp_name'];

    // Extensions autorisées
        $allowed_ext = array('bmp', 'gif', 'jpg', 'png', 'jpeg');

    // Gestion des erreurs
        $errors = array();

        if(!in_array($file_ext, $allowed_ext)){
            $errors[] = '<p> Extension'.$file_ext.'non autorisées:'. implode(',', $allowed_ext);
        }
        if ($file_size > (int)$_POST['MAX_FILE_SIZE']) {
            $errors[] = '<p> fichier trop lourd:'.$_POST['MAX_FILE_SIZE'].'octets maximum';
        }

        // Traitement du fichier
        if(empty($errors)){
        // Conversion de l'image en base_64 et insertion dans le tableau du paramètres
            $bin = file_get_contents($file_temp);
            $base64 = 'data:'.$file_type.';base64,'.base64_encode($bin);
            unset($params[':MAX_FILE_SIZE']);
            $params[':photo'] = $base64;
            //echo($base64);

        // Téléverse le fichier dans le dossier UPLOADS
            if(!move_uploaded_file($file_temp, 'uploads/'.$file_name)){
                echo '<p>erreur dans le téléversement du fichier : '.$file_name;
                echo '<a href="animaux.php">retour page d\'accueil</a>';
            }
        }else{

        // Affiche les erreurs
            foreach ($errors as $error) {
                echo $error;
                echo '<a href="animaux.php">retour page d\'accueil</a>';
                exit();
            }
        }
    }else{
        unset($params[':MAX_FILE_SIZE']);
        $params[':photo'] = null;
    }

// Préparation et exécution requête
    try {
   var_dump($_POST);
    var_dump($params);
    if(isset($_GET['pet_id']) && empty($_GET['pet_id'])){
     $sql = 'INSERT INTO pet(fname, gen_id, cli_id, race, gender, reg_id, description, photo ) VALUES(:fname, :gen_id, :cli_id, :race, :gender, :reg_id, :description, :photo)';
    }else{
        $sql = 'UPDATE pet SET fname=:fname, gender=:gender, description=:description, gen_id=:gen_id, reg_id=:reg_id, cli_id=:cli_id, race=:race, photo=:photo WHERE pet_id ='.$_GET['pet_id'];
    }
    $data = $conn->prepare($sql);
    $data->execute($params);
    
} catch (PDOException $err) {
    echo $err->getMessage();
}
header('location:animaux.php');

?>