<!DOCTYPE html>
<html lang=fr>
  <head>
    <meta charset="utf-8">
    <title>Blog  - Maxime Larrieu</title>
    <link rel="stylesheet" href="../my_styles/mainwrapper.css">
    <link rel="stylesheet" href="../my_styles/header.css">
    <link rel="stylesheet" href="index_style.css">
    <link rel="stylesheet" href="../my_styles/footer.css">
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
          <li><a href="../index.php">ACCUEIL</a></li>
          <li><a href="../my_pages/cv.php">CV</a></li>
          <li><a href="../my_pages/projects.php">PROJETS</a></li>
          <li><a href="index.php">BLOG</a></li>
          <li><a href="../my_pages/contact.php">CONTACT</a></li>
        </ul>
      </nav>
    </header>
    <div id="contener">
      <h2>Blog personnel</h2>
      <div id='intro'>
        <?php
        include_once '../secure/requests_blog.php';
        /*SQL request to bdd*/
        $intro->execute();
        $descintro = $intro->fetch();
        ?>
        <p><?php echo $descintro['DESCRIPTION']?></p>
      </div>
    </div>
    <div id="stage">
      <h2>MES STAGES</h2>
      <hr>
        <?php
          /*SQL request to bdd*/
          $article->execute();
          $farticle = $article->fetchAll();
          foreach($farticle as $articles) {
            echo
            "
            <div class='article'>
              <img src=".$articles['IMAGE']."></img>
              <h3>".$articles['TITLE']."</h3>
              <h5>".$articles['DUREE']."</h5>
              <h4>".$articles['PLACE']."</h4>
              <h5>".$articles['DATESTOTALES']."</h5>
              <p class='description'>".$articles['DESCRIPTION']."</p>
              <h6><a href='".$articles['LINK']."'>Accèder aux articles...</a></h6>
            </div>
            ";}
        ?>
    </div>
    <?php include_once '../my_pages/footer.php' ?>
    <script src="../script.js"></script>
  </body>
</html>
