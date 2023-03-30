<?php
session_start();
	include 'connexion_bdd.php';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8">
	<title>Login</title>
	<link rel="stylesheet" href="index.css">
	<meta name="viewport" content="initial-scale=1.0" />
</head>

<body>
	<h1>Veuillez vous identifiez</h1>
	
	<form id="loginform" method="POST" action="administration.php">
		<label for="username">Nom d'utilisateur</label>
		<input type="text" placeholder="Entrer votre nom d'utilisateur.." name="nameuser" required >

		<label for="pwd">Votre mot de passe:</label>
		<input type="password" placeholder="Entre votre mot de passe.." name="password" required >

		<input type="submit" name="button" value="SE CONNECTER">
		<?php
			if(isset($_POST['button'])) {
				$username=$_POST['nameuser'];
				$pwd=$_POST['password'];
				$co = $pdo->prepare('SELECT * FROM admin WHERE login ="'.$_POST['nameuser'].'" AND passwd ="'.$_POST['password'].'"');
				$co->execute();
			}
		?>
	</form>
</body>