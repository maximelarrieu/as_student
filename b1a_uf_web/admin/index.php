<?php
  include_once '../secure/config.php';
  include_once '../secure/requests_index.php';

  /***ADD NEW ADMIN***/
  if (!empty($_POST['newid']) && !empty($_POST['newpass']) && isset($_POST['newadmin'])){
    $addmin = $connexion->prepare("
    INSERT INTO
    login
    VALUES(
      NULL,
      '".addslashes($_POST['newid'])."',
      '".password_hash($_POST['newpass'], PASSWORD_BCRYPT)."')
    ");
    $addmin->execute(array(NULL, $_POST['newid'], $_POST['newpass']));
    header("Location: index.php");
  }
  /***ADD NEW JOB***/
  if (!empty($_POST['title']) && !empty($_POST['company']) && !empty($_POST['city']) && !empty($_POST['years']) && !empty($_POST['context']) && isset($_POST['nework'])){
    $newjob = $connexion->prepare("
    INSERT INTO
    xpro
    VALUES(
      NULL,
      '".addslashes($_POST['title'])."',
      '".addslashes($_POST['company'])."',
      '".addslashes($_POST['city'])."',
      '".addslashes($_POST['years'])."',
      '".addslashes($_POST['context'])."')"
      );
    $newjob->execute();
    header("Location: index.php");
  }
  /***ADD NEW SCHOOL***/
  if (!empty($_POST['title']) && !empty($_POST['school']) && !empty($_POST['city']) && !empty($_POST['years']) && isset($_POST['newschool'])){
    $newschool = $connexion->prepare("
    INSERT INTO
    academicareer
    VALUES(
      NULL,
      '".addslashes($_POST['title'])."',
      '".addslashes($_POST['school'])."',
      '".addslashes($_POST['city'])."',
      '".addslashes($_POST['years'])."')"
      );
    $newschool->execute(array(NULL, $_POST['title'], $_POST['school'], $_POST['city'], $_POST['years']));
    header("Location: index.php");
  }
  /***ADD NEW COMPETENCE***/
  if (!empty($_POST['title']) && !empty($_POST['valeur']) && isset($_POST['newcomp'])){
    $newcomp = $connexion->prepare("
    INSERT INTO
    competences
    VALUES(
      NULL,
      '".addslashes($_POST['title'])."',
      '".addslashes($_POST['valeur'])."')"
      );
    $newcomp->execute(array(NULL, $_POST['title'], $_POST['valeur']));
    header("Location: index.php");
  }
  /***ADD NEW PROJECT***/
  if (!empty($_POST['title']) && !empty($_POST['desc']) && !empty($_POST['techno']) && !empty($_POST['link']) && !empty($_POST['image']) && isset($_POST['newproject'])){
    $newproject = $connexion->prepare("
    INSERT INTO
    projects
    VALUES(
      NULL,
      '".addslashes($_POST['title'])."',
      '".addslashes($_POST['desc'])."',
      '".addslashes($_POST['techno'])."',
      '".addslashes($_POST['link'])."',
      '".addslashes($_POST['image'])."')
      ");
    $newproject->execute(array(NULL, $_POST['title'], $_POST['desc'], $_POST['techno'], $_POST['link'], $_POST['image']));
    header("Location: index.php");
  }
  /***ADD NEW BILLET***/
  if (!empty($_POST['title']) && !empty($_POST['author']) && !empty($_POST['desc']) && !empty($_POST['image']) && isset($_POST['link'], $_POST['newbillet'])) {
    $newart = $connexion->prepare("
    INSERT INTO
    billetsthales
    VALUES(
      NULL,
      '".addslashes($_POST['author'])."',
      NOW(),
      '".addslashes($_POST['title'])."',
      '".addslashes($_POST['desc'])."',
      '".addslashes($_POST['image'])."',
      '".addslashes($_POST['link'])."')
      ");
    $newart->execute(array(NULL, $_POST['title'], $_POST['author'], $_POST['desc'], $_POST['image'], $_POST['link']));
    header("Location: index.php");
  }
  /***ADD NEW ARTICLE***/
  if (!empty($_POST['title']) && !empty($_POST['time']) && !empty($_POST['place']) && !empty($_POST['dates']) && !empty($_POST['desc']) && isset($_POST['link'], $_POST['img'], $_POST['newarticle'])) {
    $newart = $connexion->prepare("
    INSERT INTO
    articlesthales
    VALUES(
      NULL,
      '".addslashes($_POST['author'])."',
      NOW(),
      '".addslashes($_POST['title'])."',
      '".addslashes($_POST['articleintro'])."',
      '".addslashes($_POST['article'])."',
      '".addslashes($_POST['link'])."',
      '".addslashes($_POST['img'])."')
      ");
    $newart->execute(array(NULL, $_POST['title'], $_POST['time'], $_POST['place'], $_POST['dates'], $_POST['desc'], $_POST['link'], $_POST['img']));
    header("Location: index.php");
  }
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="icon" href="images/favicon.ico" type="image/ico" />
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../my_styles/header.css">
    <link rel="stylesheet" href="../my_styles/footer.css">
    <link rel="stylesheet" href="../my_styles/mainwrapper.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=yes" />
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script>

    <title>Dashboard - Maxime Larrieu</title>
    <script src = "https://cdn.tiny.cloud/1/klv0ftki68ptw5d2rn47mqvr6jlt21ell6qpctraaydvo38b/tinymce/5/tinymce.min.js"></script>
    <script>
    tinymce.init({
      selector: '#indexintro'
    });
    </script>
    <script>
    tinymce.init({
      selector: '#cvintro'
    });
    </script>
    <script>
    tinymce.init({
      selector: '#projectsintro'
    });
    </script>
    <script>
    tinymce.init({
      selector: '#blogintro'
    });
    </script>
    <script>
    tinymce.init({
      selector: '#pres'
    });
    </script>
    <script>
    tinymce.init({
      selector: '#context'
    });
    </script>
    <script>
    tinymce.init({
      selector: '#articleintro'
    });
    </script>
    <script>
    tinymce.init({
      selector: '#article'
    });
    </script>
    <script>
    tinymce.init({
      selector: '#billet'
    });
    </script>
  </head>
  <header>
    <div id="master">
      <h1>Maxime Larrieu</h1>
      <h4><?php echo date('d/m/Y'); ?></h4>
    </div>
    <nav>
      <ul>
        <li><a href="../index.php">ACCUEIL</a></li>
        <li><a href="../cv.php">CV</a></li>
        <li><a href="../projects.php">PROJETS</a></li>
        <li><a href="../blog/index.php">BLOG</a></li>
        <li><a href="../contact.php">CONTACT</a></li>
      </ul>
    </nav>
  </header>
  <body>
    <div id='all'>
      <h1>ADMINISTRATION</h1>
      <div class="packmodif" id="index">
        <h3>Modification de la page index</h3>
        <form method="post">
          <?php
            $showindex = $connexion->prepare("SELECT DESCRIPTION FROM indexintro");
            $showindex->execute();
            $indexshown = $showindex->fetch();
          ?>
          <textarea id="indexintro" name="indexintro"><?php echo $indexshown['DESCRIPTION']?></textarea>
          <input type="submit" value="MODIFIER" name="indexmodif" />
        </form>
        <?php
        if (isset($_POST['indexmodif']) && isset($_POST['indexintro'])){
          $indexintro = addslashes($_POST['indexintro']);
          $modifindex = $connexion->prepare("UPDATE indexintro SET DESCRIPTION = '".$indexintro."'");
          $modifindex->execute();
        }
        ?>
        <div class="new">
          <form method="POST">
            <h4>Modifier le sous-titre</h4>
            <input type=text placeholder="Sous-titre" name="subtitle" id='subtitle'/>
            <input type="submit" value="MODIFIER" name="submodif" id='submodif'/>
          </form>
          <?php
          if (isset($_POST['submodif']) && isset($_POST['subtitle'])){
            $newsubt = addslashes($_POST['subtitle']);
            $newsubt = $connexion->prepare("UPDATE indexsub SET `sous-titre` = '".$newsubt."'");
            $newsubt->execute();
          }
          ?>
        </div>
      </div>
      <div class="packmodif">
        <h3>Modification de la page cv</h3>
        <form method="post">
          <?php
            $showcv = $connexion->prepare("SELECT DESCRIPTION FROM cvintro");
            $showcv->execute();
            $cvshown = $showcv->fetch();
          ?>
          <textarea id="cvintro" name="cvintro"><?php echo $cvshown['DESCRIPTION']?></textarea>
          <input type="submit" value="MODIFIER" name="cvmodif" />
        </form>
        <?php
        if (isset($_POST['cvmodif']) && isset($_POST['cvintro'])){
          $cvintro = addslashes($_POST['cvintro']);
          $modifcv = $connexion->prepare("UPDATE cvintro SET DESCRIPTION = '".$cvintro."'");
          $modifcv->execute();
        }
        ?>
        <div class="new">
          <form method="post">
            <h4>Expériences professionnelles :</h4>
            <select name="work">
              <?php
                $listwork = $connexion->prepare('SELECT TITLE FROM xpro ORDER BY TITLE');
                $listwork->execute();
                $selectedwork = $listwork->fetchAll(PDO::FETCH_ASSOC);
                foreach ($selectedwork as $wchoice) {
                  echo '<option>'. $wchoice['TITLE'].'</option>';
                }
              ?>
            </select>
            <input type="text" placeholder="Titre métier" name="title" />
            <input type="text" placeholder="Titre entreprise" name="company" />
            <input type="text" placeholder="Ville" name="city" />
            <input type="number" placeholder="Année" name="years" />
            <input type="text" placeholder="Contexte" name="context" />
            <input type="submit" value="AJOUTER" name="nework" />
            <input type="submit" value="MODIFIER" name="workmodif" />
            <input type="submit" value="SUPPRIMER" name="worksuppr" />
          </form>
          <?php
          if (isset($_POST['workmodif']) && isset($_POST['work'])){
            $modifxpro = $connexion->prepare("
            UPDATE xpro
            SET
            TITLE = '".addslashes($_POST['title'])."',
            COMPANY = '".addslashes($_POST['company'])."',
            CITY = '".addslashes($_POST['city'])."',
            YEARS = '".addslashes($_POST['years'])."',
            CONTEXT = '".addslashes($_POST['context'])."'
            WHERE TITLE = '".$_POST['work']."'
            ");
            $modifxpro->execute();
          }
          if (isset($_POST['worksuppr']) && isset($_POST['work'])) {
            $supprwork = $connexion ->prepare('DELETE FROM xpro WHERE TITLE = "'.$_POST['work'].'"');
            $supprwork->execute();
          }
          ?>
        </div>
        <div class="new">
          <form method="post">
            <h4>Compétences :</h4>
            <select name="comp">
              <?php
                $list = $connexion->prepare('SELECT COMPETENCE FROM competences ORDER BY COMPETENCE');
                $list->execute();
                $selectedcomp = $list->fetchAll(PDO::FETCH_ASSOC);
                foreach ($selectedcomp as $choice) {
                  echo '<option>'. $choice['COMPETENCE'].'</option>';
                }
              ?>
            </select>
            <input type="text" placeholder="Competence" name="title" />
            <input type="text" placeholder="Valeur" name="valeur" />
            <?php
            if (isset($_POST['comp']) && isset($_POST['compmodif'])){
              $newcomp = $connexion->prepare("
              UPDATE competences
              SET
              COMPETENCE = '".addslashes($_POST['title'])."',
              VALUE = '".addslashes($_POST['valeur'])."'
              WHERE COMPETENCE = '".$_POST['comp']."'
              ");
              $newcomp->execute();
            }
            if (isset($_POST['supprcomp']) && isset($_POST['comp'])) {
              $supprschool = $connexion ->prepare('DELETE FROM competences WHERE COMPETENCE = "'.$_POST['comp'].'"');
              $supprschool->execute();
            }
            ?>
            <input type="submit" value="AJOUTER" name="newcomp">
            <input type="submit" value="MODIFIER" name="compmodif">
            <input type="submit" value="SUPPRIMER" name="supprcomp">
          </form>
        </div>
      </div>
      <div class="packmodif" id="project">
        <h3>Modification de la page projet</h3>
        <form method="post">
          <?php
            $showproject = $connexion->prepare("SELECT DESCRIPTION FROM projectsintro");
            $showproject->execute();
            $projectshown = $showproject->fetch();
          ?>
          <textarea id="projectsintro" name="projectsintro"><?php echo $projectshown['DESCRIPTION']?></textarea>
          <input type="submit" value="MODIFIER" name="intromodif" />
        </form>
        <?php
        if (isset($_POST['intromodif']) && isset($_POST['projectsintro'])){
          $projectsintro = addslashes($_POST['projectsintro']);
          $modifprojects = $connexion->prepare("UPDATE projectsintro SET Description = '".$projectsintro."'");
          $modifprojects->execute();
        }
        ?>
        <div class="new">
          <form method="post">
            <h4>Projets : </h4>
            <select name="proj">
              <?php
                $listproject = $connexion->prepare('SELECT TITLE FROM projects ORDER BY TITLE');
                $listproject->execute();
                $selectedproject = $listproject->fetchAll(PDO::FETCH_ASSOC);
                foreach ($selectedproject as $pchoice) {
                  echo '<option>'. $pchoice['TITLE'].'</option>';
                }
              ?>
            </select>
            <input type="text" placeholder="Titre" name="title" />
            <input type="text" placeholder="Description" name="desc" />
            <input type="text" placeholder="Techno(s) utilisée(s)" name="techno" />
            <input type="text" placeholder="Lien" name="link" />
            <input type="text" placeholder="Image" name="image" />
            <input type="submit" value="AJOUTER" name="newproject" />
            <input type="submit" value="MODIFIER" name="modifproject" />
            <input type="submit" value="SUPPRIMER" name="supproject" />
          </form>
          <?php
          if (isset($_POST['title']) && isset($_POST['desc']) && isset($_POST['techno']) && isset($_POST['link']) && isset($_POST['image']) && isset($_POST['modifproject']) && isset($_POST['proj'])){
            $newcomp = $connexion->prepare("
            UPDATE projects
            SET
            TITLE = '".addslashes($_POST['title'])."',
            DESCRIPTION = '".addslashes($_POST['desc'])."',
            TECHNO = '".addslashes($_POST['techno'])."',
            LINK = '".addslashes($_POST['link'])."',
            IMAGE = '".addslashes($_POST['image'])."'
            WHERE TITLE = '".$_POST['proj']."'
            ");
            $newcomp->execute();
          }
          if (isset($_POST['supproject']) && isset($_POST['proj'])) {
            $supprproject = $connexion ->prepare('DELETE FROM projects WHERE TITLE = "'.$_POST['proj'].'"');
            $supprproject->execute();
          }
          ?>
        </div>
      </div>
      <div class="packmodif">
        <h3>Modification de la page blog</h3>
        <form method="post">
          <?php
            $showblog = $connexion->prepare("SELECT DESCRIPTION FROM blogintro");
            $showblog->execute();
            $indexblogi = $showblog->fetch();
          ?>
          <textarea id="blogintro" name="blogintro"><?php echo $indexblogi['DESCRIPTION']?></textarea>
          <input type="submit" value="MODIFIER" name="blogmodif" />
        </form>
      </div>
      <div class="packmodif" id="thales">
        <h3>Modification de la page Thales</h3>
        <h4>Introduction : </h4>
        <form method="post">
          <select name="intro">
            <?php
              $listintro = $connexion->prepare('SELECT * FROM billetsintro');
              $listintro->execute();
              $selectedintro = $listintro->fetchAll(PDO::FETCH_ASSOC);
              foreach ($selectedintro as $ichoice) {
                echo '<option>'. $ichoice['SUJET'].'</option>';
              }
            ?>
          </select>
          <textarea id="pres" name="pres"><?php echo $ichoice['DESCRIPTION']?></textarea>
          <textarea id="context" name="context"><?php echo $ichoice['CONTEXT']?></textarea>
          <input type="submit" value="MODIFIER" name="introarticlemodif" />
          <?php
          if (isset($_POST['introarticlemodif']) && isset($_POST['pres']) && isset($_POST['context'])){
            $pres = addslashes($_POST['pres']);
            $context = addslashes($_POST['context']);
            $modifintroarticle = $connexion->prepare("UPDATE billetsintro SET Description = '".$pres."', Context = '".$context."'");
            $modifintroarticle->execute();
          }
          ?>
        </form>
        <div class="new">
          <form method="post">
            <h4>Billets : </h4>
            <select name="bil">
              <?php
                $listbillets = $connexion->prepare('SELECT TITLE FROM billetsthales');
                $listbillets->execute();
                $selectedbillets = $listbillets->fetchAll(PDO::FETCH_ASSOC);
                foreach ($selectedbillets as $bchoice) {
                  echo '<option>'. htmlspecialchars(addslashes($bchoice["TITLE"])).'</option>';
                }
              ?>
            </select>
            <input type="text" placeholder="Titre" name="title" />
            <input type="text" placeholder="Auteur" name="author" />
            <textarea name='desc' id='desc'></textarea>
            <input type="text" placeholder="Lien" name="link" />
            <input type="text" placeholder="Image" name="image" />
            <input type="submit" value="AJOUTER" name="newbillet" />
            <input type="submit" value="MODIFIER" name="modifbillet" />
            <input type="submit" value="SUPPRIMER" name="supprbillet" />
          </form>
          <?php
          if (isset($_POST['title']) && isset($_POST['desc']) && isset($_POST['author']) && isset($_POST['link']) && isset($_POST['image']) && isset($_POST['modifbillet']) && isset($_POST['bil'])){
            $newbil = $connexion->prepare("
            UPDATE billetsthales
            SET
            TITLE = '".htmlspecialchars(addslashes($_POST['title']))."',
            DESCRIPTION = '".addslashes($_POST['desc'])."',
            AUTHOR = '".addslashes($_POST['author'])."',
            LINK = '".addslashes($_POST['link'])."',
            IMAGE = '".addslashes($_POST['image'])."'
            WHERE TITLE = '".$_POST['bil']."'
            ");
            $newbil->execute();
          }
          if (isset($_POST['supprbillet']) && isset($_POST['bil'])) {
            $supprbil = $connexion ->prepare('DELETE FROM billetsthales WHERE TITLE = "'.$_POST['bil'].'"');
            $supprbil->execute();
          }
          ?>
        </div>
      </div>
      <div class="packmodif" id="thales">
        <h3>Modification des articles</h3>
        <h4>Articles : </h4>
        <form method="post">
          <?php
            $showarticle = $connexion->prepare("SELECT DESCRIPTION FROM articlesthales");
            $showarticle->execute();
            $articleshown = $showarticle->fetch();
          ?>
          <select name="articlechoice" onchange="changing()">
            <?php
              $listart = $connexion->prepare('SELECT * FROM articlesthales ORDER BY ID DESC');
              $listart->execute();
              $selectedart = $listart->fetchAll(PDO::FETCH_ASSOC);
              foreach ($selectedart as $achoice) {
                echo '<option>'. $achoice['TITLE'].'</option>';
              }
            ?>
          </select>
          <input type="text" placeholder="Titre" name="title" />
          <input type="text" placeholder="Auteur" name="author" />
          <input type="text" placeholder="Image" name="img" />
          <textarea id="articleintro" name="articleintro"><?php echo $achoice['INTRO']?></textarea>
          <textarea id="article" name="article"><?php echo $achoice['DESCRIPTION']?></textarea>
          <input type="submit" value="AJOUTER" name="addrticle" />
          <input type="submit" value="MODIFIER" name="articlemodif" />
          <input type="submit" value="SUPPRIMER" name="articlesuppr" />
        </form>
        <?php
        if (isset($_POST['articlemodif']) && isset($_POST['articleintro']) && isset($_POST['article']) && isset($_POST['title']) && isset($_POST['author']) && isset($_POST['img']) && isset($_POST['articlechoice'])){
          $article = addslashes($_POST['article']);
          $intro = addslashes($_POST['articleintro']);
          $modifarticle = $connexion->prepare("UPDATE articlesthales SET Description = '".$article."', Intro = '".$intro."', Wdate = NOW()");
          $modifarticle->execute();
        }
        if (isset($_POST['articlesuppr']) && isset($_POST['articlechoice'])) {
          $supprbil = $connexion ->prepare('DELETE FROM articlesthales WHERE TITLE = "'.$_POST['articlechoice'].'"');
          $supprbil->execute();
        }
        ?>
      </div>
    </div>
    <?php include_once '../my_pages/footer.php'?>
    <script src="script.js"></script>
  </body>
</html>
