<?php
  include_once 'connexion.php';
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Connected Flowers</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div id="intro">
    <h1>Connected Flowers</h1>
  </div>
  <nav>
    <ul>
      <li><a class="active" href="index.php">Accueil</a></li>
      <li><a href="regplants.php">Plantes enregistrées</a></li>
      <li><a href="rasplants.php">Votre plante</a></li>
    </ul>
  </nav>
  <div class="parameters">
    <?php
  		$last = $connexion->prepare('SELECT * FROM registeredplants ORDER BY ID;');
  		$last->execute();
  		while ($plant = $last->fetch(PDO::FETCH_ASSOC)) {
  			$name = $plant['NAME'];
  			$category = $plant['CATEGORY'];
  			$desc = $plant['DESCRIPTION'];
  			$period = $plant['PERIOD'];
  			$humidity = $plant['HUMIDITY'];
  			$temperature = $plant['TEMPERATURE'];
  			$brightness = $plant['BRIGHTNESS'];
			$photos = $plant['PHOTOS'];
  		}
  	?>
    <h2>Dernier ajout</h2>
<img src="<?php echo $photos?>" alt="lastadd" >
    <h3><?= $name ?></h3>
    <h4><?= $category ?></h4>
    <h4><?= $period ?></h4>
    <div class="infos">
      <h5>Température :</h5><?php echo $temperature ?>
    </div>
    <div class="infos">
      <h5>Humidité :</h5><?php echo $humidity ?>
    </div>
    <div class="infos">
      <h5>Luminosité :</h5><?php echo $brightness ?>
    </div>
  </div>
  <div class="parameters">
    <h2>Ajouter une plante</h2>
    <?php
      if (isset($_POST['add'])) {
        $ajout = $connexion->prepare("
        INSERT INTO
        registeredplants
        VALUES(NULL,'". $_POST['plantname'] ."',
        '". $_POST['plantype'] ."',
        '". $_POST['plantdesc']."',
        '". $_POST['plantimg']. "',
        '". $_POST['planthum']."',
        '". $_POST['plantemp']."',
        '". $_POST['plantlum']."',
        '". $_POST['plantperiod'] ."')"
        );
        try {
          $ajout->execute();
        }
        catch(Exception $e){
          echo 'Message' . $e->getMessage();
        }
      }
    ?>
    <form method="POST">
      <input type="text" name="plantname" placeholder="Nom de votre plante..." required >
      <input type="text" name="plantype" placeholder="Catégorie de votre plante..." required >
      <input type="text" name="plantperiod" placeholder="Période de floraison..."  required>
      <input type="url" name="plantimg" placeholder="Lien de l'image..." required > 
      <textarea name="plantdesc" placeholder="Description.." rows="10" cols="35" required ></textarea>
      <input type="text" name="plantemp" placeholder="Température optimale souhaitée.." required >
      <input type="text" name="planthum" placeholder="Humidité optimale souhaitée.." required >
      <input type="text" name="plantlum" placeholder="Luminosité optimale souhaitée.." required >
      <input type="submit" value="AJOUTER" name="add" >
    </form>
  </div>
  <div class="parameters">
    <h2>Modifier une plante</h2>
    <form method="POST">
      <select name="plantmodif">
        <?php
          $menu = $connexion->prepare('SELECT NAME FROM registeredplants ORDER BY NAME;');
          $menu->execute();
          $selectedplant = $menu->fetchAll(PDO::FETCH_ASSOC);
          var_dump($selectedplant);
          foreach ($selectedplant as $choice) {
            echo '<option>'. $choice['NAME'] .'</option>';
          }
        ?>
      </select>
      <input type="text" name="newname" placeholder="Modifier nom de plante..." required >
      <input type="text" name="newtype" placeholder="Modifier catégorie de votre plante..." required >
      <input type="text" name="newperiod" placeholder="Période de floraison..." required >
      <input type="url" name="newimg" placeholder="Lien de votre image" required >
      <textarea name="newdesc" placeholder="Description.." rows="10" cols="25" required ></textarea>
      <input type="text" name="newtemp" placeholder="Température optimale souhaitée.." required >
      <input type="text" name="newhum" placeholder="Humidité optimale souhaitée.." required >
      <input type="text" name="newlum" placeholder="Luminosité optimale souhaitée.." required>
      <?php
        if (isset($_POST['plantmodif']) && isset($_POST['new'])) {
          $modif = $connexion->prepare("
          UPDATE registeredplants
          SET
	  NAME = '". $_POST['newname'] ."',
          CATEGORY = '". $_POST['newtype'] ."',
          DESCRIPTION = '". $_POST['newdesc']."',
          PHOTOS = '". $_POST['newimg']."',
          HUMIDITY = '". $_POST['newhum']."',
          TEMPERATURE = '". $_POST['newtemp']."',
          BRIGHTNESS = '". $_POST['newlum']."',
          PERIOD = '". $_POST['newperiod'] ."'
	  WHERE name = '" . $_POST['plantmodif']."'
          ");
          try {
            $modif->execute();
          }
          catch(Exception $e){
            echo 'Message : Erreur de modification';
		echo $e->getMessage();
          }
        }
      ?>
      <input type="submit" value="MODIFIER" name="new">
    </form>
    <h2>Supprimer une plante</h2>
    <form method="POST">
      <select name="plantselect" id="plantselect">
        <?php
          $list = $connexion->prepare('SELECT NAME FROM registeredplants ORDER BY NAME;');
          $list->execute();
          $listedplant = $list->fetchAll(PDO::FETCH_ASSOC);
          foreach ($listedplant as $choicep) {
            echo '<option>'. $choicep['NAME'] .'</option>';
          }
        ?>
      </select>
      <input type="submit" value="SUPPRIMER" name="del">
      <?php
        if(isset($_POST['del']) && isset($_POST['plantselect'])) {
          $delete = $connexion->prepare('DELETE FROM registeredplants WHERE NAME = "'.$_POST['plantselect'].'"');
          $delete->execute();
        }
      ?>
    </form>
  </div>
</body>
</html>
