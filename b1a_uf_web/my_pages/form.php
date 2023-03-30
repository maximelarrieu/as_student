<?php

if (isset($_POST['mailform'])) {
  $received = "Vous avez reçu un message de ". $_POST['nom'] ." depuis votre formulaire de contact :\n
      Adresse d'envoi : " . $_POST['email'] . "\n
      " . $_POST['message'];
  $headers="MIME-Version: 1.0\r\n";
  $headers='FROM: ' . $_POST['email'];
  $headers='Content-Type:text/html; charset=utf-8;';
  $headers='Content-Transfer-Encoding: 8bit';
  mail('contact@maximelarrieu.website', 'Message de ' . htmlspecialchars($_POST['nom']) .' via formulaire contact' , htmlspecialchars($received), $headers);
}

  /***DATABASE CONTACT FORM***/
  try {
    include_once '../secure/config.php';
    echo 'Connexion à la base de données réussie.';

    $request = $connexion->prepare (
      "INSERT INTO contact(nom, email, message)
      VALUES(:nom,:email,:message)"
    );
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $request->bindParam(':nom',$nom);
    $request->bindParam(':email',$email);
    $request->bindParam(':message',$message);
    $request->execute();
  }
  catch(PDOException $except) {
    echo 'Echec de la connexion : ' .$except->getMessage();
  }
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <title>Merci ! - Maxime Larrieu</title>
  <link rel="stylesheet" href="../my_styles/mainwrapper.css">
  <link rel="stylesheet" href="../my_styles/header.css">
  <link rel="stylesheet" href="../my_styles/footer.css">
  <link rel="stylesheet" href="../my_styles/form_style.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <meta name="viewport" content="initial-scale=1.0, user-scalable=yes" />
</head>

<body>
    <?php include_once 'header.php'?>
    <div id="contener">
      <h2>VOTRE MESSAGE A BIEN ÉTÉ ENVOYÉ</h>
      <h4>Merci pour votre message <?php echo htmlspecialchars($_POST['nom']); ?> !</h4>
      <div id="socialLinks">
        <p>Ce site web a été réalisé dans le cadre de mes études supérieures.
        Merci de l'avoir visité.</p>
      </div>
    </div>
    <?php include_once 'footer.php'?>
  <script src="../script.js"></script>
</body>

</html>
