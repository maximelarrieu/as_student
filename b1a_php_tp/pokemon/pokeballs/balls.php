<?php

class Balls {
	public $pokeballname;
	public $pokeball_level;

	public function __construct($pokeballname, $pokeball_level) {
		$this->pokeballname = $pokeballname;
		$this->pokeball_level = $pokeball_level;
	}
	#public function capture() {
	#	echo("Le taux de capture est de " . (($maxlife - $life) / ($maxlife) * (1 + ($pokeball_level - $level_pokemon) / 25 )) . " %");
	#}
	#public function use ($pokemon) {
	#	echo $this->pokeballname . ' lancé sur ' . $pokemon->name . '..';
	#	$catch = $this->try_catch($pokemon);
	#	if (!$catch) {
	#		echo "KO.\n";
	#		return false;
	#	}
	#	else {
	#		echo $pokemon->name . ' a été capturé.';
	#		return true;
	#	}
	#
	#}
}

?>