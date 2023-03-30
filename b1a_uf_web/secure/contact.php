<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <title>Contact - Maxime Larrieu</title>
  <link rel="stylesheet" href="../my_styles/mainwrapper.css">
  <link rel="stylesheet" href="../my_styles/header.css">
  <link rel="stylesheet" href="../my_styles/footer.css">
  <link rel="stylesheet" href="../my_styles/contact_style.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <meta name="viewport" content="initial-scale=1.0, user-scalable=yes" />
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>
  <header>
    <h1>Maxime Larrieu</h1>
    <h4><?php echo date('d/m/Y'); ?></h4>
    <nav>
      <ul>
        <li><a href="../index.php">ACCUEIL</a></li>
        <li><a href="cv.php">CV</a></li>
        <li><a href="projects.php">PROJETS</a></li>
        <li><a href="contact.php">CONTACT</a></li>
      </ul>
    </nav>
  </header>
    <div id="contener">
      <h2>ME CONTACTER</h2>
      <div id="infomail">
        <h6>contact@maximelarrieu.website</h6>
      </div>
      <form method="POST" action="form.php">
        <input required type="text" name="nom" id="nom" placeholder="Votre nom..." value="<?= isset($_SESSION['inputs']['nom']) ? $_SESSION['inputs']['nom']: ''; ?>"/>
        <input required type="email" name="email" id="email" placeholder="Votre email..." value="<?= isset($_SESSION['inputs']['email']) ? $_SESSION['inputs']['email']: ''; ?>"/>
        <textarea required name="message" id="message" placeholder="Votre message..."><?= isset($_SESSION['inputs']['message']) ? $_SESSION['inputs']['message']: ''; ?></textarea>
        <div class="g-recaptcha" data-sitekey="6Lc5xasUAAAAAA50lglJ5LSCyBX0Ja7YIBI-w1bC" data-theme="dark"></div>
        <input type="submit" value="Envoyer" name="mailform" />
      </form>
    </div>
    <?php include_once 'footer.php'?>
  <script src="../script.js"></script>
</body>

</html>
