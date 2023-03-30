# TP4

### Création de l'image
[Le fichier Dockerfile](/Dockerfile)

#### Import de l'image
FROM mysql
#### Définition de la variable d'environnement
ENV MYSQL_ROOT_PASSWORD="password"
#### Update et installation de curl pour pouvoir installer les paquets dont on a besoin
RUN apt update -y
RUN apt install curl -y
RUN apt install logrotate -y
RUN apt install cron -y
RUN apt install nano -y
#### On active cron de façon permanente
RUN service cron enable

### On rentre dans notre service
`docker exec -it bash`

Une fois dedans, on configure le crontab pour obtenir une backup tous les lundis à 17h.

`17 0 * * 1 tar -zcf /var/backups/"$(date +%Y-%m-%d)".gz /home/backups`

Puis on configure logrotate pour un dump journalier en gardant les 5 derniers dumps au format bz2

```
/backups/"$(date +%Y-%m-%d)".gz {
        rotate 5
        daily
        postrotate
                /home/backups/"$(date +%Y-%m-%d)"
        compresscmd /bin/bzip2
        compressext .bz2
        endscript
}
```

