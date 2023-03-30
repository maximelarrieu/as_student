<?php

#Pokemons
include 'pokemons/pokemon.php';
include 'pokemons/bulbizarre.php';
include 'pokemons/carapuce.php';
include 'pokemons/salameche.php';

#Pokeballs
include 'pokeballs/balls.php';
include 'pokeballs/pokeboule.php';

#Potions
include 'potions/potion.php';
include 'potions/minipotion.php';
include 'potions/superpotion.php';


echo "Alors que vous vous déplacez..\r\n";
echo "------------------------------\r\n";
echo "Attention, " . $kahpta->name . " vous attaque!";
echo "\nVous invoquez ". $miskine->name ." votre compagnon préféré.\n\r";

$bag = array($pboulename, $pboulename, $pboulename, $mpotioname, $mpotioname, $spotioname);
echo "--------------------------------------------------------\r";
echo "|					   INVENTORY					   |\r";
echo "--------------------------------------------------------\r";
echo "| Vous avez 3 {$bag['0']}, 2 {$bag['3']} et 3 {$bag['5']} |\r";
echo "--------------------------------------------------------\r\n";

#include 'combat.php';

?>