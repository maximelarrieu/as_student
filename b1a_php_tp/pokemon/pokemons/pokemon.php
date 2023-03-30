<?php

class Pokemon {
	public $name;
	public $maxlife;
	public $level_pokemon;
	public $type;
	public $strength;
	public $damage;

	public function __construct($name, $maxlife, $level_pokemon, $type, $strength, $damage) {
		$this->name = $name;
		$this->maxlife = $maxlife;
		$this->level_pokemon = $level_pokemon;
		$this->type = $type;
		$this->strength = $strength;
		$this->damage = ($strength * (round(rand(900, 1100) / 1000)));
	}
	public function attack() {
		echo "L'attaque inflige " . $this->damage . " de dégâts !\n\r";
		return true;
	}
}

?>