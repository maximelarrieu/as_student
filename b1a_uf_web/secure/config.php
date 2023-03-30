<?php
try {
  $server = "localhost";
  $db = "id8918687_cv_database";
  /*$login = "id8918687_my_cv";
  $password = "mydatabasecv";*/
  $login = "root";
  $password = "mdp";
  $charset = 'UTF8';
  $options = [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::
      FETCH_ASSOC,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  ];
  $connexion = new PDO(
    'mysql:host=' . $server .
    ';dbname=' . $db .
    ';charset=' . $charset,
    $login,
    $password,
    $options
  );
}
catch(PDOException $except) {
  echo 'Echec de la connexion : ' .$except->getMessage();
}

?>
