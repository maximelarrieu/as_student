# PROJET RESEAU - TP6
## Une topologie qui ressemble un peu à quelque chose, enfin ?
### Lab2 : Un peu de complexité (et d'utilité ?...)
### I. Mise en place du lab
#### Checklist IP Routeurs
* Pour définir les IP statiques des routeurs, je procède comme nous l'avions pu faire précédemment. L'exemple utilisé représente la mise en place de mon `router1`. Elle sera la même pour tous les autres, les IPs à leur attribuer ne seront évidemment pas les même :
```
R1# conf t
R1(config)# interface eth0/0
R1(config-if)# ip address 10.6.202.254 255.255.255.0
R1(config-if)# no shut
R1(config-if)# exit
R1(config)# interface eth0/1
R1(config-if)# ip address 10.6.100.1 255.255.255.252
R1(config-if)# no shut
R1(config-if)# exit
R1(config)# interface eth0/2
R1(config-if)# ip address 10.6.100.5 255.255.255.252
R1(config-if)# no shut
R1(config-if)# exit
R1(config)# exit
```
Je peux maintenant voir les IPs attribuées aux interfaces :
```
R1# show ip int br
Interface			IP-Address		Ok? Method status		Protocol
Ethernet0/0			10.6.202.254	Yes Manual up			up
Ethernet0/1			10.6.100.1		Yes Manual up			up
Ethernet0/2			10.6.100.5	  Yes Manual up			up
Ethernet0/3			unassigned		Yes Manual up			up
```
Pour éviter de tout recommencer à chaque fois, je sauvegarde mes changements :
`R1# copy runnning-config startup-config`

* Pour définir leurs noms de domaine, j'utilise :
```
R1# conf t
R1(config)# hostname r1.tp6.b1
```
#### Checklist VMs
* Pour définir leurs IPs statiques, je reprends la procédure déjà faite dans plusieurs tp. L'exemple utilisé permet de configurer ma machine `client1`.
Je dois aller modifier le fichier de l'interface et y modifier quelques lignes :
```
$ sudo nano /etc/sysconfig/network-scripts/ifcfg-enp0s3

BOOTPROTO="static"
NAME="enp0s3"
DEVICE="enp0s3"
ONBOOT="yes"
IPADDR=10.6.201.10
NETMASK=255.255.255.252
```
Et on relance l'interface :
```
$ sudo ifdown enp0s3
$ sudo ifup enp0s3
```
* Pour modifier leurs noms de domaine, on utilise la commande : `$ echo 'client1.tp6.b1 | sudo tee /etc/hostname'`
* Enfin, on vient remplir les fichiers hosts :
```
$ sudo nano /etc/hosts

10.6.201.11 client2.tp6.b1
10.6.202.10 server1.tp6.b1
```
#### Vérifier que tout ça fonctionne
Le ping fonctionne !

#### Configuration OSPF
+ Ici pour l'exemple, je configure pour `router1`. Pour activer OSPF, je procède comme ceci :
```
r1.tp6.b1# conf t
r1.tp6.b1(config)# router ospf 1
```
+ Pour configurer l'`id-router`, je procède comme suit :
`r1.tp5.b1(config-router)# router-id 1.1.1.1`
+ Maintenant, je configure les routes à partager, je suis la procédure :
```
r1.tp6.b1(config-router)# network 10.6.100.0 0.0.0.3 area 0
r1.tp6.b1(config-router)# network 10.6.100.4 0.0.0.3 area 0
r1.tp6.b1(config-router)# network 10.6.202.0 0.0.0.255 area 2
r1.tp6.b1(config-router)# exit
r1.tp6.b1(config)# exit
r1.tp6.b1# show ip protocols
Routing Protocol is "ospf 1"
...
  Routing for Networks:
  10.6.100.0 0.0.0.3 area 0
  10.6.100.4 0.0.0.3 area 0
  10.6.202.0 0.0.0.255 area 2
...
```
```
r2.tp6.b1(config-router)# network 10.6.100.0 0.0.0.3 area 0
r2.tp6.b1(config-router)# network 10.6.100.8 0.0.0.3 area 0
r2.tp6.b1(config-router)# exit
r2.tp6.b1(config)# exit
r2.tp6.b1# show ip protocols
Routing Protocol is "ospf 1"
...
  Routing for Networks:
  10.6.100.0 0.0.0.3 area 0
  10.6.100.8 0.0.0.3 area 0
...
```
```
r3.tp6.b1(config-router)# network 10.6.100.8 0.0.0.3 area 0
r3.tp6.b1(config-router)# network 10.6.100.12 0.0.0.3 area 0
r3.tp6.b1(config-router)# network 10.6.101.0 0.0.0.3 area 1
r3.tp6.b1(config-router)# exit
r3.tp6.b1(config)# exit
r3.tp6.b1# show ip protocols
Routing Protocol is "ospf 1"
...
  Routing for Networks:
  10.6.100.8 0.0.0.3 area 0
  10.6.100.12 0.0.0.3 area 0
  10.6.101.0 0.0.0.3 area 1
...
```
```
r4.tp6.b1(config-router)# network 10.6.100.4 0.0.0.3 area 0
r4.tp6.b1(config-router)# network 10.6.100.12 0.0.0.3 area 0
r4.tp6.b1(config-router)# exit
r4.tp6.b1(config)# exit
r4.tp6.b1# show ip protocols
Routing Protocol is "ospf 1"
...
  Routing for Networks:
  10.6.100.4 0.0.0.3 area 0
  10.6.100.12 0.0.0.3 area 0
...
```
```
r5.tp6.b1(config-router)# network 10.6.101.0 0.0.0.3 area 1
r5.tp6.b1(config-router)# network 10.6.201.0 0.0.0.255 area 1
r5.tp6.b1(config-router)# exit
r5.tp6.b1(config)# exit
r5.tp6.b1# show ip protocols
Routing Protocol is "ospf 1"
...
  Routing for Networks:
  10.6.101.0 0.0.0.3 area 1
  10.6.201.1 0.0.0.255 area 1
...
```

### Lab3 : Let's end this properly
### 1. NAT : accès internet
Tout d'abord, je télécharge la VM GNS3.
Puis on ajoute l'appareil "NAT" en dessous du `r4.tp6.b1`.

Maintenant, je suis la procédure donnée pour configurer mon router4 :
```
r4.tp6.b1# conf t
r4.tp6.b1(config)# interface eth0/2
r4.tp6.b1(config-if)# ip address dhcp
r4.tp6.b1(config-if)# no shut
... Interface Ethernet0/2 assigned DHCP address 192.168.122.15, mask 255.555.555.0, hostname r4.tp6.b1

r4.tp6.b1# show ip route
Gateway of last resort is 192.168.122.1 to network 0.0.0.0
192.168.122.0.24 is directly connected, Ethernet0/2
...

r4.tp6.b1# ping 8.8.8.8
Sending 5, 100-byte ICMP Echos to 8.8.8.8, timeout is 2 seconds:
!!!
Success rate is 100 percent (5/5), round-trip min/avg/max = 20/31/64 ms

r4.tp6.b1# conf t
r4.tp6.b1(congif)# interface eth0/2
r4.tp6.b1(config-if)# ip nat outside
r4.tp6.b1(config-if)# exit

r4.tp6.b1(config)# interface eth0/0
r4.tp6.b1(config-if)# ip nat inside
r4.tp6.b1(config-if)# exit

r4.tp6.b1(config)# interface eth0/1
r4.tp6.b1(config-if)# ip nat inside
r4.tp6.b1(config-if)# exit

r4.tp6.b1# conf t
r4.tp6.b1(config)# ip nat inside source list 1 interface eth0/2 overload
r4.tp6.b1(config)# access-list 1 permit any

r4.tp6.b1(config)# router ospf 1
r4.tp6.b1(config-router)# router-id 4.4.4.4
r4.tp6.b1(config-router)# default-information originate
```

Ainsi tous les `$ ping 8.8.8.8` fonctionnent !
Pour les curls j'ai du modifier mon fichier `resolv.conf` :
`$ sudo nano /etc/resolv.conf` et y ajouter la ligne `nameserver 8.8.8.8`.

### 2. Un service d'infra
Ma machine `server1.tp6.b1` peut ping ou curl google.com.
Son firewall est bien démarré, je peux lancer alors le serveur web
`$ sudo systemctl start nginx`

Après avoir suivi la procédure et lancer le serveur web, mon serveur fonctionne et répond :
`$ curl localhost` il me récupère ici l'html.

Depuis la machine `client1.tp6.b1` le curl vers `server1.tp6.b1` fonctionne, il reçoit l'html.

### 3. Serveur DHCP
Tout d'abord je renomme ma machie `client2.tp6.b1` en `dhcp.tp6.b1` dans le fichier `/etc/hostname`.
Ensuite je modifie le fichier de configuration dhcp :

```
$ sudo nano /etc/dhcp/dhcpd.conf

# dhcpd.conf

# option definitions common to all supported networks
option domain-name "tp5.b1";

default-lease-time 600;
max-lease-time 7200;

# If this DHCP server is the official DHCP server for the local
# network, the authoritative directive should be uncommented.
authoritative;

# Use this to send dhcp log messages to a different log file (you also
# have to hack syslog.conf to complete the redirection).
log-facility local7;

subnet 10.6.201.0 netmask 255.255.255.0 {
  range 10.6.201.50 10.6.201.70;
  option domain-name "tp6.b1";
  option routers 10.6.201.254;
  option broadcast-address 10.6.201.255;
}
```
Maintenant j'installe le paquet dhcp et je le démarre:
```
$ sudo yum install -y dhcp

$ sudo systemctl start dhcpd
$ sudo systemctl enable dhcpd
```
Je test pour voir si ça fonctionne depuis ma machine `client1.tp6.b1` en utilisant dhclient:
```
$ sudo dhclient -v -r
$ sudo dhclent -v
...
DHCPACK from 10.6.201.11 (xid=0x7156c214)
bound to 10.6.201.50 --renewal in 259 seconds.

$ ip a
2: enp0s3: ...
 inet 10.6.201.50/24 brd 10.6.201.255 scope global nopref ixroute dynamic enp0s3
```

### 4. Serveur DNS
Je manipule ici dans ma machine `server1.tp6.b1`.

Je suis la mise en place en editant les fichiers nécessaires.

J'en arrive à l'ouverture des ports firewall concernés :
```
$ sudo firewall-cmd --add-port=53/tcp --permanent

$ sudo firewall-cmd --add-port=53/udp --permanent
```
Puis je démarre le service DNS et fais en sorte qu'il démarre au boot de la VM
```
$ sudo systemctl start named
$ sudo systemctl enable named
```

Enfin, je peux voir les IPs correspondantes grâce à la commande `dig`.

### 5. Serveur NTP
J'édite le fichier `/etc/chrony.conf` et je le rempli par le pool de serveurs français :
```
$ sudo nano /etc/chrony.conf
# Servers to synchronize with
# Replace XXX with needed server names
server 0.fr.pool.ntp.org
server 1.fr.pool.ntp.org
server 2.fr.pool.ntp.org
server 3.fr.pool.ntp.org
```
J'ouvre ensuite le port utilisé par NTP:
`sudo firewall-cmd --add-port=123/udp --permanent`
Puis je lance le service `chronyd`:
`sudo systemctl start chronyd`
Je vérifie maintenant l'état de synchronisation NTP
```
$ chronyc sources
210 Number of sources = 4
MS Name/IP address        Stratum Poll Reach LastRx Last sample
=============================================================================
^+ 163.172.61.210               2   10  377   485   +1907us[+1907us] +/- 39ms
^+ freya.stelas.de              2   10  377   487     -35us[  -35us] +/- 58ms
^+ loin.ploup.net               3   10  377   481   -1560us[-1560us] +/- 71ms
^+ 195.154.174.209              2   10  377   519   -1422us[-1267us] +/- 22ms

$ chronyc tracking
Reference ID      : C39AAED1 (195.154.174.209)
Stratum           : 3
Ref time (UTC)    : Sun Mar 17 12:58:21 2019
System time       : 0.000020897 seconds slow of NTP time
Last offset       : +0.000154112 seconds
RMS offset        : 0.000342526 seconds
Frequency         : 3.151 ppm slow
Residual freq     : +0.001 ppm
Skew              : 0.048 ppm
Root delay        : 0.035293881 seconds
Root dispersion   : 0.001325336 seconds
Update interval   : 1028.1 seconds
Leap status       : Normal
```

*Mais* ça fonctionne pas sur les autres machines :(
