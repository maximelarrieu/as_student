<?php

include 'pokeball.php';

class Hyperboule extends Balls {
	public function __construct () {
		$pokeballname = 'Hyperboule';
		$pokeball_level = 50;

		parent::__construct($pokeballname, $pokeball_level);
	}
}
$hyperboule = new Balls();

?>