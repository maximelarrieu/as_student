# TP8

[Script qui réunit les 3 serveurs nécessaires au tp](docker-compose.yaml)

Une fois que les serveurs sont reliés entre Prometheus (accessible à `http://localhost:9090`)propose un certains nombre de commandes SQL pouvant être exécutées, nous donnant des informations sur ce qui se passe sur notre base de données.

Nous pouvons utiliser `mysql_global_status_commands_total{command="select"}` par exemple, qui comptera le nombre d'occurrence de la commande `SELECT` effectué sur notre serveur.

[Screenshot du graphique final avec des commandes de lecture et d'écriture](screenshots/graph_lecture_ecriture.png)

Pour connaître la variation du taux d'opérations de ces commandes, nous utiliserons une fonction de moyenne. Et verifirons ça sur les 5 dernières minutes.
Par exemple : `(mysql_global_status_commands_total{command="select"}[5m])`

[Screenshot du graphique final avec des commandes de lecture et d'écriture](screenshots/rate_lecture_ecriture.png)
