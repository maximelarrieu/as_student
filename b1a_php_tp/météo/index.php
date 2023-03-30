<h1>La date du jour : <?php echo date('d/m/Y') ?></h1>

<?php

include('bordeaux.php');
include('paris.php');
$heures = date("H");

while ($heures >= 7 AND $heures <= 19) {
	echo "<body bgcolor='white'>";
	echo "<body color='black'>";
}
if ($heures > 19 AND $heures < 6 ) {
	echo "<body bgcolor='black'>";
	echo "<body color='white'>";
}

?>

