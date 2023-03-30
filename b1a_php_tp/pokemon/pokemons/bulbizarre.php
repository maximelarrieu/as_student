<?php

class Bulbizarre extends Pokemon {
	public function __construct() {
		$name = 'Bulbizarre';
		$maxlife = 150;
		$level_pokemon = 13;
		$type = 'Eau';
		$strength = 21;
		$damage = $strength * (round(rand(900, 1100) / 1000));

		parent::__construct($name, $maxlife, $level_pokemon, $type, $strength, $damage);
	}
	public function level_up() {
		$this->level_pokemon += 1;
		$this->maxlife += 7;
		$this->strength += 3;

		$level_up_text = $this->name . ' passe au niveau ' . $this->level_pokemon . ". \nIl gagne 7 points de vie et gagne 3 points de force\n\r";

		echo $level_up_text;
		return true;
	}
}
$bulbizarre = new Bulbizarre();
$bulbizarre->level_up();
?>