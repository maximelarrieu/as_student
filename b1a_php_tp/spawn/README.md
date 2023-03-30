# TP: Créer un générateur de spawn aléatoire

Ce nouveau tp nous permet prendre en main un vrai site un peu plus complexe et structurer son code. Avec l'utilisation d'une base de données avec PHP et des requêtes mySQL. Ainsi que la gestion d'une connexion utilisateur.

### Fonctionnalités
#### Landing page
On arrive pas défaut sur une page permettant de tirer un spawn aléatoire. On ne peux pas tirer deux fois de suite un même spawn. Quand on tire un spawn, on affiche son nom, une image du spawn, et le bouton pour en tirer un nouveau.

#### Page de connexion
Une page login permet aux administrateurs de se connecter.

#### Editer la base
Une page d'administration permet aux administrateurs connectés:
+ De voir la liste des spawn possibles.
+ D'ajouter un nouveau spawn.
+ De modifier un spawn existant.
+ De supprimer un spawn existant.

C'est dans le fichier [connexion_bdd.php](/connexion_bdd.php) que le lien avec la base de donnée est fait et enregistré dans la variable `$pdo`.
Dans l'[index.php](/index.php), la page principale propose un spawn aléatoirement et vous pourrez l'actualiser (avec la fonction `Actualiser` du navigateur, je n'ai pas su le mettre sur le boutton `SPAWN` (noob). Depuis cette page, et grâce au bouton `ADMIN` on accède à un page de ['Login'](/login.php) où un identifiant ainsi qu'une mot de passe est demandé.
En ayant les bons, on termine sur la [page d'administration](/administration.php) sur laquelle on peut ajouter, modifier, supprimer un spawn existant.
