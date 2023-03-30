<?php
  include_once 'config.php';
  /***STAGE THALES PAGE REQUESTS TO BDD***/
  /**Section description**/
  $intro = $connexion->prepare('SELECT DESCRIPTION FROM billetsintro WHERE ID=1;');
  $context = $connexion->prepare('SELECT CONTEXT FROM billetsintro WHERE ID=1;');
  /**Section billets**/
  $billets = $connexion->prepare('SELECT * FROM billetsthales ORDER BY ID DESC');
  /**Section articles**/
  $article1 = $connexion->prepare('SELECT * FROM articlesthales WHERE ID=1');
  $article2 = $connexion->prepare('SELECT * FROM articlesthales WHERE ID=2');
  $article3 = $connexion->prepare('SELECT * FROM articlesthales WHERE ID=3');
  $article4 = $connexion->prepare('SELECT * FROM articlesthales WHERE ID=4');
  $article5 = $connexion->prepare('SELECT * FROM articlesthales WHERE ID=5');
?>
