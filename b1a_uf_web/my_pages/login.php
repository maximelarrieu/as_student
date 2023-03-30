<!DOCTYPE html>
<html lang="fr">
  <head>
    <title>Connexion</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="icon" href="images/favicon.ico" type="image/ico" />
    <link rel="stylesheet" href="../my_styles/mainwrapper.css">
    <link rel="stylesheet" href="../my_styles/login_style.css">
  </head>
  <body>
    <div id="login">
      <form method="POST" action="../admin/admin.php" />
        <label>Identifiant :</label>
        <input type="text" placeholder="Votre identifiant..." name="user" required />
        <label>Mot de passe :</label>
        <input type="password" placeholder="Votre mot de passe..." name="pass" required />
        <input type="submit" value="SE CONNECTER" name="log" />
        <?php
        include_once '../secure/config.php';

        if(!empty($_POST['user']) && !empty($_POST['pass']) && isset($_POST['log'])) {
          $user = $_POST['user'];
          $pass = $_POST['pass'];
          $req = $connexion->prepare("SELECT PASSWORD FROM login WHERE USERNAME = '". $user ."'");
          $req->execute();
          $resultat = $req->fetch();
          $hashpass = $resultat['PASSWORD'];
          $isPasswordCorrect = password_verify($pass, $hashpass);
          if ($isPasswordCorrect == true) {
              /*session_start();
              $_SESSION['ID'] = $resultat['ID'];*/
              echo 'Vous êtes connecté !';
          }
          else {
              echo 'Mauvais identifiant ou mot de passe !';
          }
        }
        ?>
      </form>
    </div>
  </body>
</html>
