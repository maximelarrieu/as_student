# TP2 : Network low-level, Switching

## I. Simplest setup

##### Topologie mise en place

```
+-----+        +-------+        +-----+
| PC1 +--------+  SW1  +--------+ PC2 |
+-----+        +-------+        +-----+
```

### Faire communiquer les deux PCs

#### Avec un ping qui fonctionne

Ping de PC1 vers PC2 :

```
$ ping 10.2.1.1
PING 10.2.1.1 (10.2.1.1) 56(84) bytes of data.
64 bytes from 10.2.1.1: icmp_seq=1 ttl=64 time=5.01 ms
64 bytes from 10.2.1.1: icmp_seq=2 ttl=64 time=5.81 ms
64 bytes from 10.2.1.1: icmp_seq=3 ttl=64 time=4.75 ms
64 bytes from 10.2.1.1: icmp_seq=4 ttl=64 time=5.35 ms
64 bytes from 10.2.1.1: icmp_seq=5 ttl=64 time=3.61 ms
^C
--- 10.2.1.1 ping statistics ---
5 packets transmitted, 5 received, 0% packet loss, time 11ms
rtt min/avg/max/mdev = 3.608/4.905/5.801/0.738 ms
```

##### Déterminer le protocole utilisé par ping 

D'après Wireshark, protocole utilisé est ICMP qui signifie Internet Control Message Protocol.

`31	23.916701	10.2.1.2	10.2.1.1	ICMP	98	Echo (ping) request  id=0x06bf, seq=7/1792, ttl=64 (reply in 32)`

Analyse Wireshark du ping de PC2 vers PC1

```
31	23.916701	10.2.1.2	10.2.1.1	ICMP	98	Echo (ping) request  id=0x06bf, seq=7/1792, ttl=64 (reply in 32)
32	23.920234	10.2.1.1	10.2.1.2	ICMP	98	Echo (ping) reply    id=0x06bf, seq=7/1792, ttl=64 (request in 31)
34	24.918869	10.2.1.2	10.2.1.1	ICMP	98	Echo (ping) request  id=0x06bf, seq=8/2048, ttl=64 (reply in 35)
35	24.922306	10.2.1.1	10.2.1.2	ICMP	98	Echo (ping) reply    id=0x06bf, seq=8/2048, ttl=64 (request in 34)
36	25.920838	10.2.1.2	10.2.1.1	ICMP	98	Echo (ping) request  id=0x06bf, seq=9/2304, ttl=64 (reply in 37)
37	25.924180	10.2.1.1	10.2.1.2	ICMP	98	Echo (ping) reply    id=0x06bf, seq=9/2304, ttl=64 (request in 36)
```

### Expliquer...

#### Pourquoi le switch n'a pas besoin d'IP

Ce switch ne possède pas d'IP il ne comprend pas le protocole IP et ne sais pas l'utiliser non plus. Il utilise le protocole Ethernet.

#### Pourquoi les machines ont besoin d'une IP pour pouvoir se ping

Les machines ont besoin d'une IP pour pouvoir se ping et plus généralement pour communiquer car c'est le protocole pour 
discuter à travers le réseau qui est "portée" par une carte réseau. (cf mémo)

## II. More Switches

##### Topologie

```
                        +-----+
                        | PC2 |
                        +--+--+
                           |
                           |
                       +---+---+
                   +---+  SW2  +----+
                   |   +-------+    |
                   |                |
                   |                |
+-----+        +---+---+        +---+---+        +-----+
| PC1 +--------+  SW1  +--------+  SW3  +--------+ PC3 |
+-----+        +-------+        +-------+        +-----+
```

### Faire communiquer les trois PCs

#### Avec des pings qui fonctionnent

Ping de PC1 vers PC2 :

```
$ ping 10.2.1.2
PING 10.2.1.2 (10.2.1.2) 56(84) bytes of data.
64 bytes from 10.2.1.2: icmp_seq=1 ttl=64 time=3.28 ms
64 bytes from 10.2.1.2: icmp_seq=2 ttl=64 time=3.35 ms
64 bytes from 10.2.1.2: icmp_seq=3 ttl=64 time=3.43 ms
^C
--- 10.2.1.2 ping statistics ---
3 packets transmitted, 3 received, 0% packet loss, time 6ms
rtt min/avg/max/dev = 3.281/3.353/3.434/0.091 ms
```

Ping de PC1 vers PC3 :

```
$ ping 10.2.1.3
PING 10.2.1.3 (10.2.1.3) 56(84) bytes of data.
64 bytes from 10.2.1.3: icmp_seq=1 ttl=64 time=2.18 ms
64 bytes from 10.2.1.3: icmp_seq=2 ttl=64 time=3.75 ms
64 bytes from 10.2.1.3: icmp_seq=3 ttl=64 time=3.49 ms
^C
--- 10.2.1.3 ping statistics ---
3 packets transmitted, 3 received, 0% packet loss, time 6ms
rtt min/avg/max/dev = 2.214/3.390/1.894/0.022 ms
```

Ping de PC2 vers PC1 :

```
$ ping 10.2.1.1
PING 10.2.1.1 (10.2.1.1) 56(84) bytes of data.
64 bytes from 10.2.1.1: icmp_seq=1 ttl=64 time=1.94 ms
64 bytes from 10.2.1.1: icmp_seq=2 ttl=64 time=3.56 ms
64 bytes from 10.2.1.1: icmp_seq=3 ttl=64 time=2.19 ms
^C
--- 10.2.1.1 ping statistics ---
3 packets transmitted, 3 received, 0% packet loss, time 6ms
rtt min/avg/max/dev = 3.529/2.221/1.916/0.017 ms
```
Ping de PC2 vers PC3 :

```
$ ping 10.2.1.3
PING 10.2.1.3 (10.2.1.3) 56(84) bytes of data.
64 bytes from 10.2.1.3: icmp_seq=1 ttl=64 time=3.18 ms
64 bytes from 10.2.1.3: icmp_seq=2 ttl=64 time=2.59 ms
64 bytes from 10.2.1.3: icmp_seq=3 ttl=64 time=2.41 ms
^C
--- 10.2.1.3 ping statistics ---
3 packets transmitted, 3 received, 0% packet loss, time 6ms
rtt min/avg/max/dev = 3.621/3.753/2.846/0.071 ms
```

Ping de PC3 vers PC1 :

```
$ ping 10.2.1.1
PING 10.2.1.1 (10.2.1.1) 56(84) bytes of data.
64 bytes from 10.2.1.1: icmp_seq=1 ttl=64 time=2.68 ms
64 bytes from 10.2.1.1: icmp_seq=2 ttl=64 time=3.15 ms
64 bytes from 10.2.1.1: icmp_seq=3 ttl=64 time=3.11 ms
^C
--- 10.2.1.1 ping statistics ---
3 packets transmitted, 3 received, 0% packet loss, time 6ms
rtt min/avg/max/dev = 2.411/3.366/2.734/0.054 ms
```

Ping de PC3 vers PC2 :

```
$ ping 10.2.1.2
PING 10.2.1.2 (10.2.1.2) 56(84) bytes of data.
64 bytes from 10.2.1.2: icmp_seq=1 ttl=64 time=1.76 ms
64 bytes from 10.2.1.2: icmp_seq=2 ttl=64 time=2.29 ms
64 bytes from 10.2.1.2: icmp_seq=3 ttl=64 time=3.13 ms
^C
--- 10.2.1.2 ping statistics ---
3 packets transmitted, 3 received, 0% packet loss, time 6ms
rtt min/avg/max/dev = 2.818/3.123/3.498/0.176 ms
```

### Analyser la table MAC d'un switch :

#### `show mac address-table`

```
IOU2#show mac address-table 
          Mac Address Table
-------------------------------------------

Vlan    Mac Address       Type        Ports
----    -----------       --------    -----
   1    0800.274e.1c9f    DYNAMIC     Et0/2
   1    0800.2782.efcb    DYNAMIC     Et0/1
   1    aabb.cc00.0210    DYNAMIC     Et0/1
   1    aabb.cc00.0300    DYNAMIC     Et0/2
   1    aabb.cc00.0310    DYNAMIC     Et0/1
Total Mac Addresses for this criterion: 5
```

#### Comprendre/expliquer chaque ligne

Cette commande nous permet de montrer la table d'adresses mac.

Concrétement ça veut dire que pour communiquer avec l'adresse MAC `0800.274e.1c9f` (par exemple), alors il faut passer par le port `Et0/2`.

### Qu'est-ce que les trames CDP

En effet, il y a des trames CDP qui circulent. Cela signifie Cisco Discovery Protocol (CDP).
C'est un protocole propriétaire de Cisco qui a pour but de fournir des informations sur les voisins connectés.  

```shell script
22    29.215719    aa:bb:cc:00:02:20    CDP/VTP/DTP/PAgP/UDLD    CDP    456    Device ID: IOU2  Port ID: Ethernet0/2 
```

### Déterminer les informations STP 

#### A l'aide des commandes dédiées au protocole

##### Commande `show spanning-tree`

```shell
IOU3#show spanning-tree

VLAN0001
  Spanning tree enabled protocol rstp
  Root ID    Priority    32769
             Address     aabb.cc00.0100
             Cost        100
             Port        3 (Ethernet0/2)
             Hello Time   2 sec  Max Age 20 sec  Forward Delay 15 sec

  Bridge ID  Priority    32769  (priority 32768 sys-id-ext 1)
             Address     aabb.cc00.0300
             Hello Time   2 sec  Max Age 20 sec  Forward Delay 15 sec
             Aging Time  300 sec

Interface           Role Sts Cost      Prio.Nbr Type
------------------- ---- --- --------- -------- --------------------------------
Et0/0               Desg FWD 100       128.1    Shr 
Et0/1               Altn BLK 100       128.2    Shr 
Et0/2               Root FWD 100       128.3    Shr 
Et0/3               Desg FWD 100       128.4    Shr 
Et1/0               Desg FWD 100       128.5    Shr 
Et1/1               Desg FWD 100       128.6    Shr 
Et1/2               Desg FWD 100       128.7    Shr 
Et1/3               Desg FWD 100       128.8    Shr 
Et2/0               Desg FWD 100       128.9    Shr 
Et2/1               Desg FWD 100       128.10   Shr 
Et2/2               Desg FWD 100       128.11   Shr 
Et2/3               Desg FWD 100       128.12   Shr 
Et3/0               Desg FWD 100       128.13   Shr 
Et3/1               Desg FWD 100       128.14   Shr 
Et3/2               Desg FWD 100       128.15   Shr 
Et3/3               Desg FWD 100       128.16   Shr 
```

##### Commande `show spanning-tree bridge`

```shell
IOU3#show spanning-tree bridge

                                                   Hello  Max  Fwd
Vlan                         Bridge ID              Time  Age  Dly  Protocol
---------------- --------------------------------- -----  ---  ---  --------
VLAN0001         32769 (32768,   1) aabb.cc00.0300    2    20   15  rstp 
```

##### Commande `show spanning-tree summary`

```shell
IOU3#show spanning-tree summary
Switch is in rapid-pvst mode
Root bridge for: none
Extended system ID                      is enabled
Portfast Default                        is disabled
Portfast Edge BPDU Guard Default        is disabled
Portfast Edge BPDU Filter Default       is disabled
Loopguard Default                       is disabled
PVST Simulation Default                 is enabled but inactive in rapid-pvst mode
Bridge Assurance                        is enabled
EtherChannel misconfig guard            is enabled
Configured Pathcost method used is short
UplinkFast                              is disabled
BackboneFast                            is disabled

Name                   Blocking Listening Learning Forwarding STP Active
---------------------- -------- --------- -------- ---------- ----------
VLAN0001                     1         0        0         15         16
---------------------- -------- --------- -------- ---------- ----------
1 vlan                       1         0        0         15         16
```

##### Qui est le root bridge

Le root bridge est `VLAN0001` avec l'adresse MAC `aabb.cc00.0300`.

##### Quels sont les ports désactivés

Nous pouvons voir le port désactivé grâce à la commande `show spanning-tree` avec les trois lettres BLK.

Dans notre cas, nous remarquons que le port bloqué est à cette ligne `Et0/1               Altn BLK 100       128.2    Shr`.

Le port Et0/1 est donc bloqué.

### Faire un schéma représentant les informations STP

#### Rôle des switchs

Le rôle des switchs sont de relier différents clients entre-eux. Dans notre cas, le root bridge est le switch 1 (`VLAN0001`), cela signifie donc que 
toutes les communications passent par ce switch.

#### Rôle de chacun des ports

On peut voir qu'il y a différents types de port qui sont soit en statut FWD (forwarded) ou 
en BLK (bloked) avec pour role Desgn (designated) ou Altn (alternated) ou Root.

### Confirmer les informations STP

#### Effectuer un ping d'une machine à une autre

Ping de la machine 3 vers la machine 1 qui aboutit au résultat (via analyse de trames avec Wireshark) à des lignes qui ressemblent à :

`shell 12    8.052142    aa:bb:cc:00:01:00    Spanning-tree-(for-bridges)_00    STP    60    RST. Root = 32768/1/aa:bb:cc:00:01:00  Cost = 0  Port = 0x8001 `

#### Vérifier que les trames passent bien par le chemin attendu

en cours...

### Déterminer quel lien a été désactivé par STP

en cours...

### Faire un schéma qui explique le trajet d'une requête ARP lorsque PC1 ping PC3, et de sa réponse

#### Représenter TOUTES les trames ARP (n'oubliez pas les broadcasts)

en cours...

### Changer la priorité d'un switch qui n'est pas le root bridge

Pour changer la priorité d'un switch qui n'est pas le root bridge, on utilise la commande `conf t`

```shell
IOU3#conf t
Enter configuration commands, one per line.  End with CNTL/Z.
IOU3(config)#spanning-tree vlan 1 priority 0
```

En attribuant une priorité de 0, le switch devient root bridge.

### Vérifier les changements

#### Avec des commandes sur les switchs

```shell script
IOU3#show spanning-tree summary
Switch is in rapid-pvst mode
Root bridge for: VLAN0001
...
```

Désormais le switch 3 est root bridge.

#### Capturer les échanges qui suivent une reconfiguration STP avec Wireshark

## III. Isolation
### 1. Simple
##### Topologie

```
+-----+        +-------+        +-----+
| PC1 +--------+  SW1  +--------+ PC3 |
+-----+      10+-------+20      +-----+
                 20|
                   |
                +--+--+
                | PC2 |
                +-----+
```

#### Voir les commandes dédiées à la manipulation de VLANs
Nous donnons tout d'abord les bonnes adresses IP aux PC pour la topologie en modifiant le fichier `/etc/sysconfig/network-scripts/ifcfg-enp0s3`. Sans oublier un petit :

```
$ sudo ifdown enp0s3
$ sudo ifup enp0s3
```

Il faut maintenant configurer les switches, notamment les VLANs :

```
# conf t
(config)# vlan 10
(config-vlan)# name vm1-network
(config-vlan)# exit
(config)# interface eth0/0
(config-if)# switchport mode access
(config-if)# switchport access vlan 10
(config-if)# no shut

# conf t
(config)# vlan 20
(config-vlan)# name vm2-network
(config-vlan)# exit
(config)# interface eth0/1
(config-if)# switchport mode access
(config-if)# switchport access vlan 20
(config-if)# no shut

# conf t
(config)# vlan 20
(config-vlan)# name vm3-network
(config-vlan)# exit
(config)# interface eth0/2
(config-if)# switchport mode access
(config-if)# switchport access vlan 20
(config-if)# no shut
```

Une fois les VLANs configurés, nous pouvons les visualiser grâce à la commande `show vlan br` :

```
IOU1#show vlan br

VLAN Name                             Status    Ports
---- -------------------------------- --------- -------------------------------
1    default                          active    Et0/3, Et1/0, Et1/1, Et1/2,
                                                Et1/3, Et2/0, Et2/1, Et2/2,
                                                Et2/3, Et3/0, Et3/1, Et3/2,
                                                Et3/3
10   vm1-network                      active    Et0/0
20   vm2-network                      active    Et0/1, Et0/2
1002 fddi-default                     act/unsup 
1003 token-ring-default               act/unsup 
1004 fddinet-default                  act/unsup 
1005 trnet-default                    act/unsup 
```

### Faire communiquer les PCs deux à deux

#### Vérifier que PC2 ne peut joindre que PC3

On peut voir que le ping vers le `PC1` ne fonctionne pas mais que vers le `PC3` on envoie et reçoit des paquets :

```
$ ping 10.2.3.1
PING 10.2.3.1 (10.2.3.1) 56(84) bytes of data.
^C
--- 10.2.3.1 ping statistics ---
3 packets transmitted, 0 received, 100% packet loss, time 76ms

$ ping 10.2.3.3
PING 10.2.3.3 (10.2.3.3) 56(84) bytes of data.
64 bytes from 10.2.3.3: icmp_seq=1 ttl=64 time=3.034 ms
64 bytes from 10.2.3.3: icmp_seq=2 ttl=64 time=1.879 ms
64 bytes from 10.2.3.3: icmp_seq=3 ttl=64 time=0.111 ms
--- 10.2.3.3 ping statistics ---
3 packets transmitted, 3 received, 0% packet loss, time 5ms
```

#### Vérifier que PC1 ne peut joindre personne alors qu'il est dans le même réseau (sad)

J'effectue un ping depuis `PC1` vers `PC2` et `PC3` :

```
$ ping 10.2.3.2
PING 10.2.3.2 (10.2.3.2) 56(84) bytes of data.
^C
--- 10.2.3.2 ping statistics ---
3 packets transmitted, 0 received, 100% packet loss, time 52ms

$ ping 10.2.3.3
PING 10.2.3.3 (10.2.3.3) 56(84) bytes of data.
^C
--- 10.2.3.3 ping statistics ---
3 packets transmitted, 0 received, 100% packet loss, time 66ms
```

### 2. Avec trunk

##### Topologie

```
+-----+        +-------+        +-------+        +-----+
| PC1 +--------+  SW1  +--------+  SW2  +--------+ PC4 |
+-----+      10+-------+        +-------+20      +-----+
                 20|              10|
                   |                |
                +--+--+          +--+--+
                | PC2 |          | PC3 |
                +-----+          +-----+
```

Comme pour toutes les topologies, je viens éditer le fichier `/etc/sysconfig/network-scripts/ifcfg-enp0s3` afin de donner la bonne IP à toutes les machines virtuelles.

Pour configurer les vlans, voici la procédure : (ici la configuration pour le port vers VM1 avec un VLAN 10)

```
// Switch 1
# conf t
(config)# vlan 10
(config-vlan)# name vm1-network
(config-vlan)# exit
(config)# interface eth0/0
(config-if)# switchport mode access
(config-if)# switchport access vlan 10
(config-if)# no shut

# conf t
(config)# vlan 20
(config-vlan)# name vm2-network
(config-vlan)# exit
(config)# interface eth0/1
(config-if)# switchport mode access
(config-if)# switchport access vlan 20
(config-if)# no shut

// Switch 2
# conf t
(config)# vlan 20
(config-vlan)# name vm3-network
(config-vlan)# exit
(config)# interface eth0/1
(config-if)# switchport mode access
(config-if)# switchport access vlan 20
(config-if)# no shut

# conf t
(config)# vlan 10
(config-vlan)# name vm4-network
(config-vlan)# exit
(config)# interface eth0/2
(config-if)# switchport mode access
(config-if)# switchport access vlan 10
(config-if)# no shut
```

Une fois les VLANs configurés, nous pouvons les visualiser grâce à la commande `show vlan br` :

```
IOU1#show vlan br

VLAN Name                             Status    Ports
---- -------------------------------- --------- -------------------------------
1    default                          active    Et0/2, Et0/3, Et1/0, Et1/1
                                                Et1/2, Et1/3, Et2/0, Et2/1
                                                Et2/2, Et2/3, Et3/0, Et3/1
                                                Et3/2, Et3/3
10   vm1-network                      active    Et0/0
20   vm2-network                      active    Et0/1
1002 fddi-default                     act/unsup 
1003 token-ring-default               act/unsup 
1004 fddinet-default                  act/unsup 
1005 trnet-default                    act/unsup 

IOU2#show vlan br

VLAN Name                             Status    Ports
---- -------------------------------- --------- -------------------------------
1    default                          active    Et0/3, Et1/0, Et1/1, Et1/2
                                                Et1/3, Et2/0, Et2/1, Et2/2
                                                Et2/3, Et3/0, Et3/1, Et3/2
                                                Et3/3
10   vm3-network                      active    Et0/1
20   vm4-network                      active    Et0/2
1002 fddi-default                     act/unsup 
1003 token-ring-default               act/unsup 
1004 fddinet-default                  act/unsup 
1005 trnet-default                    act/unsup 
```

Je configure également une interface entre les deux switches : *trunk*

```
// Configuration sur le premier switch
IOU1#conf t
Enter configuration commands, one per line.  End with CNTL/Z.
IOU1(config)#interface eth0/2
IOU1(config-if)#switchport trunk encapsulation dot1q 
IOU1(config-if)#switchport mode trunk               
IOU1(config-if)#no shut
IOU1(config-if)#exit
IOU1(config)#exit

// Configuration sur le deuxième switch
IOU2#conf t
Enter configuration commands, one per line.  End with CNTL/Z.
IOU2(config)#interface eth0/0
IOU2(config-if)#switchport trunk encapsulation dot1q 
IOU2(config-if)#switchport mode trunk
IOU2(config-if)#no shut
IOU2(config-if)#exit
IOU2(config)#exit

```

On peut maintenant vérifier que `PC1` ne peut joindre que `PC3` et inversement :

```
PC1$ ping 10.2.10.2
PING 10.2.10.2 (10.2.10.2) 56(84) bytes of data.
64 bytes from 10.2.10.2: icmp_seq=1 ttl=64 time=2.731 ms
64 bytes from 10.2.10.2: icmp_seq=2 ttl=64 time=0.018 ms
64 bytes from 10.2.10.2: icmp_seq=3 ttl=64 time=1.131 ms
--- 10.2.10.2 ping statistics ---
3 packets transmitted, 3 received, 0% packet loss, time 12ms

PC3$ ping 10.2.10.1
PING 10.2.10.1 (10.2.10.21 56(84) bytes of data.
64 bytes from 10.2.10.1: icmp_seq=1 ttl=64 time=3.774 ms
64 bytes from 10.2.10.1: icmp_seq=2 ttl=64 time=2.547 ms
64 bytes from 10.2.10.1: icmp_seq=3 ttl=64 time=1.259 ms
--- 10.2.10.1 ping statistics ---
3 packets transmitted, 3 received, 0% packet loss, time 11ms

PC1$ ping 10.2.20.1
connect: Network is unreachable

PC3$ ping 10.2.20.2
connect: Network is unreachable
```

Par conséquent, le même fonctionnement est en place pour `PC2` et `PC4` :

```
PC2$ ping 10.2.20.2
PING 10.2.20.2 (10.2.20.2) 56(84) bytes of data.
64 bytes from 10.2.20.2: icmp_seq=1 ttl=64 time=2.286 ms
64 bytes from 10.2.20.2: icmp_seq=2 ttl=64 time=1.117 ms
64 bytes from 10.2.20.2: icmp_seq=3 ttl=64 time=0.982 ms
--- 10.2.20.2 ping statistics ---
3 packets transmitted, 3 received, 0% packet loss, time 7ms

PC4$ ping 10.2.20.1
PING 10.2.20.1 (10.2.20.1 56(84) bytes of data.
64 bytes from 10.2.20.1: icmp_seq=1 ttl=64 time=0.619 ms
64 bytes from 10.2.20.1: icmp_seq=2 ttl=64 time=1.326 ms
64 bytes from 10.2.20.1: icmp_seq=3 ttl=64 time=1.447 ms
--- 10.2.20.1 ping statistics ---
3 packets transmitted, 3 received, 0% packet loss, time 18ms

PC2$ ping 10.2.10.1
connect: Network is unreachable

PC4$ ping 10.2.10.2
connect: Network is unreachable
```

#### Mise en évidence de l'utilisation des VLANs avec Wireshark

```
25	25.125322	10.2.10.2	10.2.10.1	ICMP	98	Echo (ping) request  id=0x07c6, seq=6/1536, ttl=64 (reply in 26)
26	25.127007	10.2.10.1	10.2.10.2	ICMP	98	Echo (ping) reply    id=0x07c6, seq=6/1536, ttl=64 (request in 25)
27	25.222053	PcsCompu_db:c6:90	PcsCompu_d8:2d:52	ARP	60	Who has 10.2.10.2? Tell 10.2.10.1
28	25.233880	PcsCompu_d8:2d:52	PcsCompu_db:c6:90	ARP	60	10.2.10.2 is at 08:00:27:d8:2d:52
28	25.233880	PcsCompu_d8:2d:52	PcsCompu_db:c6:90	ARP	60	10.2.10.2 is at 08:00:27:d8:2d:52
30	25.377309	PcsCompu_db:c6:90	PcsCompu_d8:2d:52	ARP	60	10.2.10.1 is at 08:00:27:db:c6:90
31	25.457643	aa:bb:cc:00:01:20	CDP/VTP/DTP/PAgP/UDLD	DTP	60	Dynamic Trunk Protocol
31	25.457643	aa:bb:cc:00:01:20	CDP/VTP/DTP/PAgP/UDLD	DTP	60	Dynamic Trunk Protocol
31	25.457643	aa:bb:cc:00:01:20	CDP/VTP/DTP/PAgP/UDLD	DTP	60	Dynamic Trunk Protocol

```

## IV. Need perfs
##### Topologie

```
+-----+        +-------+--------+-------+        +-----+
| PC1 +--------+  SW1  +		   +  SW2  +--------+ PC4 |
+-----+      10+-------+--------+-------+20      +-----+
                 20|              10|
                   |                |
                +--+--+          +--+--+
                | PC2 |          | PC3 |
                +-----+          +-----+
```

Pour cette topologie nous pouvons garder les IPs déjà configurées précédemment. On suit la même configuration et topologie mais il faut maintenant 
configurer LACP entra `SWITCH1` et `SWITCH2`. En faisant des recherches sur internet, on peut trouver une façon de faire en quelques lignes :

```
// Switch 1
IOU1#conf t
Enter configuration commands, one per line.  End with CNTL/Z.
IOU1(config)#interface range eth0/2
IOU1(config-if-range)#shutdown
IOU1(config-if-range)#switchport trunk encapsulation dot1q
IOU1(config-if-range)#switchport mode trunk                
IOU1(config-if-range)#channel-group 2 mode active   
Creating a port-channel interface Port-channel 1
IOU1(config-if-range)#no shutdown 
IOU1(config-if-range)#exit
IOU1(config-if)#exit

IOU1(config)#interface Po1
IOU1(config-if)#switchport trunk encapsulation dot1q
IOU1(config-if)#switchport mode trunk
IOU1(config-if)#exit
IOU1(config)#no shut


// Switch 2
IOU2(config)#interface range eth0/0 
IOU2(config-if-range)#shutdown
IOU2(config-if-range)#switchport trunk encapsulation dot1q
IOU2(config-if-range)#switchport mode trunk
IOU2(config-if-range)#channel-group 2 mode active
Creating a port-channel interface Port-channel 1
IOU2(config-if-range)#no shutdown
IOU2(config-if-range)#exit
IOU2(config-if)#exit

IOU2(config)#interface Po1
IOU2(config-if)#switchport trunk encapsulation dot1q
IOU2(config-if)#switchport mode trunk
IOU2(config-if)#exit
IOU2(config)#no shut

```

Sur Wireshark on peut trouver des marques de l'utilisation de trames LACP comme :

```
2	1.971125	aa:bb:cc:00:02:00	Slow-Protocols	LACP	124	v1 ACTOR aa:bb:cc:80:02:00 P: 1 K: 1 **DCSG*A PARTNER aa:bb:cc:80:01:00 P: 3 K: 1 **DCSG*A
68	30.195557	aa:bb:cc:00:02:00	Slow-Protocols	LACP	124	v1 ACTOR aa:bb:cc:80:02:00 P: 1 K: 1 **DCSG*A PARTNER aa:bb:cc:80:01:00 P: 3 K: 1 **DCSG*A
```

Enfin, en utilisant la commande `show ip int po1` sur nos switches maintenant configurés, nous pouvons constater que la bande passante a bien été doublée :

```
IOU1#show ip int po1
Port-channel1 is up, line protocol is up
  Inbound  access list is not set
  Outgoing access list is not set
  
IOU2#show ip int po1
Port-channel1 is up, line protocol is up
  Inbound  access list is not set
  Outgoing access list is not set

```

On peut également obtenir un diagnostic etherchannel de notre double connexion entre nos switches avec une autre commande :

```
IOU1#sh etherchannel summary
Flags:  D - down        P - bundled in port-channel
        I - stand-alone s - suspended
        H - Hot-standby (LACP only)
        R - Layer3      S - Layer2
        U - in use      N - not in use, no aggregation
        f - failed to allocate aggregator

        M - not in use, minimum links not met
        m - not in use, port not aggregated due to minimum links not met
        u - unsuitable for bundling
        w - waiting to be aggregated
        d - default port

        A - formed by Auto LAG


Number of channel-groups in use: 1
Number of aggregators:           1

Group  Port-channel  Protocol    Ports
------+-------------+-----------+-----------------------------------------------
2      Po1(SU)         LACP      Et0/2(P)    
```

The end !