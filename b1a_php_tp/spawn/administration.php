<?php
	include 'connexion_bdd.php';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8">
	<title>Administration - TP Spawn</title>
	<link rel="stylesheet" href="index.css">
	<meta name="viewport" content="initial-scale=1.0" />
</head>

<body>
	<h1>Bienvenue dans le gestionnaire de spawn</h1>
	<img id="map" src="ressources/map.jpg" alt="map" />
	<div class="modif">
		<h3>Spawns disponibles :</h3>
		<?php
			$history = $pdo->prepare('SELECT name FROM spawn ORDER BY name;');
			$history->execute();
			$availablespawns = $history->fetchAll();
			foreach ($availablespawns as $spawn) {
				echo '<ul><li>' . $spawn['name'] . '<li><ul>';
			}
		?>
	</div>
	<div class="modif">
		<h3>Ajouter un spawn :</h3>
		<form method="POST">
			<input type="text" name="spawname" placeholder="Nom du spawn.." required >
			<input type="file" name="fileinsert"  >
			<input type="submit" value="AJOUTER" name="add">
			<?php
			if (isset($_POST['add'])) {
					$modif = $pdo->prepare('INSERT INTO spawn VALUES(NULL, "'.$_POST['spawname'].'") ');
					$modif->execute();
				}
			?>
		</form>

	</div>
	<div class="modif">
		<h3>Modifier un spawn</h3>
		<form method="POST">
			<select name="spawn_modif">
			<?php
				$menu = $pdo->prepare('SELECT name FROM spawn ORDER BY name;');
				$menu->execute();
				$selectedspawn = $menu->fetchAll();
				foreach ($selectedspawn as $choice) {
					echo '<option>' . $choice['name'] . '</option>'; 
				}
			?>
			</select>
			<input type="text" name="newname" id="newname" placeholder="Modifier le nom du spawn..">
			<?php
				if (isset($_POST['newname']) && isset($_POST['spawn_modif'])) {
					$modif = $pdo->prepare('UPDATE spawn SET name ="'.$_POST['newname'].'" WHERE name="'.$_POST['spawn_modif'].'"');
					$modif->execute();
				}
			?>
		<input type="submit" value="MODIFIER" name="move" />
		</form>
	</div>
	<div class="modif">
		<h3>Supprimer un spawn</h3>
		<form method="POST">
			<?php
			
			?>
			<select name="spawn_select" id="spawn_select" />
			<?php
				$list = $pdo->prepare('SELECT name FROM spawn ORDER BY name');
				$list->execute();
				$listedspawn = $list->fetchAll();
				foreach ($listedspawn as $nospawn) {
					echo '<option>' . $nospawn['name'] . '</option>';
				}
			?>
			</select>
			<input type="submit" value="SUPPRIMER" name="del" />
			<?php
			if (isset($_POST['del'])) {
					$delete = $pdo->prepare('DELETE FROM spawn WHERE name = "'.$_POST['spawn_select'].'") ');
					$delete->execute();
				}
			?>
		</form>
	</div>
</body>