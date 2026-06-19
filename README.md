# PharmaFEFO (Part 2) - Application Asynchrone & API-Ready

## Présentation

PharmaFEFO est une application web de gestion de stock pharmaceutique basée sur la méthode **FEFO (First Expired, First Out)**.

Cette deuxième version introduit une architecture moderne orientée API permettant d'effectuer des opérations asynchrones grâce à JavaScript et Fetch API sans rechargement des pages.

---

# Objectifs

* Moderniser l'application en utilisant des requêtes asynchrones.
* Séparer les contrôleurs Web et API.
* Exposer des endpoints REST consommables par JavaScript.
* Renforcer la sécurité grâce à la gestion des rôles.
* Préparer l'application pour une future intégration avec React ou une application mobile.

---

# Architecture

L'application suit les principes :

* MVC (Model - View - Controller)
* Services & Repositories
* SOLID Principles
* API-Ready Architecture
* Separation of Concerns

## Structure du Projet

```text
pharmafefo/
│
├── config/
│   ├── database.php
│   └── environment.php
│
├── public/
│   ├──   
│   └── index.php
│
├── src/
│   ├── Controller/
│   │   ├── Web/
│   │   └── Api/
│   │
│   ├── Entity/
│   ├── Enum/
│   ├── Service/
│   └── Repository/
│
└── templates/
```

---

# Fonctionnalités

## Authentification

* Connexion sécurisée.
* Gestion des sessions.
* Contrôle d'accès selon les rôles.

### Rôles

* ADMIN
* PHARMACIEN
* PREPARATEUR

---

## Gestion des Produits

* Ajouter un produit.
* Modifier un produit.
* Supprimer un produit.
* Consulter les produits.

### API

```http
GET    ?action=api_products
GET    ?action=api_product&id=1
POST   ?action=api_product_store
PUT    ?action=api_product_update
DELETE ?action=api_product_delete
```

---

## Gestion des Lots

* Création de lots.
* Gestion des dates d'expiration.
* Mise à jour des quantités.
* Application du principe FEFO.

### API

```http
GET    ?action=api_batches
GET    ?action=api_batch_show&id=1
POST   ?action=api_batch_store
PUT    ?action=api_batch_update
DELETE ?action=api_batch_delete
```

---

## Gestion des Mouvements de Stock

### Entrées

Ajout de stock via formulaire asynchrone.

### Sorties

Décrémentation automatique selon FEFO.

### API

```http
POST ?action=api_stock_store
GET  ?action=api_stock_movements
```

---

## Tableau de Bord Dynamique

Le dashboard récupère ses données via Fetch API.

Fonctionnalités :

* Affichage des statistiques.
* Alertes de péremption.
* Mise à jour dynamique sans rechargement.

---

## Notifications

Le système génère automatiquement des alertes pour :

* Produits expirés.
* Produits proches de la péremption.
* Stocks faibles.

### API

```http
GET ?action=api_notifications
```

---

## Rapports

### Rapport des Stocks

```http
GET ?action=api_report_stock
```

### Rapport des Produits Expirés

```http
GET ?action=api_report_expired
```

### Rapport des Produits Expirant Bientôt

```http
GET ?action=api_report_expiring
```

### Rapport des Mouvements

```http
GET ?action=api_report_movements
```

### Statistiques Globales

```http
GET ?action=api_report_statistics
```

---

# Principe FEFO

FEFO signifie :

**First Expired First Out**

Lors d'une sortie de stock, le système sélectionne automatiquement le lot dont la date d'expiration est la plus proche.

Exemple :

| Lot | Expiration |
| --- | ---------- |
| A   | 01/07/2026 |
| B   | 01/12/2026 |

Le lot A sera utilisé en premier.

---

# Sécurité

## Contrôle d'Accès

Les routes sont protégées selon le rôle connecté.

Exemples :

* Seul un PREPARATEUR peut effectuer des entrées ou sorties de stock.
* Seul un ADMIN peut accéder aux rapports administratifs.

## Sessions

* Vérification des sessions actives.
* Déconnexion sécurisée.

---

# Technologies Utilisées

## Backend

* PHP 8
* PDO
* MySQL

## Frontend

* HTML5
* Tailwind CSS
* JavaScript ES6
* Fetch API

## Outils

* Git
* GitHub
* XAMPP

---

# Installation

## 1. Cloner le projet

```bash
git clone https://github.com/username/pharmafefo.git
```

## 2. Créer la base de données

```sql
CREATE DATABASE pharmafefo;
```

## 3. Importer le script SQL

Importer le fichier :

```text
database/script.sql
```

## 4. Configurer la connexion

Modifier :

```php
config/database.php
```

et renseigner :

```php
DB_HOST
DB_NAME
DB_USER
DB_PASSWORD
```

## 5. Lancer le projet

* Démarrer Apache.
* Démarrer MySQL.
* Ouvrir :

```text
http://localhost/pharmafefo
```

---

# Bonnes Pratiques Utilisées

* MVC
* SOLID
* Services & Repositories
* Dependency Injection
* Enums
* DRY
* YAGNI
* Fetch API
* REST API Principles

---

# Auteur

Achraf Outamghart
---

# Licence

Projet pédagogique réalisé dans le cadre de la formation Développeur Web et Web Mobile.
