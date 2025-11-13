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
├── assets/
│   ├── css/
│   │   ├── styles.css                  # CSS principal
│   │   ├── styles.min.css              # Version minifiée
│   │   ├── tarifs.css                  # CSS page tarifs
│   │   ├── charte.css                  # CSS page charte
│   │   └── popup-demo.css              # CSS popup démo
│   ├── js/
│   │   ├── main.js                     # Core UI (formulaire, animations, menu)
│   │   ├── main.min.js                 # Version minifiée
│   │   ├── quiz.js                     # Module quiz interactif
│   │   └── quiz.min.js                 # Version minifiée
│   ├── images/                         # Images optimisées (WebP + JPEG)
│   ├── icons/                          # Favicons multi-plateformes
│   └── logos/                          # Logos et branding
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
- **Formulaire de contact** : Validation côté client
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
- ✅ Validation formulaire côté client
- ✅ Protection CSRF (à implémenter backend)

## 📊 Statistiques Projet

- **4 pages HTML** (index, tarifs, popup-demo, charte)
- **4 fichiers CSS** + versions minifiées
- **2 modules JavaScript** (main.js, quiz.js) + versions minifiées
- **168 lignes .gitignore** (11 catégories protégées)
- **~1435 lignes** index.html (optimisé -22%)
- **11.2K JavaScript** minifié total
- **32K CSS** minifié total

## 🤝 Contribution

Projet privé. Contact : Voir propriétaire du repository.

## 📝 Changelog

### Version 1.0 (Nov 2025)
- ✅ MM-2 : Configuration assets (images optimisées, favicons)
- ✅ MM-6 : Nettoyage code (CSS/JS externalisés, minifiés)
- ✅ MM-6.14 : Menu burger mobile (fix UX critique)
- ✅ .gitignore complet
- ⏳ MM-3 : SEO & Performance (à venir)

## 📄 License

Tous droits réservés © 2024

---

**Site vitrine moderne, performant et accessible.** 🚀
