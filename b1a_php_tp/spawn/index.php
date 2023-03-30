<?php
	include 'connexion_bdd.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8">
	<title>TP Spawn</title>
	<link rel="stylesheet" href="index.css">
	<meta name="viewport" content="initial-scale=1.0" />
</head>

<body>
	<h1>Bienvenue sur mon générateur de spawn</h1>
	<img id="map" src="ressources/map.jpg" alt="map" />
	<div id="spawned">
	<input type="submit" id="btspawn" name="randspawn" value="SPAWN">
	<?php
		include 'spawn.php';
	?>
	</div>
	<div id="admin">
		<button><a id="btadmin" name="administration" href="login.php" target="_blank">ADMIN</a></button>
	</div>
</body>
