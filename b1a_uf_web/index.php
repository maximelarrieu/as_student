<?php
  include_once 'secure/requests_index.php';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <title>Accueil - Maxime Larrieu</title>
  <link rel="stylesheet" href="my_styles/mainwrapper.css">
  <link rel="stylesheet" href="my_styles/index_style.css">
  <link rel="stylesheet" href="my_styles/header.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <meta name="viewport" content="initial-scale=1.0" />
</head>

<body>
  <header>
    <h1>Maxime Larrieu</h1>
    <h4><?php echo date('d/m/Y'); ?></h4>
    <nav>
      <ul>
        <li><a href="index.php">ACCUEIL</a></li>
        <li><a href="my_pages/cv.php">CV</a></li>
        <li><a href="my_pages/projects.php">PROJETS</a></li>
        <li><a href="blog/index.php">BLOG</a></li>
        <li><a href="my_pages/contact.php">CONTACT</a></li>
      </ul>
    </nav>
  </header>
    <div id="contenerr">
      <img class="pdp" src="ressources/img.jpg" alt="Photo de profil" />
      <h2>Bienvenue sur mon site web CV</h2>
      <?php
        /*SQL request to bdd*/
        $desc->execute();
        $datadesc = $desc->fetch();
      ?>
      <?php echo $datadesc['description']; ?>
      <div class="bottomTitle">
        <p><?php echo $datadesc['subtitle']?></p>
      </div>
      <div id="bottom">
        <div class="left">
          <img class="lenovo" src="ressources/lenovo.png" alt="lenovo">
          <h3>Lenovo ThinkPad470s</h3>
        </div>
        <div class="mid">
          <img class="fedora" src="ressources/fedora.png" alt="fedora">
          <h3>Fedora 29</h3>
        </div>
        <div class="right">
          <img class="atom" src="ressources/atom.png" alt="atom">
          <h3>Atom</h3>
        </div>
      </div>
    </div>
    <?php include_once 'my_pages/footer.php'?>
  <script src="script.js"></script>
</body>

</html>
