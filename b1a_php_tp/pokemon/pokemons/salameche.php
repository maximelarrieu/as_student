<?php

class Salameche extends Pokemon {
	public function __construct() {
		$name = 'Salameche';
		$maxlife = 190;
		$level_pokemon = 15;
		$type = 'Terre';
		$strength = 28;
		$damage = $strength * (round(rand(900, 1100) / 1000));

		parent::__construct($name, $maxlife, $level_pokemon, $type, $strength, $damage);
	}
	public function level_up() {
		$this->level_pokemon += 1;
		$this->maxlife += 5;
		$this->strength += 4;

		$level_up_text = $this->name . ' passe au niveau ' . $this->level_pokemon . ". \nIl gagne 5 points de vie et gagne 4 points de force\n\r";

		echo $level_up_text;
		return true;
	}
}
$salameche = new Salameche();
$salameche->level_up();

?>