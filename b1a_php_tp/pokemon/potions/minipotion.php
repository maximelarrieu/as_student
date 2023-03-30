<?php

class Minipotion extends Potions {
	public function __construct () {
		$potioname = 'Minipotion';
		$regen = 50;

		parent::__construct($potioname, $regen);
	}
}
$minipotion = new Minipotion();
$mpotioname = $minipotion->potioname;
?>