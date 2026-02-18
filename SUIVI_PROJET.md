# 📋 Suivi du Projet - Terra Sana Location Matériel

**Dernière mise à jour :** 18 février 2026  
**Version :** 0.4.0 (Phases 1, 2 et 3 en cours)  
**Statut :** Développement avancé

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
- [x] Migration : Table types
- [x] Migration : Table pays
- [x] Migration : Table communes
- [x] Migration : Table langues
- [x] Migration : Table particuliers
- [x] Migration : Table professionnels
- [x] Migration : Table fonctions
- [x] Migration : Table contact_pros
- [x] Migration : Table categorie_materiels
- [x] Migration : Table materiels
- [x] Migration : Table photo_materiels
- [x] Migration : Table frais_livraisons
- [x] Migration : Table mode_livraisons
- [x] Migration : Table mode_retours
- [x] Migration : Table statuts
- [x] Migration : Table statut_paiements
- [x] Migration : Table type_documents
- [x] Migration : Table type_reductions
- [x] Migration : Table commandes
- [x] Migration : Table details_commandes
- [x] Migration : Table code_reductions
- [x] Migration : Table factures
- [x] Migration : Table reduction_clients
      **Total : 27 migrations**

#### Modèles Eloquent

- [x] Model User (avec 2FA)
- [x] Model Type
- [x] Model Particulier
- [x] Model Professionnel
- [x] Model Pays
- [x] Model Commune
- [x] Model Langue
- [x] Model Fonction
- [x] Model Contact_pro
- [x] Model Materiel
- [x] Model Categorie_materiel
- [x] Model Photo_materiel
- [x] Model Frais_livraison
- [x] Model Mode_livraison
- [x] Model Mode_retour
- [x] Model Statut
- [x] Model Statut_paiement
- [x] Model Type_document
- [x] Model Type_reduction
- [x] Model Commande
- [x] Model Details_commande
- [x] Model Code_reduction
- [x] Model Facture
- [x] Model Reduction_client
      **Total : 24 modèles**

#### Factories & Seeders

- [x] UserFactory + Seeder
- [x] TypeFactory + Seeder
- [x] ParticulierFactory + Seeder
- [x] ProfessionnelFactory + Seeder
- [x] PaysFactory + Seeder
- [x] CommuneFactory + Seeder
- [x] LangueFactory + Seeder
- [x] FonctionFactory + Seeder
- [x] ContactProFactory + Seeder
- [x] MaterielFactory + Seeder
- [x] CategorieMaterielFactory + Seeder
- [x] PhotoMaterielFactory + Seeder
- [x] FraisLivraisonFactory + Seeder
- [x] ModeLivraisonFactory + Seeder
- [x] ModeRetourFactory + Seeder
- [x] StatutFactory + Seeder
- [x] StatutPaiementFactory + Seeder
- [x] TypeDocumentFactory + Seeder
- [x] TypeReductionFactory + Seeder
- [x] CommandeFactory + Seeder
- [x] DetailsCommandeFactory + Seeder
- [x] CodeReductionFactory + Seeder
- [x] FactureFactory + Seeder
- [x] ReductionClientFactory + Seeder
      **Total : 24 factories et 25 seeders**

#### Contrôleurs

- [x] UtilisateurController
- [x] ParticulierController (CRUD complet)
- [x] ProfessionnelController (CRUD complet)
- [x] MaterielController (CRUD complet)
- [x] ContactProController (CRUD complet)
- [x] FonctionController
- [x] CategorieMaterielController
- [x] PhotoMaterielController
- [x] CommandeController (avec gestion panier)
- [x] DetailsCommandeController
- [x] FactureController
- [x] CodeReductionController
- [x] ReductionClientController
- [x] FraisLivraisonController
- [x] ModeLivraisonController
- [x] ModeRetourController
- [x] StatutController
- [x] StatutPaiementController
- [x] TypeController
- [x] TypeDocumentController
- [x] TypeReductionController
- [x] Settings (groupe de contrôleurs)
      **Total : 22+ contrôleurs**

#### Interface utilisateur

- [x] Page d'accueil (Welcome)
- [x] Dashboard
- [x] Pages CRUD Particuliers complet (Index, Create, Show, Edit)
- [x] Pages CRUD Professionnels complet (Index, Create, Show, Edit)
- [x] Pages CRUD Matériels complet (Index, Create, Edit)
- [x] Pages CRUD Utilisateurs (Index, Create)
- [x] Pages Commandes (Index, Create)
- [x] Pages Contact Pro (gestion des contacts professionnels)
- [x] Système de navigation avec Inertia.js
- [x] Layouts d'authentification multiples
- [x] Composants réutilisables

#### Configuration & Outils

- [x] Configuration ESLint + TypeScript
- [x] Configuration Prettier
- [x] Configuration Tailwind CSS v4
- [x] Configuration Vite
- [x] Scripts de build et développement

---

## 🚧 En cours de développement

### Priorité haute

- [ ] **Finaliser le module Commandes**
    - Validation complète du panier
    - Gestion des dates de location (début/fin)
    - Calcul automatique des tarifs
    - Processus de checkout complet
    - Page Show pour les commandes

- [ ] **Compléter le module Facturation**
    - Génération automatique de factures
    - Export PDF
    - Interface de consultation des factures
    - Liens factures ↔ commandes

- [ ] **Système de gestion des photos**
    - Upload multiple de photos
    - Galerie pour chaque matériel
    - Optimisation et thumbnails
    - Réorganisation des photos

### Priorité moyenne

- [ ] **Validation complète des formulaires**
    - Validation côté client renforcée (Vue.js)
    - Messages d'erreur personnalisés
    - Retour utilisateur amélioré
    - Validation temps réel

- [ ] **Gestion des utilisateurs avancée**
    - Gestion des rôles et permissions
    - Désactivation/suspension de comptes
    - Historique des actions utilisateur

- [ ] **Système de recherche et filtres avancés**
    - Recherche globale dans toutes les entités
    - Filtres multiples (commune, pays, catégorie)
    - Tri personnalisable
    - Export des résultats

---

## 📅 Fonctionnalités à venir

### Phase 1 - Gestion du matériel (✅ COMPLÉTÉE - 09-15/02/2026)

- [x] Modèle Materiel
- [x] Modèle Categorie_materiel
- [x] Modèle Contact_pro
- [x] Modèle Fonction
- [x] Modèle Photo_materiel
- [x] Migrations et factories
- [x] Controllers CRUD complets
- [x] Pages Index, Create et Edit pour matériels
- [ ] Page Show pour matériel (avec galerie photos)
- [x] Gestion de l'inventaire de base
- [ ] Upload et gestion des photos (en cours)
- [x] Interface de gestion des catégories
- [x] Système d'état et maintenance du matériel

### Phase 2 - Système de location (🔄 EN COURS - Démarrée le 11/02/2026)

- [x] Modèle Commande
- [x] Modèle Details_commande
- [x] Modèle Mode_livraison
- [x] Modèle Mode_retour
- [x] Modèle Frais_livraison
- [x] Modèle Statut
- [x] CommandeController avec gestion du panier
- [x] Pages Index et Create pour commandes
- [x] Système de panier (ajouter, retirer, modifier quantité, vider)
- [ ] Calendrier de disponibilité du matériel
- [ ] Gestion des dates de location (début/fin)
- [ ] Calcul automatique des tarifs selon durée
- [ ] Validation de disponibilité en temps réel
- [ ] Gestion des prolongations
- [ ] Historique des locations
- [ ] Notifications de rappel (retour matériel)

### Phase 3 - Facturation & Paiements (🔄 EN COURS - Démarrée le 11/02/2026)

- [x] Modèle Facture
- [x] Modèle Statut_paiement
- [x] Modèle Type_document
- [x] Modèle Code_reduction
- [x] Modèle Type_reduction
- [x] Modèle Reduction_client
- [x] FactureController de base
- [x] Système de réductions et codes promo
- [ ] Génération automatique de factures
- [ ] Génération de devis
- [ ] Export PDF des factures
- [ ] Intégration paiement en ligne
- [ ] Gestion des acomptes
- [ ] Rappels de paiement automatiques
- [ ] Reporting financier
- [ ] Tableau de bord financier

### Phase 4 - Fonctionnalités avancées (📋 PLANIFIÉE)

- [ ] Notifications par email/SMS
- [ ] Système de notes et commentaires
- [ ] Contrats numériques de location
- [ ] Signature électronique
- [ ] Export PDF des contrats
- [ ] Statistiques avancées et tableaux de bord
- [ ] Rapports personnalisables
- [ ] API REST pour intégrations tierces
- [ ] Application mobile (PWA)
- [ ] Mode hors-ligne
- [ ] Système de maintenance préventive

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
- Relations vers `contact_pros` et `fonctions`

#### Tables Matériel

- `materiels` : Inventaire du matériel avec états et maintenance
- `categorie_materiels` : Catégories hiérarchiques de matériel
- `photo_materiels` : Galerie de photos pour chaque matériel

#### Tables de Location/Commande

- `commandes` : Commandes de location avec dates et statuts
- `details_commandes` : Détails/lignes de chaque commande
- `statuts` : Statuts des commandes (en cours, validée, terminée...)
- `mode_livraisons` : Modes de livraison disponibles
- `mode_retours` : Modes de retour disponibles
- `frais_livraisons` : Grille tarifaire de livraison

#### Tables Facturation

- `factures` : Factures générées pour les commandes
- `statut_paiements` : Statuts de paiement
- `type_documents` : Types de documents (facture, devis, avoir...)
- `code_reductions` : Codes promotionnels
- `type_reductions` : Types de réductions (%, montant fixe...)
- `reduction_clients` : Réductions appliquées aux clients

#### Tables de référence

- `pays` : Liste des pays
- `communes` : Liste des communes avec codes postaux
- `langues` : Langues disponibles
- `types` : Types génériques (utilisateurs, documents...)
- `fonctions` : Fonctions des contacts professionnels (gérant, comptable...)

### Routes principales

- `/` - Page d'accueil
- `/dashboard` - Tableau de bord (authentifié)
- `/utilisateurs` - Gestion des utilisateurs (authentifié)
- `/particuliers` - Gestion des particuliers (authentifié)
- `/professionnels` - Gestion des professionnels (authentifié)
- `/materiels` - Gestion des matériels (authentifié)
- `/contact_pro` - Gestion des contacts pros (authentifié)
- `/commandes` - Gestion des commandes/locations (authentifié)
- `/panier/*` - Gestion du panier (ajouter, retirer, modifier, vider)
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

- Contrôleurs : 22+ (dont Settings)
- Modèles : 24
- Migrations : 27
- Factories : 24
- Seeders : 25
- Routes : 7 groupes de ressources + routes panier

### Tests

- Tests unitaires : À implémenter
- Tests de fonctionnalités : À implémenter
- Couverture de code : À mesurer

---

## ✏️ Journal des modifications

### [0.4.0] - 18/02/2026

#### Vue d'ensemble

Avancée significative sur les Phases 2 et 3 avec l'implémentation du système de commandes/location et des bases de la facturation.

#### Ajouté

- **Système de Commandes (Phase 2)**
    - Modèles : Commande, Details_commande, Mode_livraison, Mode_retour, Frais_livraison, Statut
    - CommandeController avec gestion complète du panier
    - Routes : ajout au panier, retrait, modification quantité, vidage panier
    - Pages : Index et Create pour les commandes
    - Migrations et factories pour toutes les entités

- **Système de Facturation (Phase 3)**
    - Modèles : Facture, Statut_paiement, Type_document
    - Modèles de réductions : Code_reduction, Type_reduction, Reduction_client
    - FactureController, controllers pour réductions et codes promo
    - Migrations et factories complètes
- **Contrôleurs additionnels**
    - FraisLivraisonController
    - ModeLivraisonController
    - ModeRetourController
    - StatutController
    - StatutPaiementController
    - TypeDocumentController
    - TypeReductionController
    - CodeReductionController
    - ReductionClientController

- **Modèles et tables de référence**
    - Model Type (table types pour types génériques)
    - PhotoMaterielController pour la gestion des photos

#### En cours

- Finalisation du processus de commande/checkout
- Génération automatique de factures
- Upload et gestion des photos de matériel
- Calendrier de disponibilité du matériel

### [0.3.0] - 15/02/2026

#### Ajouté

- **Complétion du module Matériel**
    - Page Edit pour les matériels
    - CategorieMaterielController complet
    - PhotoMaterielController de base
    - Model Photo_materiel avec migrations

#### Modifié

- Amélioration de l'interface utilisateur
- Optimisation des relations Eloquent

### [0.2.0] - 10/02/2026

#### Ajouté

- **Phase 1 démarrée** : Module de gestion du matériel
- Modèles : Materiel, Categorie_materiel, Contact_pro, Fonction
- Migrations pour les tables matériel
- MaterielController et ContactProController
- Factories : MaterielFactory, CategorieMaterielFactory, ContactProFactory, FonctionFactory
- Seeders complets pour toutes les tables
- Pages matériels (Index, Create)
- Routes ressources pour matériels et contacts pros
- Pages CRUD complètes pour Particuliers (Show, Edit)
- Pages CRUD complètes pour Professionnels (Show, Edit)
- Pages Utilisateurs (Index, Create)

#### En cours

- Complétion du CRUD matériels (Edit, Show)
- Gestion des photos de matériel
- Interface de gestion des catégories

### [0.1.0] - 05/02/2026

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

1. **Finaliser le système de Commandes/Location**
    - Page Show pour les commandes avec détails complets
    - Implémenter le calendrier de disponibilité
    - Système de validation des dates de location
    - Calcul automatique des tarifs selon durée
    - Processus de checkout complet
    - Confirmation par email

2. **Compléter le module Facturation**
    - Génération automatique de factures PDF
    - Liaison automatique facture ↔ commande
    - Interface de consultation et recherche de factures
    - Gestion des devis
    - Système de numérotation des factures

3. **Finaliser la gestion des Photos**
    - Upload multiple de photos pour matériel
    - Galerie responsive avec lightbox
    - Réorganisation par drag & drop
    - Optimisation automatique et thumbnails
    - Définir photo principale

4. **Améliorer l'UX globale**
    - Messages flash (succès/erreur) cohérents
    - Loaders et indicateurs pendant les requêtes
    - Confirmations modales pour suppressions
    - Pagination sur toutes les listes
    - Système de recherche global

5. **Tests et Qualité**
    - Implémenter tests unitaires (Pest)
    - Tests de fonctionnalités pour CRUD principaux
    - Validation des règles métier
    - Tests d'intégration pour le panier

---

**Note :** Ce document doit être mis à jour régulièrement pour refléter l'état actuel du projet.
