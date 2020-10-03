Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
proident, sunt in culpa qui officia deserunt mollit anim id est laborum.




'SELECT p.fname, g.nom, c.fname, r.regionName FROM pet p JOIN contacts c ON p.cli_id=c.cli_id JOIN generique g ON p.gen_id=g.gen_id JOIN region r ON p.reg_id=r.reg_id';


<?php
    $sql = 'SELECT p.fname AS anim, g.nom AS gener, c.fname AS client, r.regionName AS reg, p.gender AS gend, p.photo AS tof, p.pet_id AS pet_id FROM pet p JOIN contacts c ON p.cli_id=c.cli_id JOIN generique g ON p.gen_id=g.gen_id JOIN region r ON p.reg_id=r.reg_id';
    $data = $conn->prepare($sql);
    $data->execute();
   /* $data = $pdo->query($sql);*/
    $html = '';
    while ($row = $data->fetch()) {
      $html .= '<div class="card p-3 m-3" style="width: 15rem;">';
      $html .= '<img src="'.($row['photo']===null?'pics/generic.jpg':$row['photo']). '" class="card-img-top"  />';
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


       <?php
            $val = $conn->query('SELECT c.reg_id AS reg, r.regionName AS region FROM contacts c JOIN region r');
            $html='';
            foreach ($val as $row1) {
                
                $html .= '<option value="'.$row1['reg'].'">'.$row1['region'].'</option>';
                
            }
            echo $html;
      ?>
 

      <?php
            $val = $conn->query('SELECT reg_id, regionName FROM region');
            $html='';
            foreach ($val as $row1) {
                
                $html .= '<option value="'.$row1['reg_id'].'">'.$row1['regionName'].'</option>';
                
            }
            echo $html;
            ?>



            else{
      $row = array(
        'anim' => '',
        'client' => '',
        'gener' => '',
        'gend' => '',
            'reg' =>'',
        'description' => '',
            'phone' => '',
            'mail' => '',
            'race' => ''
      );
      
    }