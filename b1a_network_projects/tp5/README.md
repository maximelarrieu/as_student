# PROJET RESEAU - TP5
## Premier pas dans le monde Cisco

### I. Préparation du lab

#### 1. Préparation VMs

>TP produit sous l'OS Fedora 29.

##### A. Création d'un nouveau host-only
Pour se faire, j'ouvre VirtualBox et fait défiler le menu déroulant `Fichier` et accèder à `Gestionnaire de réseau hôte`. Enfin je coche la case `Activé` pou le serveur DHCP.

##### B. Création des VMs
Pour chaque machines, j'ouvre le menu `Configuration` -> `Réseau`afin d'activer les deux premières interfaces.

Enfin, pour chaque machine, j'accède à leur fichier configuration de leur carte NAT. Chemin à suivre `$ cd /etc/sysconfig/network-script` puis `$ sudo nano ifcfg-enp0s3`. Je rajoute la ligne `IPPADR=` avec l'IP demandée selon la machine ainsi que leur `NETMASK=255.255.255.0`

##### C. Clone des VMs
Dans GNS3, on ajoute les trois VMs dans le menu `Edit > Préférences > VirtualBox VMs > Add`

##### D. Configuration réseau des machines dans GNS3
Dans le même menu que précédemment, j'accède à `Edit > Network` pour chaque machines et je rentre la valeur `2` dans `Adapters`

#### 2. Préparation Routeurs Cisco
Pour configurer les routeurs, il faut lancer la console de GNS3 en double-cliquant sur les machines routers.

Nous avons un invité de commande afin de définir une IP statique aux ports de nos routeurs.
```
# show ip int br
```

### II. Lancement et configuration du lab

##### Checklist IP VM
+ Pour définir les IPs statiques de nos machines, il suffit d'aller modifier le fichier de la carte réseau comme nous avons l'habitude de faire. Pour le retrouver : `cd /etc/sysconfig/network-scripts`. On modifie alors le fichier de l'interface en rentrant l'IP souhaitée. 
On suivra la même procédure pour chaque machine.
+ La connexion ssh est désormais effective.
+ Pour définir leur nom de domaine, on utilise : `sudo hostname server1.tp5.b1` par exemple.

##### Checklist IP Routeurs
+ Pour définir l'IP statique de nos routeurs, il faut utiliser la console se trouvant en faisant un Clique-droit sur notre routeur et sélectionner `Console`. C'est ici que nous modifierons l'interface, il faut passer en monde configuration :
```
# conf t
(config)# interface eth0/0
(config-if)# ip address 10.5.1.254 255.255.0
no shut
# conf t
(config)# interface eth0/1
(config-if)# ip address 10.5.12.1 255.255.255.252
no shut
```
On utilise `no shut` pour activer les changements.
+ Pour changer le nom de domaine, il nous faut passer en monde configuration pour utiliser la même commande que sur linux : 
`sudo hostname router1.tp5.b1`

Les exemples utilisés représentent la configuration de mon router1.
On répète les mêmes procédures le router2.

##### Checklist routes
+ router1.tp5.b1

Pour lui ajouter `net12` je procède de la manière suivante : 
```
# conf t
(config)# ip route 10.5.2.0 255.255.255.0 10.5.22.2
(config)# exit
```
+ router2.tp5.b1

Pour lui ajouter `net12` je procède de la manière suivante : 
```
# conf t
(config)# ip route 10.5.1.0 255.255.255.0 10.5.22.1
(config)# exit
```
+ server1.tp5.b1

Pour lui ajouter `net2`, je fais comme nous avions faire dans plusieurs tp précédents :
```
sudo ip add 10.5.2.0/24 via 10.5.1.254 dev enp0s3
```
+ client1.tp5.b1

Idem pour cette machine mais on ajoute `net1` :
```
sudo ip add 10.5.1.0/24 via 10.5.2.254 dev enp0s3
```
+ client2.tp5.b1

On fait la même chose pour cette dernière machine :
```
sudo ip add 10.5.1.0/24 via 10.5.2.254 dev enp0s3
```
On peut maintenant relancer les interface avec `systemctl restart network`
Et les machines peuvent se ping.
### III. DHCP

#### 1. Mise en place du serveur DHCP

##### 1. Renommer la machine
`sudo hostname dhcp-net2.tp5.b1`

##### 2. Installer le serveur DHCP
On stop la machine dans GNS3.

Dans Virtualbox -> `Configuration`, dans `Réseaux` on active la troisième interface en NAT.

Puis on lance la machine.
```
$ ip a
enp0s9 : 10.0.4.15/24
```
Et on installe notre serveur DHCP : 
```
$ sudo yum install -y dhcp
...
Installé :
	dhcp.x86_64 12:4.2.5-68.el7.centos.1
Terminé !
```
On éteint la machine.

##### 3. Rallumez la VM dans GNS3
Clic droit -> Start

##### 4. Configuration du serveur DHCP
Pour configurer le serveur DHCP, il nous faut modifier le fichier `dhcpd.conf` et le remplir par le modèle donné.

##### 5. Démarrer le serveur DHCP
On lance la commande `sudo systemctl start dhcpd`

##### 6. Faire un test
Dans la VM Client1, je modifie son interface en DHCP, en dynamique.

Comme d'habitude `$ sudo nano /etc/sysconfig/network-scripts/ifcfg-enp0s3`

On modifie la ligne `BOOTPROTO=` pour y ajouter `dhcp`.

Pour que les modifications soient prises en compte, on redémarre l'interface :

```
$ sudo ifdown enp0s3
$ sudo ifup enp0s3  
```
Enfin, je peux utiliser `dhclient`.

Tout d'abord je lâche le bail DHCP : `sudo dhclient -v -r`

Puis je redemande une IP : `sudo dhclient -v`.

#### 2. Explorer un peu DHCP
