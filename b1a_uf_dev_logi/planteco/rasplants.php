<?php echo $photos?><?php
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
      <li><a href="index.php">Accueil</a></li>
      <li><a href="regplants.php">Plantes enregistrées</a></li>
      <li><a class="active" href="rasplants.php">Votre plante</a></li>
    </ul>
  </nav>
  <div id="theplant">
    <h2>Votre plante connectée</h2>
    <form method="POST">
      <select name="plantselect" id="plantselect" class="selplant">
        <?php
          $list = $connexion->prepare('SELECT NAME FROM registeredplants ORDER BY NAME;');
          $list->execute();
          $listedplant = $list->fetchAll(PDO::FETCH_ASSOC);
          foreach ($listedplant as $choice) {
            echo '<option>'. $choice['NAME'] .'</option>';
          }
        ?>
      </select>
      <?php
      if (!empty($_POST['plantselect'])){
        echo $_POST['plantselect'];
      }
      else {
        echo '';
      }
      ?>
      <input type="submit" value="SELECTIONNER" name="selected">
      <?php
      try {
        if(isset($_POST['selected']) && isset($_POST['plantselect'])) {
          $reco = $connexion->prepare('SELECT * FROM registeredplants WHERE NAME= "'.$_POST['plantselect'].'"');
          $reco->execute();
          while ($recomended = $reco->fetch(PDO::FETCH_ASSOC)) {
          	$optitemp = $recomended['TEMPERATURE'];
          	$optilum = $recomended['BRIGHTNESS'];
          	$optihum = $recomended['HUMIDITY'];
          }
        }
      } catch(Exception $e) {
        echo 'Message :' . $e->getMessage();
      }
      try {
      	$capted = $connexion->prepare('SELECT * FROM rasplants ORDER BY ID DESC LIMIT 1');
        $capted->execute();
      	$captured = $capted->fetch(PDO::FETCH_ASSOC);
      	$temp = $captured['Temperature'];
      	$lum = $captured['Luminosity'];
      	$hum = $captured['Humidity'];
      } catch(Exception $e) {
      	echo 'Message:' . $e->getMessage();
      }
      ?>
    </form>
    <div class="details">
      <h3>Température :</h3><p><?php if(!empty($temp)){echo $temp;}?>°C</p>
      <h5>Recommandé : <?php if(!empty($optitemp)){echo $optitemp;} ?>°C</h5>
    </div>
    <div class="details">
      <h3>Luminosité :</h3><p><?php if(!empty($lum)){echo $lum;} ?>Lux</p>
      <h5>Recommandé : <?php if(!empty($optilum)){echo $optilum;} ?>Lux</h5>
    </div>
    <div class="details">
      <h3>Humidité :</h3><p><?php if(!empty($hum)){echo $hum;} ?>%</p>
      <h5>Recommandé : <?php if(!empty($optihum)){echo $optihum;} ?>%</h5>
    </div>
  </div>
  <div id="execute">
  <?php
try {
     if(isset($_POST['captur'])) {
                exec("sudo python3 planteco.py &", $output);
                echo $output;
        }
	else {
	}
} catch (Exception $e) {
	$e->getMessage();
}
  ?>
   <form method="POST" action="rasplants.php">
    <input type="button" value="Capturez vos données" name="captur" class="capture">
   </form>
  </div>
  <div id='tab'>
    <h3>Historique</h3>
    <table>
      <tr>
        <th>Date et heure</th>
        <th>Température</th>
        <th>Humidité</th>
        <th>Luminosité</th>
      </tr>
      <?php
      try {
        $capt = $connexion->prepare('SELECT * FROM rasplants ORDER BY Date DESC LIMIT 10;');
        $capt->execute();

        $captplant = $capt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($captplant as $info) {
          echo '<tr>';
          echo '<td>'. $info['Date'] .'</td>';
          echo '<td>'. $info['Temperature'] .'</td>';
          echo '<td>'. $info['Luminosity'] .'</td>';
          echo '<td>'. $info['Humidity'] .'</td>';
          echo '</tr>';
        }
      }
      catch(Exception $e) {
        echo 'Message:' . $e->getMessage();
      }
      ?>
    </table>
  </div>
</body>
</html>
