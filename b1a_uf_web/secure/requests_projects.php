<?php
  include_once 'config.php';

  /***CV PAGE REQUESTS TO BDD***/
  /**Description section**/
  $intro = $connexion->prepare('SELECT Description FROM projectsintro');

  /**Projects section**/
  $projet = $connexion->prepare('SELECT * FROM projects ORDER BY ID DESC LIMIT 3;');
?>
