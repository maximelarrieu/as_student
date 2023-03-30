<?php
  include_once '../secure/requests_projects.php';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <title>Projets - Maxime Larrieu</title>
  <link rel="stylesheet" href="../my_styles/projects_style.css">
  <link rel="stylesheet" href="../my_styles/mainwrapper.css">
  <link rel="stylesheet" href="../my_styles/header.css">
  <link rel="stylesheet" href="../my_styles/footer.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <meta name="viewport" content="initial-scale=1.0, user-scalable=yes" />
</head>

<body>
  <?php include_once 'header.php'?>
    <div id="contener">
      <h2>MES PROJETS</h2>
      <?php
        /*SQL request to bdd*/
        $intro->execute();
        $descintro = $intro->fetch();
      ?>
      <p><?php echo $descintro['Description']?></p>
    </div>
    <div id="main">
      <h2>MES PROJETS RÉCENTS</h2>
      <hr>
      <div class="projet">
        <?php
          /*SQL request to bdd*/
          $projet->execute();
          $project = $projet->fetchAll(PDO::FETCH_ASSOC);
          foreach ($project as $projects) {
            echo
            "<img src=".$projects['IMAGE']." alt='Illustration projets réseau'/>
            <div class='description'>
            <h3><a href=". $projects['LINK']." target='_blank'>".$projects['TITLE']."</a></h3>
            <p>".$projects['DESCRIPTION']."</p>
            <p class='realised'>Projet réalisé avec ".$projects['TECHNO']."</p>
            </div>";
          }
        ?>
    </div>
    <?php include_once 'footer.php'?>
  <script src="../script.js"></script>
</body>
</html>
