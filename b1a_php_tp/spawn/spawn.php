<?php
	$query = $pdo->prepare('SELECT name FROM spawn ORDER BY RAND() LIMIT 1;');
	$query->execute();
	$spawns = $query->fetchAll();
	foreach ($spawns as $spawn) {
		echo '<h3>Spawn : ' . $spawn['name'] . "\n</h3>";
	}
	if ($spawn['name'] == "Tilted Towers") {
		echo '<img class="spawn" src="ressources/tiltedtowers.png" />';
	}
	elseif ($spawn['name'] == "Fatal Fields") {
		echo '<img class="spawn" src="ressources/fatalfields.png" />';
	}
	else {
		echo '<img class="spawn" src="ressources/tomatotown.png" />';
	}
?>