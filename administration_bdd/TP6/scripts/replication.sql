CREATE USER IF NOT EXISTS 'replicant'@'%' identified by 'password';

grant replication SLAVE on *.* to replicant;

flush privileges;