🚗 MaBagnole – Plateforme de Location de Véhicules & Blog Interactif
📌 Contexte du projet

L’agence MaBagnole souhaite enrichir son site web en intégrant un système complet de gestion de location de voitures, accompagné d’un blog interactif dédié aux passionnés d’automobiles.

L’objectif est de concevoir une plateforme moderne, performante et évolutive, permettant :

aux clients de parcourir, rechercher et réserver des véhicules selon leurs besoins,

aux administrateurs de gérer efficacement les véhicules, les réservations, les avis et les contenus éditoriaux.

Le projet est développé en PHP orienté objet (POO) et SQL, en suivant une conception UML rigoureuse (diagrammes de classes, cas d’utilisation, séquence).

🎯 Objectifs du projet

Mettre en place une plateforme de location de véhicules fiable et intuitive

Offrir une expérience utilisateur fluide (recherche, filtres dynamiques, pagination)

Développer un blog communautaire favorisant le partage d’expériences automobiles

Implémenter une architecture backend robuste (POO, SQL avancé)

Fournir un tableau de bord administrateur avec statistiques et gestion globale

🛠️ Technologies utilisées

Langage backend : PHP (Programmation Orientée Objet)

Base de données : MySQL / SQL

Frontend : HTML5, CSS3, JavaScript

Pagination & Data Management :

Pagination native en PHP

DataTables (version dynamique)

Modélisation : UML

SQL Avancé :

Vues SQL

Procédures stockées

👤 Rôles utilisateurs

Client

Administrateur

🚗 USER STORIES – Module Location de Véhicules
🔐 Authentification

En tant que client, je dois me connecter afin d’accéder à la plateforme de location.

🚙 Consultation & Recherche

Explorer les différentes catégories de véhicules

Consulter les détails d’un véhicule (modèle, prix, disponibilité, etc.)

Rechercher un véhicule par modèle ou caractéristiques

Filtrer les véhicules par catégorie sans rechargement de la page

Afficher les véhicules avec pagination

🛣️ Réservation

Réserver un véhicule en précisant :

dates de prise en charge,

lieux de prise et de retour

📝 Avis & Évaluations

Ajouter un avis ou une évaluation sur un véhicule loué

Modifier ou supprimer ses propres avis (Soft Delete)

🏦 Pagination – Deux versions

Version 🚙 : Pagination classique avec PHP

Version 🚙🚙 : Pagination dynamique avec DataTables

🛠️ USER STORIES – Administrateur (Location)

Ajouter plusieurs véhicules ou catégories à la fois (Insertion en masse)

Gérer :

véhicules,

réservations,

avis,

catégories

Accéder à un Dashboard Administrateur avec statistiques :

nombre de réservations,

véhicules disponibles,

avis clients,

performances globales

🧠 SQL Avancé (Extra I)
📊 Vue SQL

Création d’une vue SQL ListeVehicules permettant de :

combiner les informations des véhicules,

inclure les catégories,

afficher les évaluations associées,

indiquer la disponibilité.

⚙️ Procédure stockée

Création de la procédure stockée AjouterReservation :

gestion sécurisée de l’ajout d’une réservation,

prise en compte des paramètres nécessaires (véhicule, dates, client).

📰 Version II – Blog Interactif

Afin d’enrichir l’expérience utilisateur, MaBagnole intègre un blog automobile favorisant l’échange et le partage.

🛣️ USER STORIES – Blog
📚 Consultation

Explorer les thèmes du blog

Consulter les articles associés à un thème

Rechercher un article par titre

Filtrer les articles par tags

Afficher les articles avec une pagination (5, 10, 15 par page)

✍️ Création de contenu

Ajouter un article avec :

titre,

contenu,

tags,

médias optionnels (images, vidéos)

Ajouter des commentaires

Modifier ou supprimer ses propres commentaires

Ajouter un article aux favoris

🛠️ USER STORIES – Administrateur (Blog)

Gérer :

thèmes,

articles,

tags,

commentaires

Ajouter plusieurs tags simultanément

Approuver les articles soumis par les clients avant publication

Accéder à un tableau de bord administrateur pour le blog

📐 Architecture & Conception

Respect du MVC

Programmation orientée objet

Diagrammes UML :

Cas d’utilisation

Classes

Séquences

Séparation claire :

logique métier,

accès aux données,

interface utilisateur
