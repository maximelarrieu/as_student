<?php
  include_once '../secure/requests_cv.php';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <title>CV - Maxime Larrieu</title>
  <link rel="stylesheet" href="../my_styles/cv_style.css">
  <link rel="stylesheet" href="../my_styles/mainwrapper.css">
  <link rel="stylesheet" href="../my_styles/header.css">
  <link rel="stylesheet" href="../my_styles/footer.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.8.10/themes/smoothness/jquery-ui.css" type="text/css">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <meta name="viewport" content="initial-scale=1.0, user-scalable=yes" />
</head>

<body>
  <?php include_once 'header.php'?>
    <div id="contener">
      <img src="../ressources/img.jpg" height="215px" id='pdp'/>
      <h2>Curriculum Vitae</h2>
      <button><a href="../ressources/Maxime Larrieu - CV.pdf" target="_blank">Télécharger mon CV</a></button>
      <h3>SOCIABLE, ENERGIQUE ET PONCTUEL</h3>
      <div id="intro">
        <?php
          /*SQL request to bdd*/
          $desc->execute();
          $cvdesc = $desc->fetch();
        ?>
        <p><?= $cvdesc['description']; ?></p>
      </div>
      <div id="lkRedirect">
        <a href="https://www.linkedin.com/in/maxime-larrieu-b563a5159/" target="_blank"><img src="../ressources/linkedin.png" /></img></a>
        <p>Retrouvez-moi également sur <a href="https://www.linkedin.com/in/maxime-larrieu-b563a5159/" target="_blank">Linkedin</a>
      </div>
    </div>
    <div id="main">
      <h3>PARCOURS SCOLAIRE</h3>
      <hr>
      <?php
        /*SQL request to bdd*/
        $school->execute();
        $infoschool = $school->fetchAll(PDO::FETCH_ASSOC);
        foreach ($infoschool as $schools) {
          echo
          "<div class='education'>
          <h4>".$schools['TITLE']."</h4>
          <h5>".$schools['SCHOOL']."</h5>
          <h6>".$schools['CITY']."</h6>
          <h5>".$schools['YEARS']."</h5>
          </div>";
        }
      ?>
      <h3>EXPERIENCES PROFESSIONNELLES</h3>
      <hr>
      <?php
        /*SQL request to bdd*/
        $job->execute();
        $infojob = $job->fetchAll();
        foreach ($infojob as $jobs) {
        echo
          "<div class='pro'>
          <h4>".$jobs['TITLE']."</h4>
          <h5>".$jobs['COMPANY']."</h5>
          <h6>".$jobs['CITY']."</h6>
          <h5>".$jobs['YEARS']."</h5>
          <h6 id='context'>".$jobs['CONTEXT']."</h6>
          </div>";
        }
      ?>
      <h3>COMPETENCES</h3>
      <hr>
      <?php
        /*SQL request to bdd*/
        $comp->execute();
        $allcomp = $comp->fetchAll();
        foreach ($allcomp as $comps) {
          echo
          "<div class='skillbar'>
          <div class='title skillColor'>".$comps['COMPETENCE']."</div>
          <div class='progress skill'></div>
          <div class='value_progressing'>".$comps['VALUE']."%</div>
          </div>";
        }
      ?>
      <h3>LOISIRS</h3>
      <hr>
      <div id="hobbies">
        <img src="../ressources/foot.png" ></img>
        <img src="../ressources/music.png" ></img>
        <img src="../ressources/web.png" ></img>
        <img src="../ressources/rugby.png" ></img>
      </div>
    </div>
    <?php include_once 'footer.php'?>
  <script type="text/javascript" src="../script.js"></script>
</body>
</html>
