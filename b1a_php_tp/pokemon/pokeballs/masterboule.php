<?php

include 'pokeball.php';

class Masterboule extends Balls {
	public function __construct () {
		$pokeballname = 'Masterboule';
		$pokeball_level = 10;

		parent::__construct($pokeballname, $pokeball_level);
	}
}
$masterboule = new Balls();

?>