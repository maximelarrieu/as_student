<?php

class Tabouret extends Pokemon {
	public function __construct() {
		$name = 'Tabouret';
		$maxlife = 190;
		$level_pokemon = 15;
		$type = 'Feu';
		$strength = 13;
		$damage = $strength * (round(rand(900, 1100) / 1000));

		parent::__construct($name, $maxlife, $level_pokemon, $type, $strength, $damage);
	}
	public function level_up() {
		$this->level_pokemon += 1;
		$this->maxlife += 9;
		$this->strength += 2;

		$level_up_text = $this->name . ' passe au niveau ' . $this->level_pokemon . ". \nIl gagne 9 points de vie et gagne 2 points de force\n\r";

		echo $level_up_text;
		return true;
	}
}
$tabouret = new Tabouret();

?>