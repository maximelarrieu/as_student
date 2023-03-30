<?php

class Superpotion extends Potions {
	public function __construct () {
		$potioname = 'Superpotion';
		$regen = 50;

		parent::__construct($potioname, $regen);
	}
}
$superpotion = new Superpotion();
$spotioname = $superpotion->potioname;
?>