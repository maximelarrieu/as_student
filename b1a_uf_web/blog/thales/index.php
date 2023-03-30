<!DOCTYPE html>
<html lang=fr>
  <head>
    <meta charset="utf-8">
    <title>Stage Thales  - Maxime Larrieu</title>
    <link rel="stylesheet" href="../../my_styles/mainwrapper.css">
    <link rel="stylesheet" href="../../my_styles/header.css">
    <link rel="stylesheet" href="../billets_style.css">
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
    <div id="entreprise">
      <h2>Thales Bordeaux (33)</h2>
      <h3>Revenue Collection Systems France SAS - Etablissement Floirac</h3>
      <div id='intro'>
        <h3>Présentation</h3>
        <hr id="ah"/>
        <?php
        include_once '../../secure/requests_thales.php';
        /*SQL request to bdd*/
        $intro->execute();
        $descintro = $intro->fetch();
        ?>
        <p><?php echo $descintro['DESCRIPTION']?></p>
        <h3>Contexte du stage</h3>
        <hr id="ah"/>
        <?php
        include_once '../../secure/requests_thales.php';
        /*SQL request to bdd*/
        $context->execute();
        $contextintro = $context->fetch();
        ?>
        <p><?php echo $contextintro['CONTEXT']?></p>
      </div>
    </div>
    <div id='section'>
      <?php
      include_once '../../secure/requests_thales.php';
      /*SQL request to bdd*/
      $billets->execute();
      $mesbillets = $billets->fetchAll();
      foreach($mesbillets as $billet) {
        echo
        "
        <a href='".$billet['LINK']."'><div class='billets'>
          <img src=".$billet['IMAGE']."></img>
          <div class='corps'>
            <h4>".$billet['WDATE']."</h4>
            <h3>".$billet['AUTHOR']."</h3>
            <h2>".$billet['TITLE']."</h2>
            <p>".$billet['DESCRIPTION']."</p>
          </div>
        </div></a>
        ";
      }
      ?>
    </div>
    <?php include_once '../../my_pages/footer.php' ?>
    <script src="../../script.js"></script>
  </body>
</html>
