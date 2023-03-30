# TP1

### Création de la base de données
CREATE DATABASE tp1;
USE tp1;

### Création de la table *clients*
#### Contenant un prénom, une date de naissance et un code postal
CREATE TABLE clients (first_name VARCHAR(255), birthday DATE, cedex INT);

### Insérez 3 lignes de données dans la table
INSERT INTO clients (first_name, birthday, cedex) VALUES ("Chuck", NOW(), 33000);
INSERT INTO clients (first_name, birthday, cedex) VALUES ("Maxime", NOW(), 47000);
INSERT INTO clients (first_name, birthday, cedex) VALUES ("Velkoz", NOW(), 16000);

### Affichez seulement les prénoms et codes postaux
SELECT first_name, cedex FROM clients;
