# Larrieu-Feugere-JSLand

## Entitées

### Personnes

Toutes les personnes ont un nom, un prénom.

- Client

- - Posséde un budget. 
- - Montant d'une transaction ne peut excéder le budget.
- - Le client doit se souvenir de où et quand était sa dernière transaction

- Caissier

- - Assigné a une attraction
- - Peut traiter le nombre de places de l'attraction
- - Le caissier déclenche le paiement

- Restaurateur

- - Assigné à un restaurant en particulier
- - Peut traiter le repas de son restaurant
- - Le restaurateur déclenche le paiement

- Manager

- - A une liste d'employés à ses ordres
- - Un client peut venir se plaindre au manager et si l'erreur vient d'un de ses employés, le manager rembourse le client

### Batiments

Chaque batiment a un nom et un employé qui le gère.
Chaque interaction passe par le batiment puis l'employé qui le gère.

- Attraction

- - A un nombre de places limitées
- - Un prix au ticket

- Restaurant

- - Deux menus
- - Deux prix différents à l'unité
