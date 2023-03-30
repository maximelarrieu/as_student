<?php

include 'potion.php';

class Hyperpotion extends Potions {
	public function __construct () {
		$potioname = 'Hyperpotion';
		$regen = 200;

		parent::__construct($potioname, $regen);
	}
}
$hyperpotion = new Potions();

?>