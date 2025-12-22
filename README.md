# 🏥 Unity Care Clinic – Application Console PHP 8 (CLI)

Unity Care Clinic CLI est une application console développée en **PHP 8 orienté objet**, permettant de gérer les données d’une clinique médicale (patients, médecins, départements) via une **interface en ligne de commande (CLI)** avec **persistance MySQL**.

Ce projet est une refonte orientée objet de la version web procédurale existante, conçue pour un usage interne rapide et efficace.

---

## 🎯 Objectifs du Projet

- Refactoriser la logique métier en **architecture orientée objet**
- Implémenter l’**encapsulation, l’héritage et les interfaces**
- Créer une **couche d’accès aux données MySQLi (OOP)**
- Offrir une **interface CLI interactive** pour les opérations CRUD
- Générer des **statistiques via méthodes statiques**
- Garantir la **validation des données utilisateur**

---

## 🛠️ Technologies Utilisées

- **PHP 8**
- **MySQL**
- **MySQLi (Programmation Orientée Objet)**
- **CLI (Command Line Interface)**

---



## 🧩 Architecture & Concepts Clés

### 1️⃣ Classes Métier

- **Personne** (classe mère)
  - Propriétés privées
  - Getters / Setters avec validation
  - Méthode utilitaire `getFullName()`

- **Patient** *(hérite de Personne)*
- **Doctor** *(hérite de Personne / User)*
- **Department**

Toutes les entités :
- Héritent de `BaseModel`
- Implémentent l’interface `Displayable`
- Contiennent une méthode `__toString()` (au moins une classe)

---

### 2️⃣ BaseModel (Classe Abstraite)

Contient les méthodes partagées :
- `save()`
- `delete()`
- `findById(int $id)`
- `getId()`

Permet une gestion cohérente de l’héritage et de la persistance.

---

### 3️⃣ Validator (Classe Statique)

Validation et sécurisation des données :

```php
Validator::isValidEmail(string $email): bool
Validator::isValidPhone(string $phone): bool
Validator::isValidDate(string $date): bool
Validator::isNotEmpty(string $input): bool
Validator::sanitize(string $input): string


## 🖥️ Interface Console (CLI)
Menu Principal
=== Unity Care CLI ===
1. Gérer les patients
2. Gérer les médecins
3. Gérer les départements
4. Statistiques
5. Quitter

Exemple : Gestion des Patients
=== Gestion des Patients ===
1. Lister tous les patients
2. Rechercher un patient
3. Ajouter un patient
4. Modifier un patient
5. Supprimer un patient
6. Retour




📊 Statistiques (Méthodes Statiques)

Patient::calculateAverageAge(): float

Doctor::calculateAverageYearsOfService(): float

Department::getMostPopulated(): Department

Patient::countByDepartment(): array

📌 Résultats affichés sous forme de tableaux ASCII.


📋 Affichage ASCII (Bonus)

Classe utilitaire ConsoleTable pour afficher les données :

+----+------------+-----------+------------+
| ID | Prénom     | Nom       | Département|
+----+------------+-----------+------------+
| 1  | Mohammed   | Alami     | Cardiologie|
| 2  | Fatima     | Bennis    | Pédiatrie  |
+----+------------+-----------+------------+



** 👤 User Stories Implémentées

 - US01 : Navigation via menu CLI

 - US02 : CRUD Patients
 
 - US03 : CRUD Médecins
 
 - US04 : CRUD Départements
 
 - US05 : Statistiques médicales
 
 - US06 : Validation et gestion des erreurs