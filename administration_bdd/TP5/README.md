# TP5

## Importer une base de données MySQL en MariaDB

### Création du docker-compose
[docker-compose.yaml](/docker-compose.yaml)

```
version: '3.7'

services:
  mysql:
    image: mysql
    environment:
      MYSQL_ROOT_PASSWORD: password
    volumes:
      - ./mysql:/var/lib/mysql
      - ./backups:/backups

  mymariadb:
    image: mariadb:10.4
    environment:
      MYSQL_ROOT_PASSWORD: password
    volumes:
      - ./maria:/var/lib/mysql
      - ./backups:/backups
```

### Lancer les conteneurs
`$ docker-compose up -d`

### Entrer dans le terminal du conteneur mySQL
`$ docker-compose exec mysql bash`

### Création des données
```
$ mysql -u root -p
# CREATE DATABASE Users;
# USE Users;
# CREATE TABLE lesplusbeaux (nom VARCHAR(255), mail VARCHAR(255), is_etudiant BOOLEAN);
# INSERT INTO lesplusbeaux VALUES ('delas', 'theo.delas@ynov.com', 1);
# INSERT INTO lesplusbeaux VALUES ('fargues', 'manon.fargues@ynov.com', 1);
# INSERT INTO lesplusbeaux VALUES ('inshape', 'tibo.inshape@muscle.com', 0);
```

### Dump de la base de données
`$ mysqldump -u root -p --databases users > backups/mydatabase.sql`

### Connexion à mariadb et importation de la base de données
```
$ docker-compose exec mymariadb bash
# mysql -u root -p < backups/mydatabase.sql
```
