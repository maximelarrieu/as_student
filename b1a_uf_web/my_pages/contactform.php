<?php
/* D'abord on fixe la valeur par défaut des messages d'erreur et des variables des inputs */
$erreurnom = $erreuremail = $erreurmessage = $messageenvoi = $nom = $prenom = $email = $message =  '';

/* Ensuite on vérifie si le formulaire a été soumis et on valide les valeurs récupérées */
if (!empty($_POST['submit'])) {

  // On récupère les données envoyées par le formulaire
  $nom = $_POST['nom'];
  $prenom = $_POST['prenom'];
  $email = $_POST['email'];
  $message = $_POST['message'];
  $valid = true;
  $envoi = false;
  // test du nom
  if (empty($nom)) {
    $valid = false;
    $erreurnom = '<br><span class="error">Vous n\'avez pas mis votre nom</span><br>';
  }
  // Test format e-mail
  if (!preg_match("/^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/i", $email)) {
    $valid = false;
    $erreuremail = '<br><span class="error">Email non valide</span><br>';
  }
  // Test message
  if (empty($message)) {
        $valid = false;
        $erreurmessage = '<br><span class="error">Vous n\'avez pas mis votre message</span><br>';
    }

  /* Si tout est ok, on envoie le courriel */
  if ($valid) {
    $to = "contact@wishbone-design.com";
    $sujet = "Demande de contact";
    $texte = "Nom : $nom\n
    Email : $email\n
    Message : $message";
    $headers = "From: $nom\n
    Reply-To: $email";
    // Envoi du courriel - on vérifie si le mail est envoyé en mettant la fonction mail() dans un if pour voir si la valeur retournée est bien true (valeur envoyée par cette fonction si le mail a été envoyé)
    if (mail($to,$sujet,$texte,$headers)) {
      $envoi = true;
      $messageenvoi =  '<span class="ok">Votre message a bien été envoyé, merci !</span><br>';
    }
    else {
      $messageenvoi =  '<span class="error">Désolé, une erreur est survenue lors de l\'envoi du message ! Veuillez essayer ultérieurement.</span><br>';
    }
  }
}
?>
