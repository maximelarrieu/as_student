# TD-scripting

>Ce TD a pour but de manipuler le shell et notamment de savoir créer des scripts shell soi-même.

Afin de tester mes scripts, je dois tout d'abord pouvoir les exécuter.

Pour se faire j'utilise la commande `chmod +x mon_script.sh`.

### Le jeu du plus ou moins
>[random.sh](/random.sh)

Le principe du script est simple : 

Faire deviner un nombre entre 0 et 1000 à l'utilisateur en un minimum de tentatives.
Une fois mon script exécutable, j'entre `./random.sh`.

Le script vous souhaitera la bienvenue et vous fera commencer votre partie. A vous de jouez, entrez un nombre.
L'interface vous guidera pour trouver le nombre choisi au hasard `C'est plus grand !` ou bien `C'est plus petit !`.
Lorsque vous aurez trouvé le bon nombre, le script vous félicitera et vous mentionnera le nombre de tentatives entrées... à vous d'en faire le moins possible !

### Un outil de sauvegarde
>[save.sh](/save.sh)

Sauvegarder une arborescence et programmer ses dates/heures de sauvegarde grâce à un script :

Grâce à ce script, vous pourrez faire et prévoir une sauvegarde d'aborescence de dossiers entrée en paramètre.
Une archive tar se créera, contenant vos dossiers et fichiers sauvegardés.

Pour définir une récurrence de sauvegarde, nous devons utiliser `crontab`. Remplir le fichier nécessaire :

`$ crontab -e`
`0 0 0 0 5 ~/Ynov/Annee01/linux/b1a_bash_scripts/save.sh`

Ici le script s'effectuera tous les vendredis.


Pour utiliser le script, il vous suffit de faire `./save.sh votre/aborescence/a/sauvegarder`.

### youtube-dl
>[youtube-dl.sh](/youtube-dl.sh)

Un script plutôt sympa :

En effet, il vous permettra de récupérer la musique liée à la vidéo dont vous aurez saisi ( ou plutôt copié/collé ;) ) le lien (depuis Youtube par exemple). Grâce à ce script vous pourrez également télécharger une playlist entière, en utilisant le lien d'une première musique d'une playlist prédifinie (par Youtube par exemple), l'ensemble des liens qui suivent la playlist se téléchargeront.

Pour se faire, lancez le script suivi du lien de votre musique à télécharger `./youtube-dl.sh https://youtube.com/lien-de-votre-musique-à-télécharger` et vous voilà avec le fichier .mp3 de votre musique favorite ou bien l'ensemble des musiques d'une playlist.

*A noter sous Linux, le package `ffmpeg` est nécessaire pour une conversion en .mp3. Vous pouvez le télécharger comme n'importe quel paquet selon votre distribution : `sudo apt-get/dnf/pip install ffmpeg`.*
