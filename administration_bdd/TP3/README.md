# TP3

[Le script de création de table et de users](/script.sql)
### Création et utilisation de la base de données
CREATE DATABASE IF NOT EXISTS teams;
USE teams;

### Création des tables
#### Table *games* avec match_date, victory et observations
CREATE TABLE IF NOT EXISTS games (match_date DATE, victory BOOLEAN, observations TEXT);

#### Table *players* avec firstname, lastname, start_date
CREATE TABLE IF NOT EXISTS players (firstname VARCHAR(255), lastname VARCHAR(255), start_date DATE);

#### Donner tous les droits sur la table *games* au nouvel user *manager*
GRANT ALL PRIVILEGES ON games TO 'manager'@'localhost'
IDENTIFIED BY 'manager_password';

#### Donner droits d'écriture et de lecture sur la table *playersù au nouvel user *recruiter*
GRANT INSERT, SELECT ON players TO 'recruiter'@'localhost'
IDENTIFIED BY 'recruiter_password';

#### Valider les privilèges
FLUSH PRIVILEGES;

### Exécuter le script pour l'utilisateur adéquat
mysql -u manager -p manager_password
mysql -u recruiter -p recruiter_password

### Ajouter trois lignes dans la table *games*
[Le script d'insertion](/insert.sql)

INSERT INTO teams.games (match_date, victory, observations) VALUES (NOW(), true, "wow quelle victoire!");
INSERT INTO teams.games (match_date, victory, observations) VALUES (NOW(), true, "très belle partie gagnée");
INSERT INTO teams.games (match_date, victory, observations) VALUES (NOW(), false, "coup dur pour le joueur français");
INSERT INTO teams.games (match_date, victory, observations) VALUES (NOW(), false, "dominé du début à la fin quel malheur!");
INSERT INTO teams.games (match_date, victory, observations) VALUES (NOW(), true, "il est trop fort ce mec");

#### L'éxecuter avec l'utilisateur adéquat
mysql -u manager -p manager_password
