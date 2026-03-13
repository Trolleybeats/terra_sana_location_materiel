# 📋 Suivi du Projet - Terra Sana Location Matériel

**Dernière mise à jour :** 12 mars 2026  
**Version :** 0.6.0 (Phase 1 complétée, Phases 2 et 3 en cours)  
**Statut :** Développement avancé

---

## 📊 Vue d'ensemble du projet

### Description

Application web de gestion de location de matériel pour Terra Sana, permettant la gestion des utilisateurs (particuliers et professionnels) avec un système d'authentification sécurisé.

### Technologies utilisées

- **Backend :** Laravel 12.0 (PHP 8.2+)
- **Frontend :** Vue.js 3.5 + Inertia.js 2.3 + TypeScript 5.2
- **Authentification :** Laravel Fortify 1.30 (2FA activé)
- **UI Components :** Reka UI 2.6 + class-variance-authority
- **Styling :** Tailwind CSS v4.1 + Lucide Icons
- **Build :** Vite 7.0
- **Base de données :** MySQL/MariaDB
- **Tests :** Pest PHP 4.3
- **Qualité code :** ESLint 9.17 + Prettier 3.4 + Laravel Pint 1.24
- **Utilitaires :** VueUse 12.8, Wayfinder 0.1.9
- **PDF :** DomPDF 3.1 (génération factures)

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

**Pages principales**

- [x] Page d'accueil (Welcome)
- [x] Dashboard

**Pages CRUD**

- [x] Particuliers : Create, Show, Edit (3/3)
- [x] Professionnels : Create, Show, Edit (3/3)
- [x] Matériels : Index, Create, Edit, Show (4/4)
- [x] Utilisateurs : Index, Create
- [x] Commandes : Index, Create (2/4)
- [x] Factures : Index, Create, Show (3/4)
- [x] Contact Pro : Create, Edit (2/4)

**Pages d'authentification (7 pages)**

- [x] Login (connexion)
- [x] Register (inscription)
- [x] ForgotPassword (mot de passe oublié)
- [x] ResetPassword (réinitialisation)
- [x] ConfirmPassword (confirmation)
- [x] VerifyEmail (vérification email)
- [x] TwoFactorChallenge (défi 2FA)

**Pages Settings (4 pages)**

- [x] Profile (gestion du profil utilisateur)
- [x] Password (changement de mot de passe)
- [x] TwoFactor (authentification à deux facteurs)
- [x] Appearance (préférences d'affichage)

**Infrastructure UI**

- [x] Layouts : AppLayout, AuthLayout (+ 3 variantes auth)
- [x] 126+ composants réutilisables Vue
- [x] Système de navigation avec Inertia.js + Wayfinder
- [x] Breadcrumbs automatiques
- [x] Thèmes et apparence personnalisables

**Bibliothèques UI et composants intégrés**

- [x] Reka UI 2.6 (composants headless Vue)
- [x] Lucide Vue Next 0.468 (icônes)
- [x] class-variance-authority (variantes de composants)
- [x] tailwind-merge + clsx (gestion des classes)
- [x] tw-animate-css (animations Tailwind)
- [x] VueUse 12.8 (composables utilitaires)
- [x] vue-input-otp (input OTP pour 2FA)

#### Configuration & Outils

- [x] Configuration ESLint 9.17 + TypeScript 5.2
- [x] Configuration Prettier 3.4 avec plugin Tailwind
- [x] Configuration Tailwind CSS v4.1
- [x] Configuration Vite 7.0 avec support SSR
- [x] Laravel Pint 1.24 pour formatage PHP
- [x] Scripts npm : dev, build, build:ssr, lint, format
- [x] Wayfinder 0.1.9 pour routing automatique
- [x] DomPDF 3.1 pour génération PDF des factures

---

## 🚧 En cours de développement

### Priorité haute

- [ ] **Finaliser le module Commandes**
    - Page Edit pour les commandes
    - Validation complète du panier
    - Gestion des dates de location (début/fin)
    - Calcul automatique des tarifs selon durée
    - Processus de checkout complet
    - Confirmation et suivi de statut

- [ ] **Compléter le module Facturation**
    - Page Edit pour les factures
    - Améliorer la génération automatique de factures
    - Personnalisation du design PDF
    - Liaison automatique facture ↔ commande
    - Système de numérotation automatique
    - Envoi par email

- [ ] **Améliorer le système de gestion des photos**
    - Améliorer l'upload multiple de photos
    - Optimiser la galerie pour chaque matériel
    - Génération automatique de thumbnails
    - Réorganisation des photos par drag & drop
    - Définir une photo principale

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

### Phase 1 - Gestion du matériel (✅ COMPLÉTÉE - 09/02-12/03/2026)

- [x] Modèle Materiel
- [x] Modèle Categorie_materiel
- [x] Modèle Contact_pro
- [x] Modèle Fonction
- [x] Modèle Photo_materiel
- [x] Migrations et factories
- [x] Controllers CRUD complets
- [x] Pages Index, Create, Edit et Show pour matériels ✅
- [x] Page Show pour matériel (avec galerie photos) ✅
- [x] Gestion de l'inventaire de base
- [x] Upload et gestion des photos de base ✅
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
- [x] Pages Index, Create et Show des factures ✅
- [x] Génération PDF des factures (DomPDF) ✅
- [x] Route de téléchargement PDF ✅
- [ ] Envoi par email
- [ ] Reporting financier
- [ ] Tableau de bord financier

### Phase 4 - Fonctionnalités avancées (📋 PLANIFIÉE)

- [ ] Notifications par email/SMS
- [ ] Système de notes et commentaires
- [ ] Contrats numériques de location
- [ ] Statistiques avancées et tableaux de bord

---

## 🐛 Bugs connus

### Critiques

_Aucun bug critique identifié pour le moment_

### Mineurs

- [ ] À documenter au fur et à mesure des tests

### 📌 Observations importantes

**Points à noter**

- Le système de galerie photos pour matériels est implémenté en version de base (peut être amélioré)
- Aucun test automatisé n'est encore en place
- La génération PDF des factures est fonctionnelle mais peut être personnalisée davantage

**Décisions techniques prises**

- ✅ Bibliothèque PDF : DomPDF 3.1 choisie et installée
- ✅ Galerie photos matériels : Implémentation de base complétée

**Décisions techniques en attente**

- Stratégie de stockage des photos (local, cloud S3)
- Implémentation du calendrier de disponibilité (bibliothèque à choisir)
- Système de pagination à standardiser (nombre d'éléments par page)
- Design et branding des PDF (logo, couleurs, mise en page)

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

**Routes publiques**

- `/` - Page d'accueil (Welcome)
- `/login` - Connexion
- `/register` - Inscription
- `/forgot-password` - Mot de passe oublié
- `/reset-password` - Réinitialisation mot de passe

**Routes authentifiées**

- `/dashboard` - Tableau de bord principal
- `/utilisateurs/*` - Gestion des utilisateurs (Index, Create)
- `/particuliers/*` - Gestion des particuliers (Create, Show, Edit)
- `/professionnels/*` - Gestion des professionnels (Create, Show, Edit)
- `/materiels/*` - Gestion des matériels (Index, Create, Edit, Show)
- `/contact_pro/*` - Gestion des contacts pros (Create, Edit)
- `/commandes/*` - Gestion des commandes/locations (Index, Create)
- `/factures/*` - Gestion des factures (Index, Create, Show)
- `GET /factures/{id}/download-pdf` - Téléchargement PDF facture

**Routes panier (authentifiées)**

- `POST /panier/ajouter` - Ajouter un article au panier
- `DELETE /panier/{detail}` - Retirer un article du panier
- `PUT /panier/{detail}` - Mettre à jour la quantité
- `DELETE /panier` - Vider le panier

**Routes settings (authentifiées)**

- `/settings/profile` - Gestion du profil
- `/settings/password` - Changement de mot de passe
- `/settings/two-factor` - Configuration 2FA
- `/settings/appearance` - Préférences d'apparence

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

#Lancer Laravel en mode dev
composer run dev

# Lancer les tests avec Pest
php artisan test
# ou
./vendor/bin/pest

# Vérifier le code (linting)
npm run lint

# Formater le code
npm run format
./vendor/bin/pint
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

- [Laravel 12.x](https://laravel.com/docs/12.x)
- [Vue.js 3](https://vuejs.org/)
- [Inertia.js](https://inertiajs.com/)
- [Tailwind CSS v4](https://tailwindcss.com/)
- [Reka UI](https://reka-ui.com/)
- [VueUse](https://vueuse.org/)

### Environnement de développement

- **Serveur local :** Laragon
- **Chemin projet :** c:\laragon\www\terra_sana_location_materiel

---

## 📈 Métriques

### Code

**Backend (PHP/Laravel)**

- Contrôleurs : 22 (+ groupe Settings)
- Modèles Eloquent : 24
- Migrations : 27 tables
- Factories : 24
- Seeders : 25 (dont DatabaseSeeder)
- Routes : 7 groupes de ressources + 4 routes panier

**Frontend (Vue.js/TypeScript)**

- Pages Vue : 27+ (auth, crud, settings, etc.)
- Composants réutilisables : 140+
- Composants UI : 20+ bibliothèques (alert, avatar, badge, button, card, etc.)
- Layouts : 5 (AppLayout, AuthLayout + variantes)
- Types TypeScript : Fortement typé
- Actions Inertia : Navigation optimisée

### Tests

- Tests unitaires : À implémenter
- Tests de fonctionnalités : À implémenter
- Couverture de code : À mesurer

---

## ✏️ Journal des modifications

### [0.6.0] - 12/03/2026

#### Vue d'ensemble

✅ **Complétion majeure : Phase 1 terminée !** Le module de gestion du matériel est maintenant complet avec toutes les pages CRUD implémentées. Avancée significative sur la facturation avec génération PDF fonctionnelle.

#### Ajouté

- **✅ Page Show des Matériels (COMPLET)**
    - Affichage détaillé du matériel avec toutes les informations
    - Galerie de photos intégrée
    - Navigation vers les actions Edit
    - CRUD Matériels maintenant 4/4 pages ✅

- **✅ Page Show des Factures**
    - Affichage détaillé de la facture
    - Visualisation des lignes de facturation
    - Informations client et statut
    - Lien de téléchargement PDF
    - CRUD Factures maintenant 3/4 pages

- **✅ Génération PDF des Factures**
    - Installation et configuration de DomPDF 3.1
    - Route `/factures/{id}/download-pdf` pour téléchargement
    - Génération de factures au format PDF
    - Méthode `downloadPdf` dans FactureController

- **Bibliothèques et outils**
    - Integration DomPDF 3.1 (barryvdh/laravel-dompdf)
    - Configuration pour génération de documents PDF

#### Complété

- ✅ **Phase 1 - Gestion du matériel (100% COMPLÈTE)**
    - Toutes les pages CRUD pour matériels finalisées
    - Système de galerie photos fonctionnel
    - Module matériel entièrement opérationnel

#### Amélioré

- Documentation du projet mise à jour avec statuts précis
- Clarification des fonctionnalités implémentées vs. à venir
- Métriques du code actualisées

#### Priorités mises à jour

1. Finaliser les pages Edit manquantes (Commandes, Factures)
2. Améliorer la personnalisation des PDF (design, branding)
3. Implémenter le calendrier de disponibilité des matériels
4. Améliorer le système de galerie photos (drag & drop, optimisation)

### [0.5.0] - 26/02/2026

#### Vue d'ensemble

Consolidation complète des modules avec mise à jour majeure de la documentation projet. Inventaire précis des fonctionnalités implémentées et identification claire des éléments manquants pour compléter les CRUD.

#### Ajouté

- **Documentation détaillée**
    - Inventaire complet des 126+ composants Vue
    - Liste précise des 25+ pages implémentées avec statut CRUD
    - Identification des pages manquantes (Index, Show, Edit)
    - Mise à jour des versions technologiques (Laravel 12.0, Vue 3.5, Vite 7.0)
    - Métriques précises du code (backend + frontend)
    - Liens de documentation mis à jour (Reka UI, VueUse)

- **Interface Facturation**
    - Page Index des factures (consultation liste)
    - Page Create pour nouvelle facture
    - Navigation et routing pour module factures

- **Pages Settings complètes (4 pages)**
    - Page Profile (gestion du profil utilisateur)
    - Page Password (changement de mot de passe)
    - Page TwoFactor (authentification à deux facteurs)
    - Page Appearance (préférences d'affichage)
    - Layout dédié pour les paramètres

- **Pages d'authentification complètes (7 pages)**
    - Login, Register, ForgotPassword, ResetPassword
    - ConfirmPassword, VerifyEmail, TwoFactorChallenge
    - 3 layouts d'authentification (Simple, Split, Card)

#### Identifié à compléter

- **Pages Show manquantes** : Matériels (avec galerie)

#### Priorités définies

3. Implémentation de la génération PDF pour factures
4. Système de galerie photos pour matériels

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

1. **Compléter les pages Edit manquantes**
    - Page Edit pour les factures
    - Page Edit pour les commandes

2. **Finaliser le système de Commandes/Location**
    - Implémenter le calendrier de disponibilité
    - Système de validation des dates de location
    - Calcul automatique des tarifs selon durée
    - Processus de checkout complet
    - Confirmation par email

3. **Compléter le module Facturation**
    - Génération automatique de factures PDF
    - Liaison automatique facture ↔ commande
    - Gestion des devis
    - Système de numérotation automatique des factures

4. **Finaliser la gestion des Photos**
    - Upload multiple de photos pour matériel
    - Galerie responsive avec lightbox
    - Réorganisation par drag & drop
    - Optimisation automatique et thumbnails
    - Définir photo principale

5. **Améliorer l'UX globale**
    - Messages flash (succès/erreur) cohérents
    - Loaders et indicateurs pendant les requêtes
    - Confirmations modales pour suppressions
    - Pagination sur toutes les listes
    - Système de recherche global

6. **Tests et Qualité**
    - Implémenter tests unitaires (Pest)
    - Tests de fonctionnalités pour CRUD principaux
    - Validation des règles métier
    - Tests d'intégration pour le panier

---

**Note :** Ce document doit être mis à jour régulièrement pour refléter l'état actuel du projet.
