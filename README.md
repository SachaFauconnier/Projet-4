# 📚 Projet 4 — Application de gestion de livres

## 🧾 Description

Cette application web permet aux utilisateurs de gérer une bibliothèque de livres, d’échanger avec d’autres utilisateurs et de consulter des profils.

Le projet est développé en **PHP avec une architecture MVC** et utilise une base de données MySQL.

---

## ⚙️ Fonctionnalités principales

### 📖 Gestion des livres (CRUD)
- Ajouter un livre
- Afficher la liste des livres
- Voir le détail d’un livre
- Modifier un livre
- Supprimer un livre

### 👤 Gestion des utilisateurs
- Inscription / connexion
- Modification du profil
- Ajout d’une photo de profil via URL
- Consultation du profil public

### 💬 Messagerie
- Envoyer un message à un utilisateur

---

## 🧱 Architecture

Le projet suit le pattern **MVC (Model - View - Controller)** :

- **Model / Manager** : gère les requêtes SQL et les opérations CRUD
- **Controller** : traite les requêtes utilisateur et applique la logique métier
- **View** : affiche les données

---

## 🗄️ Base de données

L’application utilise MySQL avec plusieurs tables principales :

- `utilisateur`
- `livre`
- `message`

Les opérations CRUD sont réalisées via des requêtes SQL :
- `SELECT`
- `INSERT`
- `UPDATE`
- `DELETE`

---

## 🔐 Sécurité

- Validation des données côté serveur
- Vérification des droits utilisateur
- Requêtes préparées pour limiter les injections SQL
- Identifiants de connexion à la base non exposés sur GitHub

---

## ⚙️ Installation

### 1. Cloner le projet

```bash
git clone https://github.com/ton-repo/projet4.git
```

### 2. Configurer la base de données

Créer une base de données MySQL puis importer le fichier SQL du projet.

### 3. Configurer la connexion à la base de données

Créer un fichier `config.php` dans le dossier prévu à cet effet :

```php
<?php

return [
    'db_host' => '127.0.0.1',
    'db_port' => '3306',
    'db_name' => 'nom_de_la_base',
    'db_user' => 'root',
    'db_pass' => '',
];
```
### 4. Lancer le projet

- Démarrer **Apache** et **MySQL** avec XAMPP
- Ouvrir le projet dans le navigateur :

```text
http://localhost/projet4
```

---

## 🚫 Sécurité des identifiants

Les identifiants de connexion à la base de données ne sont pas visibles dans la version en ligne du projet sur GitHub.

Ils sont stockés dans un fichier de configuration local non versionné, exclu du dépôt grâce au fichier `.gitignore`.

---

## 🛠️ Technologies utilisées

- PHP
- Architecture MVC
- MySQL
- HTML5
- CSS3
- JavaScript

---

## 👨‍💻 Auteur

Projet réalisé dans le cadre d’un projet de formation.

---

## 📌 Améliorations possibles

- Système de favoris
- Ajouter des livres
- Notifications utilisateur
- API REST

---

## ✅ Compétences mobilisées

- Développement en PHP orienté objet
- Mise en place d’une architecture MVC
- Manipulation d’une base de données MySQL
- Réalisation d’opérations CRUD
- Gestion des formulaires et validation des données
- Sécurisation des accès et des actions utilisateur
