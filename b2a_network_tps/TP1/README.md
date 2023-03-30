# TP: Back to basics
### 0. Etapes préliminaires
* La première carte est la carte NAT qu'on l'on met sur notre VM.
* On joint localement la carte réseau `192.168.56.1` dans un réseau hôte privé. C'est grâce à celle-là que je me connecte en SSH.
* On se connecte à la machine virtuelle `$ ssh admin@192.168.56.101`, on a accès à notre VM depuis notre pc.

```
[admin@localhost ~]$ cat /etc/centos-release
CentOS Linux release 8.0.1905 (Core)
```

### I. Gather informations

* Pour récupérer la liste des cartes réseau, j'utilise la commande `ip a`. 
J'obtiens alors une liste de trois résultats, avec la carte réseau et l'ip grâce à laquelle je me suis connecté en SSH : `enp0s3`, la carte `enp0s8` et la carte Ethernet `lo`.

* En se rendant dans le dossier des baux DHCP stockés `$ cd /var/lib/NetworkManager`, on peut afficher le dernier bail crée avec `[admin@localhost lib]$ cat internal-1de272d3-1d0c-422d-b60d-c017de41c887-enp0s3.lease` on obtient alors: 

```
This is private data. Do not parse.
ADDRESS=192.168.56.103
NETMASK=255.255.255.0
SERVER_ADDRESS=192.168.56.100
T1=600
T2=1050
LIFETIME=1200
CLIENTID=0108002723d842
```

* Table de route :

```
[admin@localhost ~]$ ip route
default via 10.0.3.2 dev enp0s8 proto dhcp metric 101 
10.0.3.0/24 dev enp0s8 proto kernel scope link src 10.0.3.15 metric 101 
192.168.56.0/24 dev enp0s3 proto kernel scope link src 192.168.56.103 metric 100
```


La première ligne indique la mise en place de la route par défaut grâce au DHCP.

La deuxième ligne concerne la carte enp0s8 qui est une route vers le réseau Ynov.

La troisième ligne concerne la carte enp0s3 qui est une route vers le réseau privé de notre machine (pour se connecter en SSH par exemple).


```
[root@localhost ~]# ip neigh show
10.0.3.2 dev enp0s8 lladdr 52:54:00:12:35:02 STALE
10.0.3.3 dev enp0s8 lladdr 52:54:00:12:35:03 STALE
192.168.56.1 dev enp0s3 lladdr 0a:00:27:00:00:00 REACHABLE
```

Nous pouvons voir que les différentes adresses sont reliées à leurs adresses mac ainsi que leur état respectif.

* On peut récupérer la liste des ports en écoute sur la machine en éxecutant :


```
[admin@localhost ~]$ ss -tulpn
Netid                 State                   Recv-Q                  Send-Q                                             Local Address:Port                                     Peer Address:Port                  
udp                   UNCONN                  0                       0                                                      127.0.0.1:323                                           0.0.0.0:*                     
udp                   UNCONN                  0                       0                                          192.168.56.103%enp0s3:68                                            0.0.0.0:*                     
udp                   UNCONN                  0                       0                                               10.0.3.15%enp0s8:68                                            0.0.0.0:*                     
udp                   UNCONN                  0                       0                                                          [::1]:323                                              [::]:*                     
tcp                   LISTEN                  0                       128                                                      0.0.0.0:22                                            0.0.0.0:*                     
tcp                   LISTEN                  0                       128                                                         [::]:22                                               [::]:*  
```


On peut voir le ssh qui écoute sur le `port 22` et nos réseaux sont sur le `port 68`.
* Tout d'abord, pour afficher la liste des DNS, on exécute : `cat /etc/resolv.conf`. Après avoir installer le paquet `bind-utils`, nous pouvons récupérer la l'ip associé au domaine de `www.reddit.com` :

<details>
<summary>dig www.reddit.com</summary>

```
[admin@localhost ~]$ dig www.reddit.com

; <<>> DiG 9.11.4-P2-RedHat-9.11.4-17.P2.el8_0.1 <<>> www.reddit.com
;; global options: +cmd
;; Got answer:
;; ->>HEADER<<- opcode: QUERY, status: NOERROR, id: 48329
;; flags: qr rd ra; QUERY: 1, ANSWER: 5, AUTHORITY: 13, ADDITIONAL: 27

;; OPT PSEUDOSECTION:
; EDNS: version: 0, flags:; udp: 4096
;; QUESTION SECTION:
;www.reddit.com.			IN	A

;; ANSWER SECTION:
www.reddit.com.		79	IN	CNAME	reddit.map.fastly.net.
reddit.map.fastly.net.	29	IN	A	151.101.65.140
reddit.map.fastly.net.	29	IN	A	151.101.129.140
reddit.map.fastly.net.	29	IN	A	151.101.1.140
reddit.map.fastly.net.	29	IN	A	151.101.193.140

;; AUTHORITY SECTION:
net.			153441	IN	NS	l.gtld-servers.net.
net.			153441	IN	NS	f.gtld-servers.net.
net.			153441	IN	NS	g.gtld-servers.net.
[...]
;; ADDITIONAL SECTION:
a.gtld-servers.net.	153429	IN	A	192.5.6.30
a.gtld-servers.net.	153429	IN	AAAA	2001:503:a83e::2:30
m.gtld-servers.net.	153429	IN	A	192.55.83.30
m.gtld-servers.net.	153429	IN	AAAA	2001:501:b1f9::30
j.gtld-servers.net.	153429	IN	A	192.48.79.30
j.gtld-servers.net.	153429	IN	AAAA	2001:502:7094::30
k.gtld-servers.net.	153429	IN	A	192.52.178.30
k.gtld-servers.net.	153429	IN	AAAA	2001:503:d2d::30
f.gtld-servers.net.	153429	IN	A	192.35.51.30
[...]
;; Query time: 175 msec
;; SERVER: 10.33.10.20#53(10.33.10.20)
;; WHEN: Thu Sep 26 09:48:43 EDT 2019
;; MSG SIZE  rcvd: 935
```
</details>

On sait maintenant que l'adresse ip voulue est : `10.33.10.20`

* L'état actuel du firewall se récupère avec : 
```
[admin@localhost ~]$ systemctl status firewalld
● firewalld.service - firewalld - dynamic firewall daemon
   Loaded: loaded (/usr/lib/systemd/system/firewalld.service; enabled; vendor preset>
   Active: active (running) since Thu 2019-09-26 08:58:19 EDT; 56min ago
     Docs: man:firewalld(1)
 Main PID: 758 (firewalld)
    Tasks: 3 (limit: 5060)
   Memory: 32.4M
```
* Les interfaces filtrées se trouvent avec :

```
[root@localhost lib]# firewall-cmd --list-all
public (active)
  target: default
  icmp-block-inversion: no
  interfaces: enp0s3 enp0s8
  sources: 
  services: cockpit dhcpv6-client ssh
  ports: 
  protocols: 
  masquerade: no
  forward-ports: 
  source-ports: 
  icmp-blocks: 
  rich rules: 
```

* Pour savoir quelles ports sont filtrées on utilise:
`$ sudo nft list table filter`
* Nous jouons avec la nouvelle commande `nft` (nftables) grâce à laquelle on manipule le filtrage réseau, voice un exemple :
* 
```
[root@localhost lib]# nft list table  ip filter
table ip filter {
    chain INPUT {
        type filter hook input priority 0; policy accept;
    }

    chain FORWARD {
        type filter hook forward priority 0; policy accept;
    }

    chain OUTPUT {
        type filter hook output priority 0; policy accept;
    }
}
```

ou encore :

```
[root@localhost lib]# nft list tables
table ip filter
table ip6 filter
table bridge filter
table ip security
table ip raw
table ip mangle
table ip nat
table ip6 security
table ip6 raw
table ip6 mangle
table ip6 nat
table bridge nat
table inet firewalld
table ip firewalld
table ip6 firewalld
```

### II. Edit configuration
#### 1. Configuration cartes réseau

* On modifie la configuration de notre carte réseau. On crée un nouveau fichier `ifcfg-enp0s8` dans lequel on rédige :

```
[admin@localhost ~]$ cat /etc/sysconfig/network-scripts/ifcfg-enp0s8
TYPE="Ethernet"
BOOTPROTO="static"
NAME="enp0s8"
DEVICE="enp0s8"
ONBOOT="yes"
IPADDR=192.168.56.103
NETMASK=255.255.255.0
```

Où on a passer l'adresse ip en statique.
(certaines lignes qui ne sont pas indispensables ont été retirées par nos soins)

Pour finaliser l'étape, on exécute la commande : 
- `nmcli c reload`

et

- `nmcli con up enp0s8`

On créer une nouvelle carte réseau dans VirtualBox (sans cocher la case DHCP) avec pour IP `192.168.57.1` et de la même manière que précédemment, on rédige le fichier correspondant :

```
[admin@localhost ~]$ cat /etc/sysconfig/network-scripts/ifcfg-enp0s9
TYPE="Ethernet"
BOOTPROTO="static"
NAME="enp0s9"
DEVICE="enp0s9"
ONBOOT="yes"
IPADDR=192.168.57.103
NETMASK=255.255.255.0
```

##### Résultat :

```
root@localhost ~]# ip a
1: lo: <LOOPBACK,UP,LOWER_UP> mtu 65536 qdisc noqueue state UNKNOWN group default qlen 1000
    link/loopback 00:00:00:00:00:00 brd 00:00:00:00:00:00
    inet 127.0.0.1/8 scope host lo
       valid_lft forever preferred_lft forever
    inet6 ::1/128 scope host 
       valid_lft forever preferred_lft forever
2: enp0s3: <BROADCAST,MULTICAST,UP,LOWER_UP> mtu 1500 qdisc fq_codel state UP group default qlen 1000
    link/ether 08:00:27:1b:fe:ac brd ff:ff:ff:ff:ff:ff
    inet 10.0.2.15/24 brd 10.0.2.255 scope global dynamic noprefixroute enp0s3
       valid_lft 86379sec preferred_lft 86379sec
    inet6 fe80::2bc9:839c:4f72:e37e/64 scope link noprefixroute 
       valid_lft forever preferred_lft forever
3: enp0s8: <BROADCAST,MULTICAST,UP,LOWER_UP> mtu 1500 qdisc fq_codel state UP group default qlen 1000
    link/ether 08:00:27:09:8a:91 brd ff:ff:ff:ff:ff:ff
    inet 192.168.56.103/24 brd 192.168.56.255 scope global noprefixroute enp0s8
       valid_lft forever preferred_lft forever
    inet6 fe80::79c6:3352:379a:644b/64 scope link noprefixroute 
       valid_lft forever preferred_lft forever
4: enp0s9: <BROADCAST,MULTICAST,UP,LOWER_UP> mtu 1500 qdisc fq_codel state UP group default qlen 1000
    link/ether 08:00:27:6e:60:42 brd ff:ff:ff:ff:ff:ff
    inet 192.168.57.103/24 brd 192.168.57.255 scope global noprefixroute enp0s9
       valid_lft forever preferred_lft forever
    inet6 fe80::5695:bbe:3536:bc4/64 scope link noprefixroute 
       valid_lft forever preferred_lft forever
```

#### 2. Serveur SSH

Pour modifier configuration on édite le fichier : 
- `sudo vim /etc/ssh/sshd_config` dans lequel on décommente et modifie la ligne `#Port 22` en `Port 2222` 

- Pour activer le nouveau port on utilise `sudo firewall-cmd --zone=public --add-port=2222/tcp --permanent` 

- On ferme le port précédent : `firewall-cmd --zone=public --remove-port=22/tcp`

- On reload le firewall et le tour est joué : `firewall-cmd --reload`

- On installe semanage avec la commande : `yum install policycoreutils-python-utils-2.8-16.1.el8.noarch`

- On execute `semanage port -a -t ssh_port_t -p tcp 2222` 

##### Résultat :

```
➜  b2a_network_tps git:(master) ✗ ssh root@192.168.56.103 -p 2222
root@192.168.56.103's password: 
Last login: Thu Sep 26 16:02:02 2019
[root@localhost ~]# 
```

### III. Routage simple
###### Tableau récapitulatif des IPs
|           |10.1.0.0|10.2.0.0|192.168.56.1|
|:---------:|:------:|:------:|:----------:|
|10.1.0.10  |    x   |        |            |
|10.2.0.10  |        |    x   |            |
|10.1.0.254 |    x   |        |            |
|10.2.0.254 |        |    x   |            |
|192.168.122.176  |        |       |     x      |

###### Configuration des VMs
Pour configurer nos VMs, nous devons définir leurs IPs statiques. Nous modifions alors le fichier d'interface :

```
$ sudo nano /etc/sysconfig/network-scripts/ifcfg-enp0s3

BOOTPROTO="static"
NAME="enp0s3"
DEVICE="enp0s3"
ONBOOT="yes"
IPADDR=10.1.0.10
NETMASK=255.255.255.0
GATEWAY=10.1.0.254
```
Nous procédons de la même façon pour la deuxième VM à laquelle nous avons assigné l'ip `10.2.0.10` et pour gateway `10.2.0.154`. Une fois le fichier modifié, on relance l'interface :

```
$ sudo ifdown enp0s3
$ sudo ifup enp0s3
```

###### Configuration du routeur
Une fois le routeur intégré dans notre topologie dans GNS3, nous ouvrons le terminal du routeur afin d'y accèder et de le configurer :

```
r1.tp1.b2# conf t
r1.tp1.b2(config)# interface FastEthernet0/0
r1.tp1.b2(config-if)# ip address dhcp
r1.tp1.b2(config-if)# no shut
... Interface FastEthernet0/0 assigned DHCP address 192.168.122.15, mask 255.555.555.0, hostname r1.tp1.b2
r1.tp1.b2(config-if)# exit
r1.tp1.b2(config)# interface FastEthernet0/1
r1.tp1.b2(config-if)# ip address 10.1.0.254 255.255.255.0
r1.tp1.b2(config-if)# no shut
r1.tp1.b2(config-if)# exit
r1.tp1.b2(config)# interface FastEthernet1/0
r1.tp1.b2(config-if)# ip address 10.2.0.254 255.255.255.0
r1.tp1.b2(config-if)# no shut
r1.tp1.b2(config-if)# exit
r1.tp1.b2(config)# exit
```
Ici, les cartes `FastEthernet0/1` et `1/0` correspondent aux ports par lesquels passent les VMs et la première donne accès au NAT.

```
r1.tp1.b2# conf t
r1.tp1.b2(config)# ip route 10.1.0.0 255.255.255.0 10.1.0.10
r1.tp1.b2(config)# exit
r1.tp1.b2(config)# ip route 10.2.0.0 255.255.255.0 10.2.0.10
r1.tp1.b2(config)# exit
r1.tp1.b2(config)# ip route 192.168.122.176 255.255.255.0 192.168.56.1
r1.tp1.b2(config)# exit
```

On a ajouté au routeur les routes vers les VMs et vers le NAT.
Le router peut dès lors ping vers internet :
```
r1.tp1.b2# ping 8.8.8.8
Sending 5, 100-byte ICMP Echos to 8.8.8.8, timeout is 2 seconds:
!!!
Success rate is 100 percent (5/5), round-trip min/avg/max = 20/31/64 ms
```

Désormais, les VMs peuvent se ping :

```
$ ping 10.2.0.10
PING 10.2.0.10 (10.2.0.10) 56(84) bytes of data.
64 bytes from 10.2.0.10: icmp_seq=1 ttl=64 time=0.046 ms
64 bytes from 10.2.0.10: icmp_seq=1 ttl=64 time=0.045 ms
64 bytes from 10.2.0.10: icmp_seq=1 ttl=64 time=0.089 ms
^C
--- 10.2.0.10 ping statistics ---
3 packets transmitted, 3 received, 0% packet loss, time 72ms
rtt min/avg/mdev = 0.045/0.60/0.089/0.020 ms
```
Notre première VM ping en effet la deuxième.

Sans aucune carte NAT configuré, on peut curl google depuis une VM :

```
$ curl www.google.com
<!doctype html><html itemscope="" itemtype="http://schema.org/WebPage" lang="fr"><head><meta content="text/html; charset=UTF-8" http-equiv="Content-Type"><meta content="/images/branding/googleg/1x/googleg_standard_color_128dp.png" itemprop="image"><title>Google</title><script nonce="zVZPWa2dIY6KUvY69MUm0A==">(function(){window.google={kEI:'PreUXe6_KuKAjLsPl46eyAk',kEXPI:'0,1353747,5103,559,730,224,510,1065,1217,864,1071,377,207,905,112,53,1336,672,2,124,10,713,319,19,49,490,278,392,126,1131274,189,1197557,329521,1294,12383,4855,32692,15247,867,12163,16521,364,8824,2436,3929,2019,1119,2,579,727,2431,1362,4323,3694,1274,773,2255,2815,3773,4,1047,218,6196,1719,1808,1960,16,2044,8910,5296,2016,38,920,873,1hp\x22,\x22dh\x22:true,\x22dhqt\x22:true,\x22ds\x22:\x22\x22,\x22ffql\x22:\x22fr\x22,\x22fl\x22:true,\x22host\x22:\x22google.
....com\x22,\x22isbh\x22:28,\x22jsonp\x22:true,\x22lm\x22:true,\x22msgs\x22:{\x22cibl\x22:\x22Effacer la recherche\x22,\x22dym\x22:\x22Essayez avec cette orthographe :\x22,\x22lcky\x22:\x22J\\u0026#39;ai de la chance\x22,\x22lml\x22:\x22En savoir plus\x22,\x22oskt\x22:\x22Outils de saisie\x22,\x22psrc\x22:\x22Cette suggestion a bien �t� supprim�e de votre \\u003Ca href\x3d\\\x22/history\\\x22\\u003Ehistorique Web\\u003C/a\\u003E.\x22,\x22psrl\x22:\x22Supprimer\x22,\x22sbit\x22:\x22Recherche par image\x22,\x22srch\x22:\x22Recherche Google\x22},\x22ovr\x22:{},\x22pq\x22:\x22\x22,\x22refpd\x22:true,\x22rfs\x22:[],\x22sbpl\x22:24,\x22sbpr\x22:24,\x22scd\x22:10,\x22sce\x22:5,\x22stok\x22:\x22VIdvhrKJtOQ310enOrxqknIWWZQ\x22,\x22uhde\x22:false}}';google.pmc=JSON.parse(pmc);})();</script>        </body></html>
```

### IV. Autres applications et métrologie

#### 1. Commandes

`iftop` n'étant pas présent sur la machine virtuelle, nous l'installons avec la commande `yum install iftop`

Après quelques recherches sur internet, `iftop` est un outil de monitoring qui liste les connexions internet.

```
└─bbbbbbbbbbbbbb┴─bbbbbbbbbbbbbb┴─bbbbbbbbbbbbbb┴─bbbbbbbbbbbbbb┴─bbbbbbbbbbbbb─
localhost.localdomain	   => par10s27-in-f206.1e100.ne     0b    267b     67b
                           <=                               0b    602b    150b
localhost.localdomain	   => 192.168.0.254                 0b    206b     51b
                           <=                               0b    330b     82b
localhost.localdomain	   => ip139.ip-5-196-160.eu	    0b     61b     15b
                           <=                               0b     61b     15b
localhost.localdomain	   => server.gigelf.fr              0b     61b     15b
                           <=                               0b     61b     15b
```
(après avoir fait un `curl` vers google.com)

`iftop` peut être utile si l'on veut surveiller ce que se passe sur sa machine afin de monitorer le flux entrant et sortant.

#### 2. Cockpit

On installe cockpit avec la commande donnée : `sudo dnf install -y cockpit`

On démarre cockpit : `sudo systemctl start cockpit`

Pour savoir sur quel port écoute cockpit : 

```
[root@localhost ~]# ss -tupln
Netid State   Recv-Q   Send-Q         Local Address:Port     Peer Address:Port                                                                                  
udp   UNCONN  0        0                  127.0.0.1:323           0.0.0.0:*      users:(("chronyd",pid=757,fd=6))                                               
udp   UNCONN  0        0           10.0.2.15%enp0s3:68            0.0.0.0:*      users:(("NetworkManager",pid=826,fd=18))                                       
udp   UNCONN  0        0                      [::1]:323              [::]:*      users:(("chronyd",pid=757,fd=7))                                               
tcp   LISTEN  0        128                  0.0.0.0:2222          0.0.0.0:*      users:(("sshd",pid=2102,fd=6))                                                 
tcp   LISTEN  0        128                        *:9090                *:*      users:(("cockpit-ws",pid=3028,fd=3),("systemd",pid=1,fd=24))                   
tcp   LISTEN  0        128                     [::]:2222             [::]:*      users:(("sshd",pid=2102,fd=8)) 
```

On remarque qu'il écoute sur le port 9090.

Le port ne semble pas être ouvert dans le firewall :

```
[root@localhost ~]# firewall-cmd --list-ports
2222/tcp
```

On l'ajoute donc : `firewall-cmd --list-ports 9090/tcp`

C'est bien mieux comme ça !

`[root@localhost ~]# firewall-cmd --list-ports 2222/tcp 9090/tcp`

Je me connecte à l'adresse : https://192.168.56.103:9090 avec les identifiants root et root (du premier coup et à l'instinct).

Nous sommes redirigé sur https://192.168.56.103:9090/system

Nous avons exploré un peu tous les onglets et Cockpit semble être un outil pour garder un oeil et la gérer (on peut reboot la machine par exemple) sur sa machine.

La partie réseau affiche les interfaces. On a un résumé des ports du parefeu.
Nous pouvons voir l'envoi et la réception internet et nous avons accès au journal du réseau.

#### 3. Netdata

Tout d'abord nous installons Netdata et ses prérequis avec la commande :

```sudo yum install zlib-devel libuuid-devel gcc make git autoconf automake pkgconfig```

```sudo yum install curl jq nodejs```

Téléchargement de Netdata :

```php
git clone https://github.com/firehol/netdata.git --depth=1
cd netdata
sudo ./netdata-installer.sh
```

Le port utilisé pour accéder à l'outil Netdata est 19999, il faut donc l'ajouter à la liste des ports autorisés dans le firewall.

```
sudo firewall-cmd --permanent --zone=public --add-port=19999/tcp
sudo firewall-cmd --reload
```

Ca marche est c'est trop beauuuuuuuuu !

Dans le System Overview nous avons :

- Used Swap (en %)
- Disk Read (en KiB/s)
- Disk Write (en KiB/s)
- CPU (en %)
- Net Inbound (en megabits/s) 
- Net Outbound (en megabits/s)
- Used ram (en %)

Il y a pleins d'autres petit tools sympa comme la mise en place d'alarme ou encore le téléchargement des données récoltées. 