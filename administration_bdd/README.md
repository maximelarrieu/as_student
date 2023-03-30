# ADMINISTRATION BASE DE DONNÉES

*Dépôt de tous les dossiers représentants tous les TPs produis en cours.*

## [TP1](/TP1)
<details>
<summary>Détails du TP</summary>

```
1 - Créez une table clients qui doit pouvoir contenir un nom, un prénom, une date de naissance et un code postal
2 - Insérez 3 lignes dans cette table
3 - Affichez seulement les prénoms et codes postaux
```
</details>

## [TP2](/TP2)
<details>
<summary>Détails du TP</summary>

```
1 - Créez une base de données nommée events
2 - Ajoutez une table public_events contenant les colonnes event_date, event_name, event_age_requirement avec les types appropriés
3 - Dupliquez cette table dans une nouvelle table private_events
4 - Créez un utilisateur event_manager avec le mot de passe password
5 - Donnez toutes les permissions à la base de données events à cet utilisateur
6 - Créez un utilisateur event_supervisor et donnez lui les droits pour visualiser le contenu de la table public_events
7 - Connectez vous en tant que event_manager et ajoutez plusieurs entrées dans les tables public_event et private_event
8 - Connectez vous en tant que event_supervisor et listez le contenu de la table public_events
9 - En tant que event_supervisor essayez de lister le contenu de la table private_events (pour cette étape donnez moi la commande ainsi que le message d'erreur que vous recevez en retour)
10 - Reconnectez vous en tant qu'utilisateur root et supprimez l'utilisateur event_supervisor
```
</details>

## [TP3](/TP3)
<details>
<summary>Détails du TP</summary>

```
1 - Écrivez un script pour :
    1 - Créer une base de données nommée teams
    2 - Cette base contient une table games avec les colonnes match_date, victory, observations avec les types adaptées
    3 - Cette base contient une table players avec les colonnes firstname, lastname, start_date avec les types adaptées
    4 - Donner tous les droits sur la table games à un nouvel utilisateur manager avec le mot de passe manager_password
    5 - Donner les droits d'écriture et de lecture sur la table players à un nouvel utilisateur recruiter avec le mot de passe recruiter_password
    6 - Valider ces privilèges
2 - Exécutez ce script pour l'utilisateur adéquat
3 - Écrivez un script pour ajouter au moins trois lignes dans la table games et exécutez le pour l'utilisateur adéquat
```
</details>

## [TP4](/TP4)
<details>
<summary>Détails du TP</summary>

```
Première partie :

Créez une image Docker qui contient tous les outils nécessaires pour mettre en place un système de backup automatique

Deuxième partie :

Mettez en place une stratégie de backups grâce à cron qui génère un dump de la base de données tous les lundis à 17h et génère un fichier compressé en format gzip contenant la date de création

Troisième partie :

Mettez en place une stratégie de backups avec logrotate qui réalise un dump journalier compressé en format bz2 et qui garde les 5 derniers dumps
```
</details>

## [TP5](/TP5)
<details>
<summary>Détails du TP</summary>

```
Utilisez la configuration docker-compose précédente afin d'instancier un serveur MySQL et un serveur MariaDB qui partagent un dossier /backups commun

Connectez vous en premier au serveur MySQL, créez une base de données avec au moins une table qui contient quelques données

Exportez cette base de données dans le dossier /backups

Connectez vous au serveur MariaDB et importez la base que vous venez d'exporter
```
</details>

## [TP6](/TP6)
<details>
<summary>Détails du TP</summary>

```
1 - Créez une fichier Docker-compose.yml qui lance deux instances MariaDB
2 - Ajoutez les fichiers de configurations pour les serveurs Master et Slave
3 - Créez un script pour ajouter l'utilisateur avec les droits de replication sur master
4 - Assurez vous que les deux instances de base de données contiennent les mêmes données
5 - Démarrez le serveur master
6 - Ajoutez le master au slave
7 - Démarrez et vérifiez l'état du slave
8 - Créez une nouvelle base de données et une nouvelle table sur le serveur Master et vérifier que les données sont présentes sur le serveur slave
```
</details>

## [TP7](/TP7)
<details>
<summary>Détails du TP</summary>

```
1 - Instanciez 3 serveurs maria
2 - Assurez vous que les serveurs puissent communiquer entre eux en ajoutant la configuration nécessaire dans les docker-compose
3 - Ajoutez la configuration nécessaire pour chaque node
4 - Importez un dump quelconque sur un des nodes et vérifiez que celui ci est bien présent sur les autres nodes
5 - Éteignez toutes les nodes et trouvez celui depuis lequel vous pouvez bootstrapper le cluster au redémarrage
6 - Redémarrez les nodes et vérifiez le bon fonctionnement du cluster
```
</details>

## [TP8](/TP8)
<details>
<summary>Détails du TP</summary>

```
Première partie :

Créez un fichier docker-compose qui réunit :
    1 - Un serveur mariaDB
    2 - Un serveur prometheus
    3 - Un serveur mysql-exporter
    Et relier les entre eux

Deuxième partie :

1 - Créez un graphique qui affiche toutes les opérations de lectures et d'écritures
2 - Créez un graphique qui affiche la variation du taux d'opérations de lectures et d'écritures en prenant en compte la moyenne sur les 5 dernières minutes
```
</details>