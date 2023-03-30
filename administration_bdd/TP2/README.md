# TP2

[Le script de création de table et de users](/script.sql)
### Création de la base de données
CREATE DATABASE events;
USE events;

### Création de les tables
#### Contenant event_date, event_name, event_age_requirement
CREATE TABLE public_events (event_date DATE, event_name VARCHAR(255), event_age_requirement TINYINT);
CREATE TABLE private_events (event_date DATE, event_name VARCHAR(255), event_age_requirement TINYINT);

### Création de l'utilisateur *event_manager*
#### Lui donner toutes les permissions sur la base de données *events*
GRANT ALL PRIVILEGES ON events TO 'event_manager'@'localhost'
IDENTIFIED BY 'password';

### Création de l'utilisateur *event_supervisor*
#### Droit de visualiser le contenu de la table public_events
GRANT SELECT ON public_events TO 'event_supervisor'@'localhost'
IDENTIFIED BY 'password';

#### Valider les droits
FLUSH PRIVILEGES;

### Connexion à l'utilisateur event_manager
mysql -u event_manager -p
Enter password: password

#### Insérez 3 lignes de données dans les tables
INSERT INTO public_events (event_date, event_name, event_age_requirement) VALUES (NOW(), "Jett", 18);
INSERT INTO public_events (event_date, event_name, event_age_requirement) VALUES (NOW(), "Fatih", 33);
INSERT INTO public_events (event_date, event_name, event_age_requirement) VALUES (NOW(), "Nidalee", 96);

INSERT INTO private_events (event_date, event_name, event_age_requirement) VALUES (NOW(), "Raze", 65);
INSERT INTO private_events (event_date, event_name, event_age_requirement) VALUES (NOW(), "HH", 1);

### Connexion à l'utilisateur event_supervisor
mysql -u event_supervisor -p
Enter password: password

#### Lire le contenu de la table public_events
SELECT * from public_events
+------------+------------+-----------+
| event_date | event_name | event_age |
+------------+------------+-----------+
| 2020-09-28 | Jett       |        18 |
| 2020-09-28 | Fatih      |        16 |
| 2020-09-28 | Nidalee    |        34 |
+------------+------------+-----------+
3 rows in set (0.001 sec)

SELECT * FROM private_events;
ERROR 1142 (42000): SELECT command denied to user 'event_supervisor'@'localhost' for table 'private_events'

### Reconnexion en root
mysql -u root -p
Enter password: root

#### Suppression de l'utilisateur event_supervisor
DROP USER 'event_supervisor'@'localhost'
