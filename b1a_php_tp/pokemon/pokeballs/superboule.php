<?php

include 'pokeball.php';

class Superboule extends Balls {
	public function __construct () {
		$pokeballname = 'Superboule';
		$pokeball_level = 30;

		parent::__construct($pokeballname, $pokeball_level);
	}
}
$superboule = new Balls();

?>