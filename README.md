# PtitCuistot

PtitCuistot est une application web php/javascript/html/css.
Nous devons avec mes camarades, reprendre le projet existant donné par le professeur et le finaliser.
Il prends la forme d'un blog contenant diverses recettes de cuisines alimenté par la communauté.

## Consulter le projet

[Notre Site](https://dev-lepley221.users.info.unicaen.fr/)

Pour consulter notre Ptit Cuisto il faudra vous connecter avec vos identifiants unicaen

## Objectifs

- Assurer le traitement d’un formulaire HTML avec PHP
- Concevoir et réaliser une base de données en SQL
- Réaliser un CRUD en PHP
- Communiquer avec la base de données avec PDO
- Utiliser le design pattern MVC
- Utiliser un modèle Tailwind

## Sujet

### V1 - [Branche](https://github.com/SquidGame/TD1_SquidGame_PC/blob/V1)

L’internaute peut :

- Consulter la page Edito,
- Consulter la page des recettes,
- Consulter la page du détail d’une recette
- Filtrer les recettes par catégorie, titre (mots contenus) ou par ingrédient(s)

L’éditeur peut :

- Effectuer les mêmes opérations que l’internaute
- Ajouter une recette (soumise à validation de l’administrateur),
- Modifier une recette lui appartenant (soumise à validation de l’administrateur)
- Supprimer une recette lui appartenant

L’administrateur peut :

- Effectuer les mêmes opérations que l’internaute et l’éditeur
- Ajouter, modifier ou supprimer n’importe quelle recette,
- Valider l’ajout ou la modification d’une recette,
- Modifier le contenu de l’édito (Page édito)

### V2 - [Branche](https://github.com/SquidGame/TD1_SquidGame_PC/blob/V2)

De nouvelles fonctionnalités ont été intégrées au site :

- La possibilité pour l’internaute de se créer un compte
- La possibilité pour l’éditeur de modifier son mot de passe
- La possibilité pour l’éditeur de supprimer son compte
- La possibilité pour l’éditeur de saisir un commentaire sur une recette (soumis à validation de l’administrateur) : l’affichage des commentaires se fera sur la page de détail d’une recette.
- La possibilité pour l’administrateur de suspendre ou supprimer un compte

### MCD / MLD

**MCD**

![Voici le MLD :]([./annexe/MLD.png](https://images-ext-1.discordapp.net/external/TLfheUzQE6kT5HhhKyPIWlkVbLI-viux4syWV0PnJO8/https/raw.githubusercontent.com/SquidGame/TD1_SquidGame_PC/main/annexes/MCD.png?width=1201&height=676))

**MLD**

![Voici le MCD :](./annexe/MCD.png)

## Compte

1. Compte admin :
nom d'utilisateur : AdminUser
mot de passe : admin
2. Compte cuisto :
nom d'utilisateur : CuistoUser
mot de passe : cuisto
3. Compte visiteur
nom d'utilisateur : VisitorUser
mot de passe : visitor

## Réalisé avec

- [Tailwind](https://tailwindcss.com/) - Le framework CSS utilisé
- [MySQL](https://www.mysql.com/fr/) - Le système de gestion de base de données utilisé
- [Visual Studio Code](https://code.visualstudio.com/) - l'evironnement de développement utilisé
- [GitHub](https://github.com/) - L'outil utilisé pour le versionnage

## Auteurs

- [Gaëtan Lepley](https://github.com/Zalgow667)
- [Ianis Le Blay](https://github.com/I4NIS)
- [Ferdinand Eppele](https://github.com/FerdinandEPPELE)
- [Arthur Hamon](https://github.com/PrCthulhu)
