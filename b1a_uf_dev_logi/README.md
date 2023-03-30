# [B1] Projet Développement logiciels
> Projet de groupe pour validation de fin d'année

## Notre projet

L'entreprise Connected Flowers, nous souhaitions développer un objet connecté permettant
à tout individu sans connaissance en botanique de faire pousser des plantes chez lui. Nous fournissons
une base de données contenant une trentaine de plantes de la région que l'utilisateur pourra étendre comme il le souhaite.

Grâce à notre objet connecté fourni et par le biais de notre application l'utilisateur pourra contrôler
le bon état de ses plantes et pourra être alerté si les conditions de ses plantes deviennent critiques.

Il est aussi possible de planifier de planter une plante, le logiciel vous assistera.
Nous avons développé ce projet à 3 et nous nous sommes réparties nos tâches :
+ Thomas Dumont : Programmation Rasperry Pi
+ Yeshwin Bangarigadu : Interface client
+ Maxime Larrieu : Liaisons BDD

Vous retrouverez dans le [dossier technique](/Dossier_Technique) les livrables demandés tel que le MCD, la fiche technique de notre projet dans le dossier ainsi qu'un fichier de présentaiton des membres du groupe.
C'est dans le [dossier Contribution](/Contribution) que vous retrouvez le rôle de chaque membres.


## Indications relatives au déploiement

Tous les fichiers nécessaires au déploiement du projet se trouvent dans le [dossier planteco](/planteco).
Pour le bon fonctionnement de l'objet connecté, il sera nécessaire de mettre le capteur d'humidité dans la terre de la plante concernée ainsi que de mettre le capteur de température à proximité et de placer le capteur de luminosité à côté de la plante en faisant en sorte qu'il soit autant éclairé que la plante, c'est-à-dire hors de l'ombre d'un objet proche.

La carte Raspberry Pi devra alors être mise sous tension et il suffira d'appuyer sur le bouton "Capturez vos données" sur le site WEB de la plante connectée pour que les données commencent à être récupérées et à s'afficher sur la page "Votre plante".
