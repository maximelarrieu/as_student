# TP6

[Script de création des deux instances MariaDB](docker-compose.yaml)

Maintenant que les serveurs sont prêts on prépare leur [configuration](/config) pour chacun.
On ajoute un [script](scripts/replication.sql) qui donnera les droits droits de réplication à l'utilisateur de Master.

En se connectant au serveur master, on lance le script créée plus haut, puis on export notre base de données dans un script SQL.
```
$ docker-compose exec maria-master bash
# mysql -u root -p < scripts/replication

----Création de la base de données et quelques données----

# mysql -u root -p --databases test > backups/database_creation.sql
# exit
```

En se connectant maintenant au serveur slave, nous pouvons récupérer le script de création de base de données exporter grâce au master.
Ainsi on lui indique à quel point il doit reprendre la replication et où trouver le master.

```
CHANGE MASTER TO
MASTER_HOST='maria',
MASTER_USER='replicant',
MASTER_PASSWORD='replicant_password',
MASTER_PORT=3306,
MASTER_LOG_FILE='master1-bin.000005',
MASTER_LOG_POS=800,
MASTER_CONNECT_RETRY=10;
```

On peut maintenant lancer la replication sur le slave et vérifier son état :
```
START SLAVE;
SHOW SLAVE STATUS;

Slave_IO_Running: Yes
Slave_SQL_Running: Yes
```

La replication est bien effective sur le slave et les modifications apportées par le master seront directement envoyées au slave.
