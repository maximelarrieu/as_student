<?php
  include_once 'config.php';
  /***BLOG PAGE REQUESTS TO BDD***/
  /**Section description**/
  $intro = $connexion->prepare('SELECT DESCRIPTION FROM blogintro;');
  $article = $connexion->prepare('SELECT * FROM blogbillets ORDER BY ID DESC');
?>
