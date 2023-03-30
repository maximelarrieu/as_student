<?php
  include_once 'config.php';
  /***CV PAGE REQUESTS TO BDD***/

  /**Description section**/
  $desc = $connexion->prepare('SELECT description FROM cvintro');

  /**School section**/
  $school = $connexion->prepare('SELECT * FROM academicareer ORDER BY YEARS DESC');

  /**Job section**/
  $job = $connexion->prepare('SELECT * FROM xpro ORDER BY YEARS DESC');

  /**Competences section**/
  $comp = $connexion->prepare('SELECT * FROM competences ORDER BY VALUE DESC');
?>
