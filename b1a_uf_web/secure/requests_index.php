<?php
  include_once 'config.php';
  /***INDEX PAGE REQUESTS TO BDD***/
  /**Section description**/
  $desc = $connexion->prepare('SELECT description, subtitle FROM indexintro;');
?>
