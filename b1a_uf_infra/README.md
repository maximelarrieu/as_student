# b1a_uf_infra
Projet Infra&amp;SI fin d'année en groupe

## Notre topologie réseau
### I. Préparation
Pour nos VMs nous avons `clone` une machine CentOS que nous avions déjà utilisée. Nous pouvons désormais les ajouter dans GNS3 puis les utiliser avec nos routeurs Cisco.

### II. Mise en place
#### Checklist IP Routeurs
Tout d'abord, il est nécessaire de configurer les IP statiques des routers, pour se faire nous allons suivre le procédure suivante pour l'ensemble des routeurs : 
```
Router1# conf t
Router1(config)# interface eth0/0
Router1(config-if)# ip address 192.168.0.1 255.255.255.0
Router1(config-if)# no shut
Router1(config-if)# exit
Router1(config)# interface eth0/1
Router1(config-if)# ip address 192.168.1.1 255.255.255.0
Router1(config-if)# no shut
Router1(config-if)# exit
Router1(config)# exit
```
#### Checklist IP Machine serveur
Afin de définir une IP statique sur notre **machine serveur**, il nous suffit de suivre la procédure que nous avions apprise. Nous allons modifier le fichier de l'interface réseau :
```
$ sudo nano /etc/sysconfig/network-scripts/ifcfg-enp0s3
BOOTPROTO="static"
NAME="enp0s3"
DEVICE="enp0s3"
ONBOOT="yes"
IPADDR=192.168.4.10
NETMASK=255.255.255.0
```
Et on relance l'interface :
```
$ sudo ifdown enp0s3
$ sudo ifup enp0s3
```
#### OSPF
Nous configurons ici notre protocole OSPF pour nos routeurs, nous utiliserons ici l'exemple du `Router2` :
```
Router2# conf t
Router2(config)# router ospf 2
Router2(config-router)# router-id 2.2.2.2
```
Il faut désormais configurer les routes à partager :
```
Router2(config-router)# network 192.168.0.0 area 0
Router2(config-router)# network 192.168.2.0 area 0
Router2(config-router)# network 192.168.4.0 area 2
Router2(config-router)# exit
Router2(config)# exit
```
#### Serveur DHCP
Nous n'avions pas défini d'IP statique à notre machine client car nous allons plutôt lui intégrer un protocole DHCP afin de se voir alloué dynamiquement des adresses IP sur des machines clientes.
Pour se faire, nous devons modifier le fichier de configuration dhcp : 
```
$ sudo nano /etc/dhcp/dhcpd.conf
# dhcpd.conf

# option definitions common to all supported networks
option domain-name "domain";

default-lease-time 600;
max-lease-time 7200;

# If this DHCP server is the official DHCP server for the local
# network, the authoritative directive should be uncommented.
authoritative;

# Use this to send dhcp log messages to a different log file (you also
# have to hack syslog.conf to complete the redirection).
log-facility local7;

subnet 192.168.3.0 netmask 255.255.255.0 {
  range 192.168.3.40 192.168.3.80;
  option domain-name "domain";
  option routers 192.168.3.254;
  option broadcast-address 192.168.3.255;
}
```
On peut désormais démarrer le serveur DHCP : `$ sudo systemctl start dhcpd`
