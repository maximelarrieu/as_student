<?php

class Pokeboule extends Balls {
	public function __construct() {
		$pokeballname = 'Pokeboule';
		$pokeball_level = 10;
		
		parent::__construct($pokeballname, $pokeball_level);
	}
}
$pokeboule = new Pokeboule();
$pboulename = $pokeboule->pokeballname;
?>