# TP3 : Routage INTER-VLAN + mise en situation

## I. Router-on-a-stick

### Topologie mise en place

```
             +--+
             |R1|
             +-++
               |
               |                    +---+
               |          +---------+PC4|
+---+        +-+-+      +---+       +---+
|PC1+--------+SW1+------+SW2|
+---+        +-+-+      +-+--+
               |          |  |
               |          |  +------+--+
               |          |         |P1|
             +-+-+      +-+-+       +--+
             |PC2|      |PC3|
             +---+      +---+
```

### Prove me that your setup is actually working

#### think about VLANs, ping, etc.

Ips attribuées aux machines :

Machine | VLAN | IP `net1` | IP `net2` | IP `net3` |  IP `netP`
--- | --- | --- | --- | --- | ---
PC1 | 10 | `10.3.10.1/24` | x | x | x
PC2 | 20 | x | `10.3.20.2/24` | x | x | x
PC3 | 20 | x | `10.3.20.3/24` | x | x | x
PC4 | 30 | x | x |  `10.3.30.4/24` | x | x
P1 | 40 | x | x | x | `10.3.40.1/24` 
R1 | x |  `10.3.10.254/24` | `10.3.20.254/24` | `10.3.30.254/24` | `10.3.40.254/24` 

<details>
<summary>Adresse IP de PC1</summary>

```
PC1> show ip

NAME        : PC1[1]
IP/MASK     : 10.3.10.1/24
GATEWAY     : 10.3.10.254
DNS         : 
MAC         : 00:50:79:66:68:00
LPORT       : 10016
RHOST:PORT  : 127.0.0.1:10017
MTU:        : 1500
```
</details>

<details>
<summary>Adresse IP de PC2</summary>

```
PC2> show ip

NAME        : PC2[1]
IP/MASK     : 10.3.20.2/24
GATEWAY     : 10.3.20.254
DNS         : 
MAC         : 00:50:79:66:68:01
LPORT       : 10018
RHOST:PORT  : 127.0.0.1:10019
MTU:        : 1500
```
</details>

<details>
<summary>Adresse IP de PC3</summary>

```
PC3> show ip

NAME        : PC3[1]
IP/MASK     : 10.3.20.3/24
GATEWAY     : 10.3.20.254
DNS         : 
MAC         : 00:50:79:66:68:02
LPORT       : 10020
RHOST:PORT  : 127.0.0.1:10021
MTU:        : 1500
```
</details>

<details>
<summary>Adresse IP de PC4</summary>

```
PC4> show ip

NAME        : PC4[1]
IP/MASK     : 10.3.30.4/24
GATEWAY     : 10.3.30.254
DNS         : 
MAC         : 00:50:79:66:68:04
LPORT       : 10024
RHOST:PORT  : 127.0.0.1:10025
MTU:        : 1500
```
</details>

<details>
<summary>Adresse IP de P1</summary>

```
P> show ip

NAME        : P[1]
IP/MASK     : 10.3.40.1/24
GATEWAY     : 10.3.40.254
DNS         : 
MAC         : 00:50:79:66:68:03
LPORT       : 10022
RHOST:PORT  : 127.0.0.1:10023
MTU:        : 1500
```
</details>


Pour te prouver, on va tester quelques pings en corrélation avec le tableau :

✅ = peuvent se joindre
❌ = ne peuvent pas se joindre

Réseaux | `net1` |  `net2` |  `net3` |  `netP`
--- | --- | --- | --- | ---
 `net1` | ✅ | ❌ | ❌ | ❌
 `net2` | ❌ | ✅ | ✅ | ✅
 `net3` | ❌ | ✅ | ✅ | ✅
 `netP` | ❌ | ✅ | ✅ | ✅

<details>
<summary>Ping net1 vers net1</summary>

```
PC1> ping 10.3.10.1
10.3.10.1 icmp_seq=1 ttl=64 time=0.001 ms
10.3.10.1 icmp_seq=2 ttl=64 time=0.001 ms
10.3.10.1 icmp_seq=3 ttl=64 time=0.001 ms
10.3.10.1 icmp_seq=4 ttl=64 time=0.001 ms
10.3.10.1 icmp_seq=5 ttl=64 time=0.001 ms
```
</details>

<details>
<summary>Ping net1 vers net2</summary>

```
PC1> ping 10.3.20.2
host (10.3.10.254) not reachable
```
</details>

<details>
<summary>Ping net2 vers net3</summary>

```
PC3> ping 10.3.30.4
84 bytes from 10.3.30.4 icmp_seq=2 ttl=63 time=14.224 ms
84 bytes from 10.3.30.4 icmp_seq=3 ttl=63 time=13.498 ms
84 bytes from 10.3.30.4 icmp_seq=4 ttl=63 time=16.393 ms
84 bytes from 10.3.30.4 icmp_seq=5 ttl=63 time=16.661 ms
```
</details>

<details>
<summary>Ping net3 vers netP</summary>

```
PC4> ping 10.3.40.1
10.3.40.1 icmp_seq=1 timeout
84 bytes from 10.3.40.1 icmp_seq=2 ttl=63 time=13.800 ms
84 bytes from 10.3.40.1 icmp_seq=3 ttl=63 time=15.288 ms
84 bytes from 10.3.40.1 icmp_seq=4 ttl=63 time=19.249 ms
84 bytes from 10.3.40.1 icmp_seq=5 ttl=63 time=16.445 ms
```
</details>

<details>
<summary>Ping netP vers net1</summary>

```
P> ping 10.3.10.1
10.3.10.1 icmp_seq=1 timeout
10.3.10.1 icmp_seq=2 timeout
10.3.10.1 icmp_seq=3 timeout
^C
```
</details>

## II. Cas concret

### TODO

#### Pour la partie SOFT

##### dimensionnez intelligemment les réseaux

###### prévoyez une augmentation légère

Pour ce qui est de prévoir une augmentation légère du nombre d'adresses IPs disponibles, nous allons prévoir une augmentation de 20% dans notre sous-réseau.

Actuellement notre topologie posséde 38 machines, si l'on respecte l'augmentation de 20%, nous devons donner à notre sous réseau la possibilité d'avoir au moins 46 adresses IPs.

Un sous réseau en /26 nous offre 64 adresses dont 62 disponibles.

##### permettre un accès internet à tout le monde

Sur GNS, nous ajoutons un nuage NAT relié à notre routeur afin de partager internet avec tout le monde.

Exemple de preuve d'accès à internet :

```shell
ADMIN> ping 8.8.8.8
84 bytes from 8.8.8.8 icmp_seq=1 ttl=61 time=144.425 ms
84 bytes from 8.8.8.8 icmp_seq=2 ttl=61 time=106.328 ms
84 bytes from 8.8.8.8 icmp_seq=3 ttl=61 time=73.182 ms
84 bytes from 8.8.8.8 icmp_seq=4 ttl=61 time=845.391 ms
84 bytes from 8.8.8.8 icmp_seq=5 ttl=61 time=97.328 ms
```

#### INFRA

Après avoir déterminer nos VLANS, nous passons à la configuration des sous-interfaces de notre router :

```shell
R1#conf t
R1(config)#int eth0/1
R1(config-if)#no shut
R1(config-if)#exit
R1(config)#int eth0/1.10
R1(config-subif)#encapsulation dot1q 10
R1(config-subif)#ip address 10.3.10.254 255.255.255.192
R1(config-subif)#no shut
R1(config-subif)#exit
R1(config)#int eth0/1.20
R1(config-subif)#encapsulation dot1q 20
R1(config-subif)#ip address 10.3.20.254 255.255.255.192
R1(config-subif)#no shut
R1(config-subif)#exit
R1(config)#int eth0/1.30
R1(config-subif)#encapsulation dot1q 30
R1(config-subif)#ip address 10.3.30.254 255.255.255.192
R1(config-subif)#no shut
R1(config-subif)#exit
R1(config)#int eth0/1.40
R1(config-subif)#encapsulation dot1q 40
R1(config-subif)#ip address 10.3.40.254 255.255.255.192
R1(config-subif)#no shut
R1(config-subif)#exit
R1(config)#int eth0/1.50                         
R1(config-subif)#encapsulation dot1q 50                
R1(config-subif)#ip address 10.3.50.254 255.255.255.192
R1(config-subif)#no shut
R1(config-subif)#exit
R1(config)#int eth0/1.60
R1(config-subif)#encapsulation dot1q 60                
R1(config-subif)#ip address 10.3.60.254 255.255.255.192
R1(config-subif)#no shut
R1(config-subif)#exit
```

Nous configurons ensuite les VLANS sur le switch1 :

```shell
IOU1#conf t
Enter configuration commands, one per line.  End with CNTL/Z.
IOU1(config)#vlan 10
IOU1(config-vlan)#name administrators
IOU1(config-vlan)#no shut
%VLAN 10 is not shutdown.
IOU1(config-vlan)#exit
IOU1(config)#vlan 20
IOU1(config-vlan)#name users
IOU1(config-vlan)#no shut
%VLAN 20 is not shutdown.
IOU1(config-vlan)#exit
IOU1(config)#vlan 30
IOU1(config-vlan)#name stagiaires
IOU1(config-vlan)#no shut
%VLAN 30 is not shutdown.
IOU1(config-vlan)#exit
IOU1(config)#vlan 60
IOU1(config-vlan)#name printers
IOU1(config-vlan)#no shut
%VLAN 60 is not shutdown.
IOU1(config-vlan)#exit
```

Il faut maintenant pour chaque interface, donner accès au(x) VLANS auquel elle peut accèder :
*Nous proposons quelques exemples pour les différentes machines*

```shell
// Les administrateurs
IOU1(config)#int eth0/2
IOU1(config-if)#switchport mode access
IOU1(config-if)#switchport access vlan 10
IOU1(config-if)#no shut
IOU1(config-if)#exit

// Les users
IOU1(config)#int eth1/0
IOU1(config-if)#switchport mode access
IOU1(config-if)#switchport access vlan 20
IOU1(config-if)#no shut
IOU1(config-if)#exit

// Les stagiaires
IOU1(config)#int eth2/1
IOU1(config-if)#switchport mode access
IOU1(config-if)#switchport access vlan 30 
IOU1(config-if)#no shut
IOU1(config-if)#exit

// Les imprimantes
IOU1(config)#int eth0/3
IOU1(config-if)#switchport mode access
IOU1(config-if)#switchport access vlan 60
IOU1(config-if)#no shut
IOU1(config-if)#exit
```

On *trunk* maintenant notre switch configuré avec celui branché aux serveurs :

```shell
// Switch1
IOU1#conf t
IOU1(config)#int eth0/1 
IOU1(config-if)#switchport trunk encapsulation dot1q
IOU1(config-if)#switchport mode trunk
IOU1(config-if)#switchport trunk allowed vlan 40,50,10,20,60
IOU1(config-if)#no shut
IOU1(config-if)#exit
IOU1(config)#exit

// Switch2
IOU2#conf t
IOU2(config)#int eth0/0 
IOU2(config-if)#switchport trunk encapsulation dot1q
IOU2(config-if)#switchport mode trunk
IOU2(config-if)#switchport trunk allowed vlan 40,50,10,20,60
IOU2(config-if)#no shut
IOU2(config-if)#exit
IOU2(config)#exit
```

On peut remarquer que le VLAN correspondant aux stagiaires n'est pas alloué, car dans tous les cas, ils n'ont accès à aucun des serveurs.

Nous configurons ensuite les VLANS sur le switch2 :

```shell
IOU2(config)#vlan 40
IOU2(config-vlan)#name serveurs
IOU2(config-vlan)#no shut
%VLAN 40 is not shutdown.
IOU2(config-vlan)#exit
IOU2(config)#vlan 50
IOU2(config-vlan)#name sensible-serveurs
IOU2(config-vlan)#no shut
%VLAN 50 is not shutdown.
IOU2(config-vlan)#exit
```

Il faut maintenant pour chaque interface, donner accès au(x) VLANS auquel elle peut accèder :
*Nous proposons quelques exemples pour les différentes machines*

```shell
// Les serveurs
IOU2(config)#int eth0/2
IOU2(config-if)#switchport mode access
IOU2(config-if)#switchport access vlan 50
IOU2(config-if)#no shut
IOU2(config-if)#exit

// Les serveurs sensibles
IOU2(config)#int eth0/3
IOU2(config-if)#switchport mode access
IOU2(config-if)#switchport access vlan 40
IOU2(config-if)#no shut
IOU2(config-if)#exit
```

Il faut maintenant configurer les IPs de nos VPCS :

```shell
// Les VPCS administrateurs
ADMIN> ip 10.3.10.1/24 10.3.10.254
Checking for duplicate address...
PC1 : 10.3.10.1 255.255.255.0 gateway 10.3.10.254

// Les VPCS users
U1> ip 10.3.20.1/24 10.3.20.254
Checking for duplicate address...
PC1 : 10.3.20.1 255.255.255.0 gateway 10.3.20.254

// Les VPCS stagiaires
U1> ip 10.3.30.1/24 10.3.30.254
Checking for duplicate address...
PC1 : 10.3.30.1 255.255.255.0 gateway 10.3.30.254

// Les VPCS serveurs
U1> ip 10.3.40.1/24 10.3.40.254
Checking for duplicate address...
PC1 : 10.3.40.1 255.255.255.0 gateway 10.3.40.254

// Les VPCS serveurs sensibles
U1> ip 10.3.50.1/24 10.3.50.254
Checking for duplicate address...
PC1 : 10.3.50.1 255.255.255.0 gateway 10.3.50.254

// Les VPCS imprimantes
U1> ip 10.3.60.1/24 10.3.60.254
Checking for duplicate address...
PC1 : 10.3.60.1 255.255.255.0 gateway 10.3.60.254

```

#### Pour la partie HARD

##### proposez un nombre de routeur et de switches et précisez à quel endroit physique ils se trouveront

Lors de la mise en place d'une topologie, les frais d'infrastructure doivent êtres pris en compte, ainsi que la sécurité, nous sommes donc parti sur une topologie comportant :

- 1 routeur relié au NAT
- 2 switchs (dont 1 relié à toutes les machines sauf la salle serveurs)

Le routeur et le switch relié à toutes les machines sauf la salle serveur se trouvent dans le bureau principal, à l'abri des autres utilisateurs du réseau. 

Pour ce qui est du dernier switch, relié à la salle serveur, il se trouve dans la salle serveur qui est sécurisée et fermée.

##### précisez le nombre de câbles nécessaires et une longueur (approximative)

Nous avons 38 machines, donc 38 cables, plus 1 cable entre les 2 switchs et 1 cable entre le routeur et le switch et un cable entre le routeur et le NAT donc : 41 cables.

Si le batiment fait 20 mètres sur 20 mètres :

- Dans la salle serveur (6 cables) : 2 cables courts (car proche du switch de la salle), 4 moyens
- Dans la salle du bureau principal (2 cables) : 2 cables courts (car proche du deuxième switch) 
- Entre la salle du bureau principal et la salle serveur (1 cable): 1 cable long
- Entre le switch du bureau principal et le routeur du bureau principal (1 cable) : 1 cable court (car côte à côte)
- Pour les autres salles (30 cables) : 30 cables longs à relier vers le bureau principal. 

#### livrer, en plus de l'infra, des éléments qui rendent compte de l'infra (de façon simple)

##### schéma réseau (screen GNS ?)

![Screen gns](https://raw.githubusercontent.com/maximelarrieu/b2a_network_tps/master/TP3/screens/screen-gns.png "Screen GNS de la topologie")

##### référez-vous à la partie I. (tableau des réseaux utilisés, tableau d'adressage)

Machines	| VLAN | net1 		  | net2 | net3 | net4 | net5 | net6 |
------- | ---- | ------------- | ---- | ---- | ---- | -----|------|
ADMINS  | 10   | `10.3.10.1-3` |   x  |   x  |   x  |  x   |   x  |
USERS   | 20   |       x       |   `10.3.20.1-16`  |   x  |   x  |  x   |   x  |
STAGIAIRES| 30 |       x       |   x  |   `10.3.30.1-8`  |   x  |  x   |   x  |
SERVEURS| 40   |       x       |   x  |   x  |   `10.3.40.1-4`  |  x   |   x  |
SS      | 50   |       x       |   x  |   x  |   x  |  `10.3.50.1-2`   |   x  |
IMPRIMANTES| 60|       x       |   x  |   x  |   x  |  x   |   `10.3.60.1-5`  |
R1      |   x  |  `10.3.10.254` | `10.3.20.254` | `10.3.30.254` | `10.3.40.254` | `10.3.50.254` | `10.3.60.254` |


#### Dans un second temps :

Désormais, on va mettre en place les machines afin qu'elles puissent où non se joindre :
Tous les ports de nos switchs devront être configurés en mode trunk afin de leurs donner accès aux VLANs auxquels ils sont autorisés.

*SWITCH 1*

```
// Les administrateurs peuvent joindre - Admins, Serveurs, SS, Imprimantes
// Tous les ports connectés à un administrateur seront configurés de la même façon
IOU1#conf t
IOU1(config)#int eth0/2
IOU1(config-if)#switchport trunk encapsulation dot1q
IOU1(config-if)#switchport mode trunk
IOU1(config-if)#switchport trunk allowed vlan 10,40,50,60
IOU1(config-if)#no shut  
IOU1(config-if)#exit
IOU1(config)#exit

// Les users peuvent joindre - Users, Serveurs, Imprimantes
// Tous les ports connectés à un user seront configurés de la même façon
IOU1(config)#int eth1/0
IOU1(config-if)#switchport trunk encapsulation dot1q
IOU1(config-if)#switchport mode trunk
IOU1(config-if)#switchport trunk allowed vlan 20,40,60
IOU1(config-if)#no shut  
IOU1(config-if)#exit
IOU1(config)#exit

// Les stagiaires peuvent joindre - Stagiaires, Imprimantes
// Tous les ports connectés à un stagiaire seront configurés de la même façon
IOU1(config)#int eth2/1
IOU1(config-if)#switchport trunk encapsulation dot1q
IOU1(config-if)#switchport mode trunk
IOU1(config-if)#switchport trunk allowed vlan 30,60
IOU1(config-if)#no shut  
IOU1(config-if)#exit
IOU1(config)#exit

// // Les imprimantes peuvent joindre - Imprimantes, Admins, Users, Stagiaires, Serveurs
// Tous les ports connectés à une imprimante seront configurés de la même façon
IOU1(config)#int eth2/0
IOU1(config-if)#switchport trunk encapsulation dot1q
IOU1(config-if)#switchport mode trunk
IOU1(config-if)#switchport trunk allowed vlan 10,20,30,40,60
IOU1(config-if)#no shut  
IOU1(config-if)#exit
IOU1(config)#exit
```

*SWITCH 2*

```
// Les serveurs peuvent joindre - Serveurs, Admins, Users, Imprimantes
// Tous les ports connectés à un serveur seront configurés de la même façon
IOU2#conf t
IOU2(config)#int eth0/3
IOU2(config-if)#switchport trunk encapsulation dot1q
IOU2(config-if)#switchport mode trunk
IOU2(config-if)#switchport trunk allowed vlan 10,20,40,60
IOU2(config-if)#no shut  
IOU2(config-if)#exit
IOU2(config)#exit

// Les SS peuvent joindre - SS, Admins
// Tous les ports connectés à un SS seront configurés de la même façon
IOU2#conf t
IOU2(config)#int eth0/1
IOU2(config-if)#switchport trunk encapsulation dot1q
IOU2(config-if)#switchport mode trunk
IOU2(config-if)#switchport trunk allowed vlan 10,50
IOU2(config-if)#no shut  
IOU2(config-if)#exit
IOU2(config)#exit
```

#### BONUS

#### mettre en place les exceptions

##### documentez-vous, proposez des choses

#### mettre en place un serveur DHCP
