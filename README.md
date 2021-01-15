# Site de pandémies

Projet universitaire proposé par l'UE Technologies Web 3 en L3 Informatique par l'Université de Caen Normandie afin de nous faire découvrir la partie backend d'une application web et l'intégration sur un serveur en production.

<img src="logo-UNICAEN.jpg" style="width: 100px;" />

## Table des matières

- [Table des matières](#table-des-matières)
- [Introduction](#introduction)
- [Setup](#setup)
- [Commandes](#commandes)
- [Auteurs du projet](#auteurs-du-projet)

## Introduction

Le but du projet est de réaliser un site web complet permettant de référencer des objets en lien avec une base de données SQL. Vu le contexte actuel avec la Covid-19, nous avons choisi les maladies comme sujet. Nous devions construire un système d'authentifaction, un système de gestion de maladies. Notre site ne devait pas être vulnérable aux attaques classiques telles que les injections de scripts (PHP, Javascript, SQL).<br>Nous devions choisir 3 options (celles en gras) parmi celles-ci :

- **Une recherche d'objets**
- Associer des images aux objets (en choisir un seul parmi les trois) :
  - Un objet peut être illustré par une image (et une seule, non modifiable) uploadée par le créateur de l'objet.
  - Un objet peut être illustré par zéro, une ou plusieurs images (modifiables) uploadées par le créateur de l'objet.
  - Un objet peut être illustré par une (ou plusieurs) images (modifiables), uploadées par le créateur de l'objet et l'upload de cette image aura une barre de progression (pensez à tester avec une connexion lente ou avec de grosses images).
- **Site responsive**
- Tri de la liste des objets (par date etc)
- **Gestion par un admin des comptes utilisateurs**
- Pagination de la liste (avec N objets par page)
- Commentaires sur un objet
- Dans le formulaire d'inscription, vérification en temps réel de la disponibilité du login (par exemple lorsque le focus quitte le champ login).
- Fonctionnalité rester connecté, avec une durée de validité (plusieurs jours par exemple) paramétrable par l'administrateur du site.

## Setup

Vous devez installer PHP (7.4 minimum) sur votre machine.<br>Pour Windows, allez [sur ce lien](https://www.php.net/manual/en/install.windows.php).<br>Pour linux, vous n'avez qu'à exécuter la commande suivante :

```shell
$ sudo apt-get install php php-mysql
```

## Commandes

Les commandes principales sont :

- `$ php -S localhost:8000` pour lancer le site en local

## Auteurs du projet

- [BOCAGE Arthur](https://github.com/TurluTwoD)
- [PIERRE Corentin](https://github.com/coco-ia)
- [PIGNARD Alexandre](https://github.com/Myrani)
- [LETELLIER Guillaume](https://github.com/Guigui14460)
