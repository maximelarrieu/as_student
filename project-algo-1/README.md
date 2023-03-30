# project-algo-1

# Programme calcul routier

### Énoncé :

Je suis un directeur d’entreprise de livraison routier à travers la France.
Écrire un programme qui affiche un tableau me permettant de connaître l'heure à laquelle une
livraison sera effectuée.
Un camion accélère de 10 km/h, par minute.
Un camion ralenti de 10 km/h, par minute.
Sa vitesse maximale est de 90 km/h.
Un conducteur doit faire une pause de 15 min toutes les 2 heures.
Écrire un programme qui :
- demande une ville de départ et une ville d’arrivée
- retourne un tableau avec :
- le nom de la ville de départ
- le nom de la ville d’arrivée
- la distance parcourue
- le temps pour parcourir cette distance HH/mm
(arrondi à la minute supérieure)

##### Villes disponibles :
+ Paris
+ Toulouse
+ Perpignan
+ Lyon
+ Bordeaux
+ Rennes
+ Nantes
+ Grenoble
+ Nancy
+ Rouen
+ Montpellier

###### Fichiers du programme

+ `data.php` contient l'ensemble des villes et distances qui les séparent
+ `script.php` exécute l'algorithme permettant de calculer le temps à parcourir pour notre chauffeur
+ `index.php` qui récupérer les deux villes et affiche les résultats