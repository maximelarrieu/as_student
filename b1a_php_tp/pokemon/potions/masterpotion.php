<?php

include 'potion.php';

class Hyperpotion extends Potions {
	public function __construct () {
		$potioname = 'Hyperpotion';
		$regen = 500;

		parent::__construct($potioname, $regen);
	}
}
$hyperpotion = new Potions();

?>