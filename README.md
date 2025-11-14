# MasterMentor

Site vitrine moderne pour accompagnement académique destiné aux étudiants en Master 2.

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

**Upload FTP** :

1. Uploader tous les fichiers sur le serveur
2. Configurer `.htaccess` pour compression gzip et cache
3. Vérifier certificat SSL (HTTPS)
4. Tester sur mobile/tablette/desktop

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

### Tests Performance (Lighthouse)

- **Performance** : 85-92
- **Accessibility** : 90+
- **Best Practices** : 90+
- **SEO** : 85+

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

## 🤝 Contribution

Projet privé. Contact : Voir propriétaire du repository.

## 📝 Changelog

### Version 1.1 (Nov 2025) - MM-5 v2.1

- ✅ **MM-5 v2.1** : Validation téléphone internationale (tous pays, fixes + mobiles)
  - Regex flexible : `/^[0-9\s\+\-\.\(\)]{8,20}$/`
  - Support formats : +33, +1, 01, 06, (555) 123-4567, etc.
  - Validation côté client (main.js) + serveur (contact.php) synchronisées

### Version 1.0 (Nov 2025)

- ✅ MM-2 : Configuration assets (images optimisées, favicons)
- ✅ MM-6 : Nettoyage code (CSS/JS externalisés, minifiés)
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
