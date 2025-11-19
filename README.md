# MasterMentor

[![Live](https://img.shields.io/badge/Live-mastermentor.fr-brightgreen?style=for-the-badge&logo=google-chrome)](https://mastermentor.fr)
[![Status](https://img.shields.io/badge/Status-En%20Production-success?style=for-the-badge)](https://mastermentor.fr)
[![SSL](https://img.shields.io/badge/SSL-Let's%20Encrypt-blue?style=for-the-badge&logo=letsencrypt)](https://mastermentor.fr)
[![W3C](https://img.shields.io/badge/W3C-100%25%20Valid-green?style=for-the-badge&logo=w3c)](https://validator.w3.org/)
[![PageSpeed](https://img.shields.io/badge/PageSpeed-100%2F100%2F100-success?style=for-the-badge&logo=googlechrome&logoColor=white)](https://pagespeed.web.dev/)

Site vitrine moderne pour accompagnement académique destiné aux étudiants en Master 2.

**🌐 Site en ligne** : [https://mastermentor.fr](https://mastermentor.fr)

## 🎯 Objectif

Plateforme web présentant des services d'accompagnement méthodologique pour la rédaction de mémoires universitaires.

## 🛠️ Stack Technique

- **HTML5** sémantique et accessible
- **CSS3** moderne (variables CSS, animations, responsive)
- **JavaScript ES6+** (Vanilla, modules externes)
- **Performance** : Fichiers minifiés, lazy loading, cache optimisé

## 📁 Structure du Projet

```
master_mentor/
├── index.html                          # Page d'accueil
├── tarifs.html                         # Page tarifs
├── popup-demo.html                     # Démo popup
├── Charte-Integrite-Academique.html    # Page charte
├── contact.php                         # Backend formulaire (sécurisé)
├── merci.html                          # Page confirmation après soumission
├── assets/
│   ├── css/
│   │   ├── styles.css                  # CSS principal
│   │   ├── styles.min.css              # Version minifiée
│   │   ├── integrations.css            # CSS intégrations externes
│   │   ├── integrations.min.css        # Version minifiée
│   │   ├── tarifs.css                  # CSS page tarifs
│   │   ├── charte.css                  # CSS page charte
│   │   └── popup-demo.css              # CSS popup démo
│   ├── js/
│   │   ├── main.js                     # Core UI (formulaire AJAX, animations, menu)
│   │   ├── main.min.js                 # Version minifiée
│   │   ├── quiz.js                     # Module quiz interactif
│   │   └── quiz.min.js                 # Version minifiée
│   ├── images/                         # Images optimisées (WebP + JPEG)
│   ├── icons/                          # Favicons multi-plateformes
│   └── logos/                          # Logos et branding
├── docs/                               # Documentation technique
│   ├── MM-4-Integrations-externes.md
│   └── MM-5-Formulaire-contact-FormSubmit.md
├── .gitignore                          # Fichiers exclus du versioning
└── README.md                           # Documentation
```

## ✨ Fonctionnalités

### 🎨 Design & UX

- **Design moderne** : Interface épurée et professionnelle
- **Responsive** : Optimisé mobile/tablette/desktop
- **Menu burger** : Navigation mobile avec overlay
- **Animations** : Transitions fluides au scroll (Intersection Observer)
- **Smooth scroll** : Défilement doux vers les ancres

### 📊 Modules Interactifs

- **Quiz** : Quiz de 6 questions avec feedback et résultats
- **Formulaire de contact** : Validation côté client + serveur, envoi AJAX, backend PHP sécurisé
- **Popup urgence** : Déclenchement automatique (timer, scroll, exit intent)
- **FAQ** : Accordéon interactif

### ⚡ Performance

- **CSS minifié** : 40K → 32K (-20%)
- **JavaScript minifié** : 19.1K → 12.1K (-36%)
- **Images optimisées** : 2.98MB → 750KB (-75%)
- **Cache navigateur** : Headers optimisés
- **Lazy loading** : Images chargées à la demande

### ♿ Accessibilité

- **HTML sémantique** : Structure claire (header, nav, main, section, footer)
- **ARIA labels** : Attributs pour lecteurs d'écran
- **Navigation clavier** : Support complet (Tab, Enter, Escape)
- **Contraste** : Respect WCAG 2.1 niveau AA
- **Alt text** : Descriptions images pour accessibilité

## 🚀 Installation & Utilisation

### Prérequis

- Serveur web (Apache, Nginx) ou Live Server
- Navigateur moderne (Chrome, Firefox, Safari, Edge)

### Lancement Local

**Option 1 : Serveur local simple (Python)**

```bash
# Python 3
python3 -m http.server 8000

# Ouvrir http://localhost:8000
```

**Option 2 : Live Server (VSCode)**

```bash
# Installer Live Server extension
# Clic droit sur index.html → "Open with Live Server"
```

**Option 3 : Serveur PHP**

```bash
php -S localhost:8000
```

### Production

**✅ Site déployé en production** : https://mastermentor.fr

**Environnement** :

- **Hébergement** : OVH Mutualisé (Cluster 121)
- **Serveur** : ftp.cluster121.hosting.ovh.net
- **SSL** : Let's Encrypt (actif)
- **Compression** : Gzip activé
- **Cache** : Headers optimisés (1 an images)

**Déploiement** :

1. Upload via SFTP (lftp mirror -R)
2. Configuration multisite OVH
3. Certificat SSL Let's Encrypt
4. Redirection HTTP → HTTPS automatique
5. Tests production validés

## 🧪 Tests

### Tests Fonctionnels

- ✅ Navigation (menu burger mobile, liens ancres)
- ✅ Formulaire de contact
- ✅ Quiz interactif (6 questions + résultats)
- ✅ Popup urgence (déclenchements multiples)
- ✅ Animations au scroll

### Tests Responsive

- ✅ Mobile (320px - 767px)
- ✅ Tablette (768px - 1023px)
- ✅ Desktop (1024px+)

### Tests Cross-Browser

- ✅ Chrome / Edge
- ✅ Firefox
- ✅ Safari (macOS / iOS)

### Tests Performance (PageSpeed Insights)

**🏆 Scores Parfaits - Version 1.4 (15 Nov 2025)**

**Mobile** :

- ✅ **Performance** : 100/100
- ✅ **Accessibilité** : 100/100
- ✅ **Bonnes pratiques** : 100/100
- ✅ **SEO** : 100/100

**Desktop** :

- ✅ **Performance** : 100/100
- ✅ **Accessibilité** : 100/100
- ✅ **Bonnes pratiques** : 100/100
- ✅ **SEO** : 100/100

**Optimisations clés** :

- CLS < 0.1 (min-height hero, layout stability)
- Contraste WCAG AA (#4b5563)
- Landmark sémantique `<main>`
- CSS critique inline + lazy loading
- Images optimisées WebP + preload
- YouTube facade (lazy iframe)
- RequestAnimationFrame scroll
- Compression Gzip + Cache 1 an

## 📦 Build & Optimisation

### Minification CSS

```bash
# Minification avec Python
python3 -c "import re; css = open('assets/css/styles.css').read(); [...] open('assets/css/styles.min.css', 'w').write(css)"
```

### Minification JavaScript

```bash
# Minification avec Terser (npm)
npm install terser
npx terser assets/js/main.js -o assets/js/main.min.js -c -m
npx terser assets/js/quiz.js -o assets/js/quiz.min.js -c -m
```

## 🔒 Sécurité

- ✅ `.gitignore` configuré (secrets, credentials, .env)
- ✅ Pas de données sensibles dans le code
- ✅ Validation formulaire côté client + serveur (double validation)
- ✅ Sanitization XSS (htmlspecialchars ENT_QUOTES)
- ✅ Rate limiting (1 envoi/minute par IP)
- ✅ Honeypot anti-bots (champ caché)
- ✅ Headers sécurisés (X-Frame-Options, X-XSS-Protection)
- ✅ Protection CSRF (basique, à améliorer)

## 📊 Statistiques Projet

- **6 pages HTML/PHP** (index, tarifs, popup-demo, charte, merci, contact.php)
- **5 fichiers CSS** + versions minifiées (styles, integrations, tarifs, charte, popup)
- **2 modules JavaScript** (main.js, quiz.js) + versions minifiées
- **168 lignes .gitignore** (11 catégories protégées)
- **~1435 lignes** index.html (optimisé -22%)
- **241 lignes** contact.php (backend sécurisé)
- **220 lignes** merci.html (page confirmation)
- **7.6K JavaScript** main.js (3.7K minifié)
- **36K CSS** minifié total
- **906 lignes** documentation MM-5

## 📝 Changelog

### Version 1.5 (19 Nov 2025) - 🔧 CORRECTIONS RETOUR CLIENT ✅

- ✅ **MM-19** : Quiz interactif corrigé
  - **Problème** : Quiz ne fonctionnait pas (script non chargé)
  - **Cause racine** : `requestIdleCallback` s'exécutait après `DOMContentLoaded`, empêchant l'initialisation
  - **Solution** : Chargement direct avec `<script defer>` au lieu du lazy loading complexe
  - Correction du sélecteur `.quiz-container` → `.quiz-container-embedded`

- ✅ **MM-20** : Popup CTA restauré
  - **Problème** : Popup n'apparaissait plus
  - **Cause** : Code popup dans quiz.js qui ne se chargeait pas
  - **Modifications** :
    - Timer réduit : 15s → 5s
    - Suppression localStorage : popup à chaque visite (demande client)
    - Triggers conservés : timer 5s, exit intent, scroll 50%

- ✅ **MM-21** : Vidéo YouTube mise à jour
  - Ancien ID : `K8LmYdEqHrc`
  - Nouveau ID : `zxiQNT0CwK0`
  - Facade lazy loading préservée

- ✅ **MM-18** : Suppression mentions écoles témoignages
  - Sarah M. : Paris Dauphine supprimé
  - Thomas L. : Lyon 2 supprimé
  - Antoine L. : HEC Paris supprimé
  - Seul le niveau d'études conservé (Master 2 + spécialité)

- ✅ **MM-16** : Favicon fond transparent
  - 5 fichiers régénérés avec ImageMagick
  - favicon.ico (16/32/48px), favicon-192.png, favicon-512.png, apple-touch-icon.png
  - Fond blanc supprimé sur tous les formats

### Version 1.4 (15 Nov 2025) - 🏆 PERFECTION PAGESPEED 100/100 ✅

- ✅ **MM-11 Phase 6** : Correction CLS Desktop + Accessibilité 100%
  - **Résultats** : Mobile 100/100/100 | Desktop 100/100/100
  - CLS Fix : `min-height: 700px` (desktop), `min-height: 500px` (mobile)
  - Layout stability : `display: flex; flex-direction: column; justify-content: center;`
  - Contraste WCAG AA : `--gray: #6b7280` → `#4b5563` (ratio 4.5:1)
  - Landmark sémantique : `<section class="hero">` → `<main class="hero">`
  - CSS critique inline mis à jour avec min-height
  - **Performance Desktop** : 76 → 100 (+24 points)
  - **Performance Mobile** : 94 → 100 (+6 points)
  - **Accessibilité Desktop** : 94 → 100 (+6 points)
  - Documentation : [docs/MM-11-Optimisation-Performance.md](docs/MM-11-Optimisation-Performance.md)

### Version 1.3 (15 Nov 2025) - 🚀 PRODUCTION LIVE ✅

- ✅ **MM-8** : Déploiement Production OVH

  - Site accessible : https://mastermentor.fr
  - 61 fichiers uploadés (~200 KB optimisés)
  - SSL Let's Encrypt actif (HTTPS)
  - Configuration multisite OVH complète
  - Compression Gzip + Cache navigateur actifs
  - Documentation : [docs/MM-8-Deploiement-OVH.md](docs/MM-8-Deploiement-OVH.md)

- ✅ **MM-7** : Tests Production Validés

  - Tests accessibilité (HTTPS, SSL, redirections)
  - Tests fonctionnels (formulaire, quiz, navigation)
  - Tests responsive (mobile/tablette/desktop)
  - Tests SEO (robots.txt, sitemap.xml)

- 🆕 **MM-10** : Configuration Email Anti-Spam (En cours)
  - Headers email améliorés (Message-ID, List-Unsubscribe)
  - Configuration DNS DKIM/DMARC à finaliser
  - Documentation : [docs/MM-9-Configuration-Email-Anti-Spam.md](docs/MM-9-Configuration-Email-Anti-Spam.md)

### Version 1.2 (14 Nov 2025) - MM-6 ✅

- ✅ **MM-6** : Validation W3C & Nettoyage Code Final
  - 5 fichiers HTML validés : 100% conforme W3C HTML5
  - Correction meta refresh (merci.html) : ajout espace après `;`
  - Externalisation CSS merci.html (3.4K → 2.4K minifié, -29.9%)
  - Documentation complète : [docs/MM-6-Validation-W3C.md](docs/MM-6-Validation-W3C.md)
  - Rapport détaillé : 0 erreur, 1 avertissement mineur total

### Version 1.1 (Nov 2025) - MM-5 v2.1

- ✅ **MM-5 v2.1** : Validation téléphone internationale (tous pays, fixes + mobiles)
  - Regex flexible : `/^[0-9\s\+\-\.\(\)]{8,20}$/`
  - Support formats : +33, +1, 01, 06, (555) 123-4567, etc.
  - Validation côté client (main.js) + serveur (contact.php) synchronisées

### Version 1.0 (Nov 2025)

- ✅ MM-2 : Configuration assets (images optimisées, favicons)
- ✅ MM-6.14 : Menu burger mobile (fix UX critique)
- ✅ .gitignore complet
- ✅ MM-3 : SEO & Performance (Meta tags, Open Graph, JSON-LD Schema.org)
- ✅ MM-4 : Intégrations externes (Google Analytics, Trustpilot, Fnac)
- ✅ **MM-5 v2.0** : Migration PHP Custom (voir [docs/MM-5-Formulaire-contact-FormSubmit.md](docs/MM-5-Formulaire-contact-FormSubmit.md))
  - Backend PHP sécurisé (`contact.php` - 241 lignes)
  - Page confirmation custom (`merci.html` - 220 lignes)
  - Validation serveur complète + Sanitization XSS
  - Rate limiting (1 envoi/min par IP)
  - Honeypot anti-bots
  - Email HTML professionnel responsive
  - Email confirmation automatique client
  - Zéro dépendance externe (abandon FormSubmit.co)
