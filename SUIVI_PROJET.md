# 📋 Suivi du Projet - Terra Sana Location Matériel

**Dernière mise à jour :** 5 février 2026  
**Version :** 0.1.0 (Développement initial)  
**Statut :** En cours de développement

---

## 📊 Vue d'ensemble du projet

### Description

Application web de gestion de location de matériel pour Terra Sana, permettant la gestion des utilisateurs (particuliers et professionnels) avec un système d'authentification sécurisé.

### Technologies utilisées

- **Backend :** Laravel 11.x (PHP)
- **Frontend :** Vue.js 3 + Inertia.js + TypeScript
- **Authentification :** Laravel Fortify (2FA activé)
- **Styling :** Tailwind CSS v4
- **Build :** Vite 7
- **Base de données :** MySQL/MariaDB
- **Tests :** Pest PHP

---

## 🎯 État d'avancement

### ✅ Fonctionnalités implémentées

#### Authentification & Sécurité

- [x] Système d'authentification complet (Laravel Fortify)
- [x] Authentification à deux facteurs (2FA)
- [x] Vérification d'email
- [x] Gestion des sessions sécurisées

#### Base de données

- [x] Migration : Table users
- [x] Migration : Table cache
- [x] Migration : Table jobs (queues)
- [x] Migration : Colonnes 2FA pour users
- [x] Migration : Table particuliers
- [x] Migration : Table pays
- [x] Migration : Table communes
- [x] Migration : Table langues
- [x] Migration : Table professionnels

#### Modèles Eloquent

- [x] Model User (avec 2FA)
- [x] Model Particulier
- [x] Model Professionnel
- [x] Model Pays
- [x] Model Commune
- [x] Model Langue

#### Factories & Seeders

- [x] UserFactory
- [x] ParticulierFactory
- [x] ProfessionnelFactory
- [x] PaysFactory
- [x] CommuneFactory
- [x] LangueFactory
- [x] CommuneSeeder

#### Contrôleurs

- [x] UtilisateurController
- [x] ParticulierController (CRUD)
- [x] ProfessionnelController (CRUD)

#### Interface utilisateur

- [x] Page d'accueil (Welcome)
- [x] Dashboard
- [x] Formulaire de création de particuliers
- [x] Système de navigation avec Inertia.js

#### Configuration & Outils

- [x] Configuration ESLint + TypeScript
- [x] Configuration Prettier
- [x] Configuration Tailwind CSS v4
- [x] Configuration Vite
- [x] Scripts de build et développement

---

## 🚧 En cours de développement

### Priorité haute

- [ ] **Validation complète des formulaires**
    - Validation côté client (Vue.js)
    - Messages d'erreur personnalisés
    - Retour utilisateur amélioré

### Priorité moyenne

- [ ] **Gestion des utilisateurs**
    - Gestion des rôles et permissions
    - Désactivation de comptes

- [ ] **Système de recherche et filtres**
    - Recherche par nom/prénom
    - Filtres par commune
    - Filtres par pays
    - Tri des résultats

---

## 📅 Fonctionnalités à venir

### Phase 1 - Gestion du matériel (Planifiée)

- [ ] Modèle Matériel
- [ ] Catégories de matériel
- [ ] Gestion de l'inventaire
- [ ] Photos et descriptions
- [ ] État et maintenance du matériel

### Phase 2 - Système de location (Planifiée)

- [ ] Modèle Location
- [ ] Calendrier de disponibilité
- [ ] Réservations en ligne
- [ ] Calcul automatique des tarifs
- [ ] Gestion des prolongations
- [ ] Historique des locations

### Phase 3 - Facturation & Paiements (Planifiée)

- [ ] Génération de factures
- [ ] Gestion des devis
- [ ] Intégration paiement en ligne
- [ ] Rappels de paiement
- [ ] Reporting financier

### Phase 4 - Fonctionnalités avancées (Future)

- [ ] Notifications par email/SMS
- [ ] Système de notes et commentaires
- [ ] Contrats numériques
- [ ] Signature électronique
- [ ] Export PDF des documents
- [ ] Statistiques et tableaux de bord
- [ ] Application mobile (PWA)

---

## 🐛 Bugs connus

### Critiques

_Aucun bug critique identifié pour le moment_

### Mineurs

- [ ] À documenter au fur et à mesure des tests

---

## 📝 Notes techniques

### Structure de la base de données

#### Table `users`

- Authentification complète avec 2FA
- Relations : particulier (1:1), professionnel (1:1)

#### Table `particuliers`

- user_id (unique)
- nom, prénom
- adresse complète (rue, numéro, commune, pays)
- langue de communication

#### Table `professionnels`

- user_id (unique)
- raison_sociale
- numéro_tva
- adresse complète (rue, numéro, commune, pays)
- langue de communication

#### Tables de référence

- `pays` : Liste des pays
- `communes` : Liste des communes
- `langues` : Liste des langues disponibles

### Routes principales

- `/` - Page d'accueil
- `/dashboard` - Tableau de bord (authentifié)
- `/utilisateurs` - Gestion des utilisateurs (authentifié)
- `/particuliers` - Gestion des particuliers (authentifié)
- `/professionnels` - Gestion des professionnels (authentifié)
- `/settings/*` - Paramètres utilisateur (authentifié)

---

## 🔄 Workflow de développement

### Installation

```bash
# Installer les dépendances PHP
composer install

# Installer les dépendances Node.js
npm install

# Configurer l'environnement
cp .env.example .env
php artisan key:generate

# Migrer la base de données
php artisan migrate

# Peupler avec des données de test
php artisan db:seed
```

### Développement

```bash
# Lancer le serveur Laravel
php artisan serve

# Lancer Laravel en mode dev
composer run dev

# Lancer les tests
php artisan test
```

### Production

```bash
# Build des assets
npm run build

# Optimisation Laravel
php artisan optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## 🎨 Standards de code

### PHP

- Suivre les standards PSR-12
- Utiliser Laravel Pint pour le formatage : `./vendor/bin/pint`
- Typage strict activé

### TypeScript/Vue.js

- Configuration ESLint stricte
- Prettier pour le formatage : `npm run format`
- Composition API obligatoire
- TypeScript strict mode

### Git

- Commits en français
- Messages descriptifs
- Branches feature/_, bugfix/_, hotfix/\*

---

## 📞 Contacts & Ressources

### Documentation

- [Laravel 11.x](https://laravel.com/docs/11.x)
- [Vue.js 3](https://vuejs.org/)
- [Inertia.js](https://inertiajs.com/)
- [Tailwind CSS v4](https://tailwindcss.com/)

### Environnement de développement

- **Serveur local :** Laragon
- **Chemin projet :** c:\laragon\www\terra_sana_location_materiel

---

## 📈 Métriques

### Code

- Contrôleurs : 4 (+ Settings)
- Modèles : 6
- Migrations : 9
- Factories : 6
- Routes : 3 groupes de ressources

### Tests

- Tests unitaires : À implémenter
- Tests de fonctionnalités : À implémenter
- Couverture de code : À mesurer

---

## ✏️ Journal des modifications

### [Non versionnée] - 05/02/2026

#### Ajouté

- Structure initiale du projet Laravel
- Authentification avec Fortify et 2FA
- Modèles Particulier, Professionnel, Pays, Commune, Langue
- Contrôleurs de base pour la gestion des entités
- Configuration TypeScript + Vue.js + Inertia
- Interface de création de particuliers

#### En cours

- Développement des interfaces CRUD complètes
- Validation des formulaires
- Tests unitaires et fonctionnels

---

## 🎯 Prochaines étapes immédiates

1. **Compléter l'interface Particuliers**
    - Pagination

2. **Améliorer l'UX**
    - Messages de succès/erreur
    - Loaders pendant les requêtes
    - Confirmations modales

3. **Commencer le module Matériel**
    - Définir la structure de données
    - Créer les migrations
    - Développer le CRUD de base

---

**Note :** Ce document doit être mis à jour régulièrement pour refléter l'état actuel du projet.
