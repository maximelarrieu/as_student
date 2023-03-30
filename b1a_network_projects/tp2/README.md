# PROJET RESEAU - TP2
## EXPLORATION DU RESEAU D'UN POINT DE VUE DU CLIENT
### Exploration locale en solo
---
#### 1. Affichage d’informations sur la pile TPC/IP locale

**En ligne de commande**

Travaillant sous Fedora26 (Linux), pour afficher les informations des cartes réseaux de mon PC,
j’utilise la commande :
`ifconfig`

**Affichez les infos des cartes réseau de votre PC**

| Interface wifi | wlp58s0 |
|----------------|---------|
| Adresse MAC    | f8:59:71:c7:a1:4b  | 
| Adresse IP     | 10.33.2.218        |
| Adresse de réseau |  10.33.2.0      |
| Adresse de broadcast |  10.33.3.255 |

| Interface Ethernet | enp0s31f6        |
|-------------|-------------------------|
| Adresse MAC | 54:e1:ad:3d:1f:10       |
| Adresse IP  | Pas d'IP si non branché |

**Affichez votre gateway**

Pour afficher l’IP de mon gateway (passerelle), je rentre dans mon terminal :
`$ ip route | grep default`

**A quoi sert le gateway dans le réseau Ingesup**

Dans le réseau Ingesup, la gateway permet, lorsqu'un utilisateur souhaite se connecter au réseau, d'examiner sa demande (Ici certainement grâce aux identifiants pour se connecter). Et d'établir une liaison entre les deux.

**Nmap :**

Pour trouver les adresses disponibles grâce à nmap, je rentre la commande :
`$ nmap -sn -PE 10.33.0.0/22`

```
>Nmap done: 1024 IP addresses (378 hosts up) scanned in 52.79 seconds
MAC Address: 44:03:2C:2C:BD:5C (Intel Corporate)
Nmap scan report for 10.33.3.239
Host is up (0.091s latency).
MAC Address: F4:BF:80:C0:A5:8A (Unknown)
Nmap scan report for 10.33.3.242
```

On remarque qu'il y a des adresses IP disponibles entre `10.33.3.239` et `10.33.3.242`.

### Exploration locale en duo
---

#### 1. Prérequis

+ Câble RJ45
+ 2 PC
+ Firewalls désactivés

#### 2. Cablâge

C'est fait, branché via le port Ethernet à nos cartes Ethernet

#### 3. Modification d'adresse IP

Nous avons tout deux modifié l'adresse IP de notre carte Ethernet

Adresse IP de Thibault : 10.0.0.2

Adresse IP de Maxime : 10.0.0.3

Masque de sous-réseau : 255.255.255.0

Test avec le ping :

`$ ping 10.0.0.2`

#### 4. Utilisation d'un des deux comme gateway

Je désactive ma Wifi et n'ai plus accès à internet.

Thibaut active, sur sa carte Wifi le partage internet à sa carte ethernet afin de me partager internet. Je renseigne manuellement une adresse IP : 192.168.137.8 et utilise son IP comme passerelle : 192.168.137.1 Je renseigne les DNS de Google 8.8.8.8

`C:\Users\Thibault> ping 192.168.137.8`

J'ai internet !!!

#### 5. Petit chat privé

Notons qu'à partir d'ici, la suite des tests et du TP a été réalisé sur un Windows, un Fedora mais aussi sur un Mac.

Mon PC sous Fedora a servit de PC serveur avec pour adresse IP : 192.168.1.36

Mon PC sous Mac a servit de PC client.

L'avantage de ces deux OS est que nous n'avions pas besoin d'installer Netcat.

Pour se mettre en PC serveur,J'ai tapé la commande `nc -l -p 8888`. Pour se connecter au PC serveur, j'ai tapé, sur le mac la commande `nc 192.168.1.36 8888`

![alt_text](https://github.com/maximelarrieu/network_project/blob/master/screen_netcat.png "screen_netcat")

#### 6. Wireshark

On ne comprends pas tout sur Wireshark mais voilà un screen de Wireshark sur mac, écoutant uniquement les communications ayant pour protocole TCP et nous avons réussi à répérer deux communications entre le mac et le système sous fedora.

![alt_text](https://github.com/maximelarrieu/network_project/blob/master/screen_wireshark.png "screen_wireshark")

#### 7. Firewall

NOTHING

### Manipulations d'autres outils/protocoles côté client
---

>(Fait sur mon PC Windows car je ne trouvais pas les commandes sous linux)

#### DHCP

Pour savoir ça il faut aller dans l'invite de commande ou le Powershell et taper `ipconfig /all`

`Serveur DHCP : 10.33.3.254`

Avec cette commande, on peut aussi obtenir la durée de vie du bail DHCP.

+ Ce que nous avons compris du DHCP

Après nos recherches, nous savons que le DHCP signifie Dynamic Host Configuration Protocol ou en français le protocole de configuration automatiques des hôtes.

Il est chargé de la configuration automatique des adresses IP d'un réseau informatique. Cela évite à l'utilisateur de tout paramétrer lui-même.

+ Demandez une nouvelle adresse IP

Toujours dans notre invité de commande ou dans le terminal, on tape la commande `ipconfig /renew`

#### DNS

Toujours avec la commande `ifconfig -a`

`Serveur DNS : 10.33.10.20`

#### Nslookup

(Fait mon réseau)


```
PS C:\Users\mlarrieu> nslookup google.com`
Serveur :   bbox.lan
Address:  192.168.1.254

Réponse ne faisant pas autorité :
Nom :    google.com
Addresses:  2a00:1450:4007:80a::200e
         172.217.18.206
```


```
PS C:\Users\mlarrieu> nslookup ynov.com
Serveur :   bbox.lan
Address:  192.168.1.254

Réponse ne faisant pas autorité :
Nom :    ynov.com
Address:  217.70.184.38
```

Un DNS signifie Domain Name System, c'est ce qui attribue une adresse IP à un nom de domaine.

Ici nous voyons que le nom de domaine ynov.com est lié à l'adresse IP `217.70.184.38`.
Et le nom de domaine google.com est lié à l'adresse IP `172.217.18.206`.

**Reverse lookup**


```
PS C:\Users\mlarrieu> nslookup 78.78.21.21
Serveur :   bbox.lan
Address:  192.168.1.254

Nom :    host-78-78-21-21.mobileonline.telia.com
Address:  78.78.21.21
```


```
PS C:\Users\mlarrieu> nslookup 92.16.54.88
Serveur :   bbox.lan
Address:  192.168.1.254

Nom :    host-92-16-54-88.as13285.net
Address:  92.16.54.88
```

C'est la même chose que pour le lookup mais dans l'autre sens. C'est-à-dire que `78.78.21.21` est lié au nom de domaine host-78-78-21-21.mobileonline.telia.com

### 3. Bonus

+ Différences entre WiFi et câble

La WiFi n'a besoin que de deux cartes WiFi pour fonctionner alors que pour Ethernet il faut deux cartes Ethernet.
Le câble a un meilleur débit que la Wifi car il y a très peu de perte.

+ Interface d'administration de votre box

C'est fait via celle de Bouygues Telecom. L'interface est accessible via l'adresse 192.168.1.254, on y retrouve pleins de notions vues pendant les cours tel que l'IP, la Wifi, les ip locales, etc.

+ Elle sert à quoi la MAC si on a des IP ?

Une adresse IP est attribuée en fonction du réseau et peut changer alors que l'adresse MAC est physique en fonction de la carte réseau. Autrement dit, l'adresse IP change en fonction des réseaux et l'adresse MAC reste la même.

