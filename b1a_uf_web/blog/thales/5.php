<!DOCTYPE html>
<html lang=fr>
  <head>
    <meta charset="utf-8">
    <title>Sur le terrain - Maxime Larrieu</title>
    <link rel="stylesheet" href="../../my_styles/mainwrapper.css">
    <link rel="stylesheet" href="../../my_styles/header.css">
    <link rel="stylesheet" href="../articles_style.css">
    <link rel="stylesheet" href="../../my_styles/footer.css">
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
          <li><a href="../../index.php">ACCUEIL</a></li>
          <li><a href="../../my_pages/cv.php">CV</a></li>
          <li><a href="../../my_pages/projects.php">PROJETS</a></li>
          <li><a href="../index.php">BLOG</a></li>
          <li><a href="../../my_pages/contact.php">CONTACT</a></li>
        </ul>
      </nav>
    </header>
    <?php
    include_once '../../secure/requests_thales.php';
    /*SQL request to bdd*/
    $article5->execute();
    $mesarticles = $article5->fetchAll();
    foreach($mesarticles as $thearticle)
    echo
    "
    <div id='article'>
      <div id='corps'>
        <h4 id='name'>".$thearticle['AUTHOR']."</h4>
        <h4> - </h4>
        <h5>".$thearticle['WDATE']."</h5>
        <h2>".$thearticle['TITLE']."</h2>
        <p>".$thearticle['INTRO']."</p>
        <img src='".$thearticle['IMAGE']."' />
        <p>".$thearticle['DESCRIPTION']."</p>
      </div>
    </div>
    "
    ?>
    <?php include_once '../../my_pages/footer.php' ?>
    <script src="../../script.js"></script>
  </body>
</html>
