 <?php
 include_once 'db_connect.inc.php';
    $sql = 'SELECT p.fname AS anim, g.nom AS gener, c.fname AS client, r.regionName AS reg, p.gender AS gend, p.photo AS tof, p.pet_id AS pet_id FROM pet p JOIN contacts c ON p.cli_id=c.cli_id JOIN generique g ON p.gen_id=g.gen_id JOIN region r ON p.reg_id=r.reg_id WHERE g.nom = ?';

    $data = $conn->prepare($sql);
    $data->execute(array($_GET['generique']));
   /* $data = $pdo->query($sql);*/
    $html = '';
    while ($row = $data->fetch()) {
      $html .= '<div class="card p-3 m-3" style="width: 15rem;">';
      $html .= '<img src="'.($row['tof']===null?'pics/generic.jpg':$row['tof']). '" class="card-img-top" style="width:13em;height:9.5em" />';
      $html .= '<div class="card-body">';
      $html .= '<h5 class="card-title">'.$row['anim'].'</h5>';
      $html .= '<p class="card-text"><strong>Région: </strong>'.$row['reg'].'</p>';
      $html .= '<p class="card-text"><strong>Générique: </strong>'.$row['gener'].'</p>';
      $html .= '<p class="card-text"><strong>Propriétaire: </strong>'.$row['client'].'</p>';
      $html .= '<p class="card-text"><strong>Genre: </strong>'.$row['gend']. '</p>';
      $html .= '<a  class="btn btn-success" href="annonce.php?pet_id='.$row['pet_id'].'">Afficher l\'annonce</a>';
      $html .= '</div>';
      $html .= '</div>';
    }
    echo $html;
    
  ?>