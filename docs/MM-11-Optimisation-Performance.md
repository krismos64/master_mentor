# MM-11 : Plan d'Optimisation Performance - MasterMentor

**Date** : 15 novembre 2025
**Version** : 1.0
**Site** : https://mastermentor.fr
**Objectif** : Passer de 58/49 à 90+ Performance (Desktop/Mobile)

---

## 📊 État Actuel - PageSpeed Insights (15 nov 2025)

### Scores Lighthouse

| Critère | Desktop | Mobile | Objectif | Écart |
|---------|---------|--------|----------|-------|
| **Performance** | 🟠 58/100 | 🔴 49/100 | 🟢 90+ | -32 / -41 |
| **Accessibilité** | 🟢 94/100 | 🟢 94/100 | 🟢 95+ | -1 |
| **Bonnes pratiques** | 🟠 77/100 | 🟠 77/100 | 🟢 90+ | -13 |
| **SEO** | 🟢 100/100 | 🟢 100/100 | 🟢 100 | ✅ |

### Core Web Vitals

#### Desktop

| Métrique | Valeur | Cible | Statut | Écart |
|----------|--------|-------|--------|-------|
| **FCP** (First Contentful Paint) | 1,7s | <1,8s | 🟢 | +5% |
| **LCP** (Largest Contentful Paint) | 2,3s | <2,5s | 🟢 | +8% |
| **TBT** (Total Blocking Time) | 520ms | <200ms | 🔴 | +160% |
| **CLS** (Cumulative Layout Shift) | 0 | <0,1 | 🟢 ✅ | Parfait |
| **SI** (Speed Index) | 1,7s | <3,4s | 🟢 | +8% |

#### Mobile

| Métrique | Valeur | Cible | Statut | Écart |
|----------|--------|-------|--------|-------|
| **FCP** | 8,6s | <1,8s | 🔴 | **+379%** |
| **LCP** | 10,4s | <2,5s | 🔴 | **+316%** |
| **TBT** | 350ms | <200ms | 🔴 | +75% |
| **CLS** | 0 | <0,1 | 🟢 ✅ | Parfait |
| **SI** | 8,6s | <3,4s | 🔴 | +153% |

---

## 🚨 Problèmes Identifiés par Lighthouse

### 🔴 Critiques (Impact majeur sur Performance)

1. **JavaScript inutilisé** : 543 Kio (desktop) / 750 Kio (mobile)
2. **CSS inutilisé** : 57 Kio (desktop) / 90 Kio (mobile)
3. **Images sans dimensions** : Tous les `<img>` sans `width`/`height`
4. **Tâches longues thread principal** : 6 tâches (desktop) / 5 tâches (mobile)
5. **Requêtes bloquant rendu** : 40ms économisables
6. **Amélioration affichage images** : 57 Kio (desktop) / 31 Kio (mobile)

### 🟠 Moyens (Impact modéré)

7. **Animations non composées** : 1 élément (force layout)
8. **Taille DOM élevée** : À mesurer
9. **Cache navigateur** : 1 Kio optimisable

### ♿ Accessibilité

10. **Contraste couleurs insuffisant** : Certains textes < 4.5:1
11. **Absence repère `<main>`** : Landmark manquant

### 🛡️ Bonnes Pratiques

12. **Cookies tiers** : 3-4 cookies (GA4, Trustpilot)
13. **CSP manquant** : Pas de Content-Security-Policy
14. **HSTS manquant** : Pas de Strict-Transport-Security
15. **COOP manquant** : Pas de Cross-Origin-Opener-Policy
16. **Trusted Types manquant** : Protection XSS DOM

---

## 🎯 Plan d'Action Détaillé (5 Phases)

### 🔥 PHASE 1 : OPTIMISATIONS CRITIQUES

**Objectif** : +40-55 points Performance
**Durée** : 4-6 heures
**Impact** : Desktop 58→98, Mobile 49→84

---

#### 1.1 Images : Optimisation Complète ⭐⭐⭐⭐⭐

**Problème** :
- Aucune image n'a `width` et `height` explicites → CLS risque
- 57 Kio desktop / 31 Kio mobile économisables
- Image hero bloque LCP (Largest Contentful Paint)
- Pas de lazy loading sur images hors viewport

**Gains estimés** : +15-20 points Performance, -2s LCP mobile

---

##### A. Ajouter width/height à TOUTES les images

**Checklist** :

- [ ] **index.html** : Ajouter `width` et `height` à toutes les images
  - [ ] Image hero (hero-400/800/1200.webp)
  - [ ] Image team (team-800.webp)
  - [ ] Image livre (livre.webp)
  - [ ] Logo Trustpilot (si `<img>`)
  - [ ] Toute autre image présente

- [ ] **tarifs.html** : Ajouter dimensions si images présentes

- [ ] **Charte-Integrite-Academique.html** : Ajouter dimensions si images présentes

**Code AVANT (❌)** :
```html
<img src="assets/images/hero/hero-800.webp" alt="Accompagnement Master 2">
```

**Code APRÈS (✅)** :
```html
<img
  src="assets/images/hero/hero-800.webp"
  alt="Accompagnement Master 2"
  width="800"
  height="600"
  loading="lazy"
  decoding="async">
```

---

##### B. Utiliser `<picture>` responsive pour image hero

**Checklist** :

- [ ] Remplacer `<img>` hero par `<picture>` avec 3 résolutions
- [ ] Mobile (320-767px) : hero-400.webp
- [ ] Tablette (768-1023px) : hero-800.webp
- [ ] Desktop (1024px+) : hero-1200.webp

**Code** :
```html
<picture class="hero-image">
  <!-- Mobile : 400px -->
  <source
    media="(max-width: 767px)"
    srcset="assets/images/hero/hero-400.webp"
    width="400"
    height="300">

  <!-- Tablette : 800px -->
  <source
    media="(min-width: 768px) and (max-width: 1023px)"
    srcset="assets/images/hero/hero-800.webp"
    width="800"
    height="600">

  <!-- Desktop : 1200px -->
  <img
    src="assets/images/hero/hero-1200.webp"
    alt="Accompagnement personnalisé Master 2"
    width="1200"
    height="900"
    fetchpriority="high"
    decoding="async">
</picture>
```

---

##### C. Précharger image hero (optimisation LCP)

**Checklist** :

- [ ] Ajouter `<link rel="preload">` pour image hero dans `<head>`
- [ ] Utiliser `fetchpriority="high"` sur image hero

**Code dans `<head>` (après meta tags)** :
```html
<head>
  <!-- Meta tags... -->

  <!-- Précharger image hero (LCP) -->
  <link
    rel="preload"
    as="image"
    href="assets/images/hero/hero-1200.webp"
    fetchpriority="high"
    media="(min-width: 1024px)">

  <link
    rel="preload"
    as="image"
    href="assets/images/hero/hero-800.webp"
    fetchpriority="high"
    media="(min-width: 768px) and (max-width: 1023px)">

  <link
    rel="preload"
    as="image"
    href="assets/images/hero/hero-400.webp"
    fetchpriority="high"
    media="(max-width: 767px)">
</head>
```

---

##### D. Lazy loading images hors viewport

**Checklist** :

- [ ] Ajouter `loading="lazy"` à toutes les images **SAUF** hero
- [ ] Ajouter `decoding="async"` pour décodage asynchrone

**Règle** :
- ✅ `loading="lazy"` : Images hors viewport initial (team, livre, footer, etc.)
- ❌ `loading="lazy"` : Image hero (LCP, doit charger immédiatement)

**Code** :
```html
<!-- ✅ Image hero : PAS de lazy -->
<img
  src="assets/images/hero/hero-1200.webp"
  width="1200"
  height="900"
  fetchpriority="high"
  decoding="async">

<!-- ✅ Image team : AVEC lazy -->
<img
  src="assets/images/team/team-800.webp"
  alt="Équipe MasterMentor"
  width="800"
  height="600"
  loading="lazy"
  decoding="async">

<!-- ✅ Image livre : AVEC lazy -->
<img
  src="assets/images/livre.webp"
  alt="Le Guide Ultime de la Rédaction"
  width="300"
  height="450"
  loading="lazy"
  decoding="async">
```

---

##### E. Optimiser format images (vérification)

**Checklist** :

- [ ] Vérifier que toutes les images sont en WebP (déjà fait ✅)
- [ ] Si images JPEG existent encore, les supprimer ou renommer en `.old`
- [ ] Vérifier tailles fichiers (hero-1200.webp < 100KB idéalement)

**Commande vérification** :
```bash
# Lister toutes les images et leurs tailles
ls -lh assets/images/**/*.{webp,jpg,jpeg,png} 2>/dev/null

# Vérifier taille hero
ls -lh assets/images/hero/
```

---

**🎯 Résultat Phase 1.1** :
- ✅ CLS reste à 0 (dimensions explicites)
- ✅ LCP réduit de ~2-3s (preload + fetchpriority)
- ✅ Lazy loading économise bande passante initiale
- **Gain** : +15-20 points Performance

---

#### 1.2 JavaScript Inutilisé : Réduction Drastique ⭐⭐⭐⭐⭐

**Problème** :
- 543 Kio (desktop) / 750 Kio (mobile) JS inutilisé
- Scripts tiers bloquent thread principal
- TBT élevé : 520ms desktop, 350ms mobile

**Gains estimés** : +15-20 points Performance, -300ms TBT

---

##### A. Identifier sources de JS inutilisé

**Checklist** :

- [ ] Ouvrir Chrome DevTools → Coverage
- [ ] Recharger page et analyser
- [ ] Noter fichiers avec % rouge élevé (> 50% inutilisé)
- [ ] Identifier scripts tiers (GA4, Trustpilot, etc.)

**Commande** :
```
Chrome DevTools (F12)
→ Cmd+Shift+P (macOS) / Ctrl+Shift+P (Windows)
→ Taper "Coverage"
→ Cliquer "Reload" (icône refresh)
→ Analyser colonne "Unused Bytes"
```

**Suspects probables** :
- Google Analytics (gtag.js) : ~50-100 Kio
- Trustpilot widget : ~50-100 Kio
- quiz.js chargé sur toutes les pages même si pas utilisé

---

##### B. Defer/Async scripts tiers

**Checklist** :

- [ ] Ajouter `defer` à Google Analytics
- [ ] Ajouter `defer` à Trustpilot (si script)
- [ ] Déplacer tous scripts en bas de `<body>` (avant `</body>`)

**Code AVANT (❌)** :
```html
<head>
  <!-- Meta tags... -->

  <!-- Google Analytics dans <head> = BLOQUANT -->
  <script src="https://www.googletagmanager.com/gtag/js?id=G-XXXXXXXXXX"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'G-XXXXXXXXXX');
  </script>
</head>
```

**Code APRÈS (✅)** :
```html
<head>
  <!-- Meta tags... -->
  <!-- Plus de scripts bloquants ici -->
</head>

<body>
  <!-- Contenu... -->

  <!-- Scripts en bas avec defer -->
  <script defer src="https://www.googletagmanager.com/gtag/js?id=G-XXXXXXXXXX"></script>
  <script defer>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'G-XXXXXXXXXX', {
      'anonymize_ip': true,
      'client_storage': 'none'  // Réduit cookies tiers
    });
  </script>

  <script defer src="assets/js/main.min.js"></script>
</body>
```

---

##### C. Charger quiz.js uniquement si nécessaire

**Checklist** :

- [ ] Vérifier si quiz.js est chargé sur toutes les pages
- [ ] Charger quiz.js dynamiquement uniquement si `.quiz-container` existe
- [ ] Supprimer `<script src="quiz.min.js">` global

**Code** :
```html
<!-- Dans index.html, juste avant </body> -->

<script>
  // Charger quiz.js UNIQUEMENT si quiz présent sur la page
  if (document.querySelector('.quiz-container')) {
    const script = document.createElement('script');
    script.src = 'assets/js/quiz.min.js';
    script.defer = true;
    document.body.appendChild(script);
  }
</script>
```

**Fichiers à modifier** :
- [ ] `index.html` : Ajouter chargement conditionnel quiz
- [ ] `tarifs.html` : Supprimer `<script src="quiz.min.js">` si présent
- [ ] `Charte-Integrite-Academique.html` : Idem

---

##### D. Code-splitting : Critical JS inline

**Checklist** :

- [ ] Créer `critical.js` avec fonctions essentielles (1-2K max)
- [ ] Inline `critical.js` dans `<script>` avant `</body>`
- [ ] Charger `main.min.js` en différé

**Fonctions critiques (à mettre inline)** :
- Menu burger toggle
- Smooth scroll ancres
- Gestion événements critiques

**Code `critical.js` (inline dans HTML)** :
```html
<script>
  // Critical JS inline (1-2K max)

  // Menu burger
  const menuToggle = document.querySelector('.menu-toggle');
  const navMenu = document.querySelector('.nav-menu');

  if (menuToggle && navMenu) {
    menuToggle.addEventListener('click', () => {
      navMenu.classList.toggle('active');
      document.body.classList.toggle('menu-open');
    });
  }

  // Smooth scroll
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
      e.preventDefault();
      const target = document.querySelector(this.getAttribute('href'));
      if (target) {
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }
    });
  });
</script>

<!-- Main JS en différé -->
<script defer src="assets/js/main.min.js"></script>
```

---

##### E. requestIdleCallback pour tracking

**Checklist** :

- [ ] Charger Google Analytics via `requestIdleCallback`
- [ ] Charger Trustpilot widget via `requestIdleCallback`
- [ ] Fallback `setTimeout` pour navigateurs anciens

**Code** :
```html
<script>
  // Charger analytics après idle
  function loadAnalytics() {
    const script = document.createElement('script');
    script.src = 'https://www.googletagmanager.com/gtag/js?id=G-XXXXXXXXXX';
    script.defer = true;
    document.body.appendChild(script);

    // Config GA4
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'G-XXXXXXXXXX', {
      'anonymize_ip': true,
      'client_storage': 'none'
    });
  }

  // Attendre idle ou max 3 secondes
  if ('requestIdleCallback' in window) {
    requestIdleCallback(loadAnalytics, { timeout: 3000 });
  } else {
    setTimeout(loadAnalytics, 3000);
  }
</script>
```

---

**🎯 Résultat Phase 1.2** :
- ✅ TBT réduit de 520ms → ~200ms (desktop)
- ✅ TBT réduit de 350ms → ~150ms (mobile)
- ✅ FCP amélioré (pas de scripts bloquants)
- **Gain** : +15-20 points Performance

---

#### 1.3 CSS Inutilisé : Purge et Critical CSS ⭐⭐⭐⭐

**Problème** :
- 57 Kio (desktop) / 90 Kio (mobile) CSS inutilisé
- styles.min.css bloque rendu initial
- Pas de Critical CSS inline

**Gains estimés** : +10-15 points Performance, -500ms FCP

---

##### A. Extraire Critical CSS (Above-the-Fold)

**Checklist** :

- [ ] Identifier CSS critique (header, nav, hero, CTA)
- [ ] Créer fichier `critical.css` (~5-10K max)
- [ ] Inline Critical CSS dans `<style>` du `<head>`
- [ ] Charger `styles.min.css` complet en différé

**Méthode automatique (Recommandée)** :
```bash
# Installer Critical (outil Node.js)
npm install -g critical

# Générer Critical CSS pour index.html
critical index.html --base . --inline --minify > critical-index.css

# Copier contenu de critical-index.css dans <style> de index.html
```

**Méthode manuelle** :
1. Ouvrir index.html dans Chrome
2. DevTools → Coverage → Recharger
3. Cliquer sur `styles.min.css` → colonne verte = CSS utilisé
4. Copier CSS utilisé (scroll jusqu'à fin viewport)
5. Coller dans `critical.css`

---

**CSS Critique à inclure** :
```css
/* Variables CSS (OBLIGATOIRE) */
:root {
  --primary: #577086;
  --secondary: #0F52AA;
  --accent: #25D366;
  --text-dark: #2C3E50;
  --text-light: #7F8C8D;
  --bg-light: #F8F9FA;
  --white: #FFFFFF;
}

/* Reset de base */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  line-height: 1.6;
  color: var(--text-dark);
}

/* Header et Navigation */
header { ... }
.nav-menu { ... }
.menu-toggle { ... }

/* Hero section */
.hero { ... }
.hero-title { ... }
.hero-description { ... }

/* Boutons CTA visibles */
.cta-primary { ... }
.cta-secondary { ... }

/* Layout de base */
.container { ... }
```

---

##### B. Inline Critical CSS et defer styles.min.css

**Checklist** :

- [ ] Copier Critical CSS dans `<style>` du `<head>`
- [ ] Charger `styles.min.css` complet en différé
- [ ] Ajouter fallback `<noscript>` pour JS désactivé

**Code** :
```html
<head>
  <!-- Meta tags... -->

  <!-- Critical CSS inline (5-10K max) -->
  <style>
    /* Coller contenu de critical.css ici */
    :root { --primary: #577086; ... }
    * { margin: 0; ... }
    header { ... }
    .hero { ... }
    .cta-primary { ... }
  </style>

  <!-- Précharger CSS complet (chargement asynchrone) -->
  <link
    rel="preload"
    href="assets/css/styles.min.css"
    as="style"
    onload="this.onload=null;this.rel='stylesheet'">

  <!-- Fallback si JS désactivé -->
  <noscript>
    <link rel="stylesheet" href="assets/css/styles.min.css">
  </noscript>

  <!-- Même chose pour autres CSS -->
  <link
    rel="preload"
    href="assets/css/integrations.min.css"
    as="style"
    onload="this.onload=null;this.rel='stylesheet'">
  <noscript>
    <link rel="stylesheet" href="assets/css/integrations.min.css">
  </noscript>
</head>
```

---

##### C. Purger CSS inutilisé avec PurgeCSS

**Checklist** :

- [ ] Installer PurgeCSS
- [ ] Analyser `styles.min.css` avec toutes les pages HTML
- [ ] Créer `styles.purged.min.css`
- [ ] Comparer tailles (avant/après)
- [ ] Tester site (vérifier aucune casse visuelle)
- [ ] Remplacer `styles.min.css` par `styles.purged.min.css`

**Commandes** :
```bash
# Installer PurgeCSS
npm install -g purgecss

# Analyser et purger
purgecss \
  --css assets/css/styles.min.css \
  --content index.html tarifs.html Charte-Integrite-Academique.html popup-demo.html merci.html \
  --output assets/css/styles.purged.min.css

# Comparer tailles
ls -lh assets/css/styles*.css

# Exemple résultat attendu :
# styles.min.css      : 32K
# styles.purged.min.css : 18K (-44%)

# Même opération pour integrations.css
purgecss \
  --css assets/css/integrations.min.css \
  --content index.html \
  --output assets/css/integrations.purged.min.css
```

**Après vérification** :
```bash
# Renommer fichiers purgés
mv assets/css/styles.purged.min.css assets/css/styles.min.css
mv assets/css/integrations.purged.min.css assets/css/integrations.min.css

# Tester site local
python3 -m http.server 8000
# Ouvrir http://localhost:8000
# Vérifier toutes les pages (index, tarifs, charte)
```

---

##### D. Vérifier aucune régression visuelle

**Checklist après purge** :

- [ ] Tester index.html (toutes sections)
- [ ] Tester tarifs.html (grilles tarifs)
- [ ] Tester Charte-Integrite-Academique.html
- [ ] Tester popup-demo.html
- [ ] Tester merci.html
- [ ] Tester menu burger mobile
- [ ] Tester quiz interactif
- [ ] Tester formulaire contact
- [ ] Tester responsive (320px, 768px, 1024px)

**Si problème visuel** :
1. Identifier classe CSS manquante
2. Ajouter classe à safelist PurgeCSS
3. Re-purger

**Exemple safelist** :
```bash
purgecss \
  --css assets/css/styles.min.css \
  --content *.html \
  --safelist quiz-container quiz-question quiz-result \
  --output assets/css/styles.purged.min.css
```

---

**🎯 Résultat Phase 1.3** :
- ✅ FCP réduit de ~500-800ms (CSS non-bloquant)
- ✅ Taille CSS réduite de 32K → ~18K (-44%)
- ✅ Rendu initial instantané (Critical CSS inline)
- **Gain** : +10-15 points Performance

---

**📊 Résultat PHASE 1 Complète (1.1 + 1.2 + 1.3)** :
- **Desktop** : 58 → **98-103** (+40-45 points)
- **Mobile** : 49 → **84-94** (+35-45 points)
- **Durée** : 4-6 heures
- **Fichiers modifiés** : index.html, tarifs.html, charte.html, .htaccess

---

### 🚀 PHASE 2 : OPTIMISATIONS AVANCÉES

**Objectif** : +15-20 points Performance
**Durée** : 2-3 heures
**Impact** : Peaufinage, optimisations techniques

---

#### 2.1 Requêtes Bloquant le Rendu ⭐⭐⭐⭐

**Problème** :
- 40ms économisables (desktop)
- Ressources critiques non préchargées
- Connexions DNS tiers non optimisées

**Gains estimés** : +5 points Performance

---

##### A. Précharger ressources critiques

**Checklist** :

- [ ] Précharger image hero (déjà fait phase 1.1 ✅)
- [ ] Précharger polices si utilisées (Google Fonts, custom fonts)
- [ ] Précharger Critical CSS (si externe)

**Code polices** (si Google Fonts utilisé) :
```html
<head>
  <!-- Preconnect Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

  <!-- Précharger police principale -->
  <link
    rel="preload"
    href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap"
    as="style">

  <!-- Charger polices -->
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap"
    rel="stylesheet">
</head>
```

**Code polices custom** (si .woff2 local) :
```html
<head>
  <!-- Précharger police custom -->
  <link
    rel="preload"
    href="assets/fonts/roboto-regular.woff2"
    as="font"
    type="font/woff2"
    crossorigin>
</head>
```

---

##### B. DNS-prefetch et preconnect pour scripts tiers

**Checklist** :

- [ ] DNS-prefetch Google Analytics
- [ ] DNS-prefetch Trustpilot
- [ ] Preconnect domaines critiques

**Code** :
```html
<head>
  <!-- DNS-prefetch (résolution DNS anticipée) -->
  <link rel="dns-prefetch" href="https://www.googletagmanager.com">
  <link rel="dns-prefetch" href="https://www.google-analytics.com">
  <link rel="dns-prefetch" href="https://widget.trustpilot.com">

  <!-- Preconnect (DNS + TCP + TLS) pour ressources très critiques -->
  <link rel="preconnect" href="https://www.googletagmanager.com">
</head>
```

**Différence preconnect vs dns-prefetch** :
- `dns-prefetch` : Résout DNS uniquement (~10-20ms gain)
- `preconnect` : DNS + TCP + TLS (~50-100ms gain, plus coûteux)
- **Règle** : Max 2-3 `preconnect`, illimité `dns-prefetch`

---

##### C. Resource hints complets

**Checklist** :

- [ ] Ajouter tous les resource hints dans `<head>`
- [ ] Ordre : preconnect → dns-prefetch → preload → prefetch

**Code complet** :
```html
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- 1. Preconnect (DNS + TCP + TLS) -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

  <!-- 2. DNS-prefetch (DNS uniquement) -->
  <link rel="dns-prefetch" href="https://www.googletagmanager.com">
  <link rel="dns-prefetch" href="https://www.google-analytics.com">
  <link rel="dns-prefetch" href="https://widget.trustpilot.com">

  <!-- 3. Preload (ressources critiques) -->
  <link rel="preload" href="assets/images/hero/hero-1200.webp" as="image" fetchpriority="high" media="(min-width: 1024px)">
  <link rel="preload" href="assets/fonts/roboto-regular.woff2" as="font" type="font/woff2" crossorigin>

  <!-- 4. Critical CSS inline -->
  <style>
    /* ... */
  </style>

  <!-- 5. Preload CSS complet (chargement async) -->
  <link rel="preload" href="assets/css/styles.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
  <noscript><link rel="stylesheet" href="assets/css/styles.min.css"></noscript>

  <!-- Meta tags, title, etc. -->
</head>
```

---

**🎯 Résultat Phase 2.1** :
- ✅ FCP réduit de ~50-100ms (preconnect)
- ✅ LCP réduit de ~20-40ms (preload image)
- **Gain** : +5 points Performance

---

#### 2.2 Optimiser Taille du DOM ⭐⭐⭐

**Problème** :
- Taille DOM possiblement élevée
- Nœuds inutiles ralentissent rendering

**Gains estimés** : +5 points Performance

---

##### A. Mesurer taille DOM actuelle

**Checklist** :

- [ ] Ouvrir Chrome DevTools Console
- [ ] Exécuter commande comptage nœuds
- [ ] Noter nombre total

**Commande** :
```javascript
// Dans Console Chrome DevTools
console.log('Nombre total nœuds DOM:', document.querySelectorAll('*').length);

// Analyser nœuds par type
const nodeTypes = {};
document.querySelectorAll('*').forEach(el => {
  nodeTypes[el.tagName] = (nodeTypes[el.tagName] || 0) + 1;
});
console.table(nodeTypes);
```

**Cibles** :
- ✅ Excellent : < 800 nœuds
- 🟢 Bon : 800-1500 nœuds
- 🟠 Moyen : 1500-2500 nœuds
- 🔴 Mauvais : > 2500 nœuds

---

##### B. Simplifier HTML (supprimer wrappers inutiles)

**Checklist** :

- [ ] Identifier `<div>` wrapper inutiles
- [ ] Fusionner éléments avec même parent/enfant unique
- [ ] Supprimer éléments purement décoratifs (remplacer par CSS)

**Exemple AVANT (❌)** :
```html
<div class="container">
  <div class="wrapper">
    <div class="inner">
      <div class="content">
        <h2>Titre</h2>
        <p>Texte</p>
      </div>
    </div>
  </div>
</div>
```

**Exemple APRÈS (✅)** :
```html
<div class="container">
  <h2>Titre</h2>
  <p>Texte</p>
</div>
```

---

##### C. Lazy load sections hors viewport

**Checklist** :

- [ ] Identifier sections loin du viewport (FAQ, Footer si très bas)
- [ ] Lazy load contenu lourd (iframe, embed, etc.)
- [ ] Utiliser Intersection Observer

**Code Intersection Observer** :
```javascript
// Lazy load sections
const lazyElements = document.querySelectorAll('[data-lazy]');

const lazyObserver = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      const element = entry.target;

      // Charger contenu
      if (element.dataset.src) {
        element.src = element.dataset.src;
      }

      // Ajouter classe "loaded"
      element.classList.add('loaded');

      // Stop observer
      lazyObserver.unobserve(element);
    }
  });
}, {
  rootMargin: '100px'  // Charger 100px avant viewport
});

lazyElements.forEach(el => lazyObserver.observe(el));
```

**HTML** :
```html
<!-- Section FAQ chargée au scroll -->
<section class="faq-section" data-lazy>
  <!-- Contenu FAQ -->
</section>
```

---

**🎯 Résultat Phase 2.2** :
- ✅ DOM réduit de ~10-20%
- ✅ Rendering plus rapide
- **Gain** : +5 points Performance

---

#### 2.3 Cache Navigateur Optimisé ⭐⭐⭐

**Problème** :
- 1 Kio économisable (peu critique)
- Headers Cache-Control à vérifier

**Gains estimés** : +2 points Performance

---

##### Vérifier et optimiser .htaccess

**Checklist** :

- [ ] Ouvrir `/Users/chris/Documents/sites/master_mentor/.htaccess`
- [ ] Vérifier section `mod_expires`
- [ ] Ajouter `immutable` aux images
- [ ] Vérifier `mod_headers` Cache-Control

**Code** :
```apache
# Cache navigateur optimisé
<IfModule mod_expires.c>
  ExpiresActive On

  # Images : 1 an (immutable)
  ExpiresByType image/webp "access plus 1 year"
  ExpiresByType image/jpeg "access plus 1 year"
  ExpiresByType image/png "access plus 1 year"
  ExpiresByType image/svg+xml "access plus 1 year"
  ExpiresByType image/x-icon "access plus 1 year"

  # CSS/JS : 1 mois (peuvent être mis à jour)
  ExpiresByType text/css "access plus 1 month"
  ExpiresByType application/javascript "access plus 1 month"

  # HTML : 1 heure (contenu peut changer fréquemment)
  ExpiresByType text/html "access plus 1 hour"

  # Polices : 1 an
  ExpiresByType font/woff2 "access plus 1 year"
  ExpiresByType font/woff "access plus 1 year"
  ExpiresByType font/ttf "access plus 1 year"
</IfModule>

# Cache-Control headers (plus moderne que Expires)
<IfModule mod_headers.c>
  # Images : immutable (ne sera jamais modifiée)
  <FilesMatch "\.(webp|jpg|jpeg|png|gif|svg|ico)$">
    Header set Cache-Control "max-age=31536000, public, immutable"
  </FilesMatch>

  # CSS/JS : public (peut être mis en cache par CDN/proxy)
  <FilesMatch "\.(css|js)$">
    Header set Cache-Control "max-age=2592000, public"
  </FilesMatch>

  # Polices : immutable
  <FilesMatch "\.(woff2|woff|ttf)$">
    Header set Cache-Control "max-age=31536000, public, immutable"
  </FilesMatch>

  # HTML : no-cache (toujours revalider)
  <FilesMatch "\.(html|htm)$">
    Header set Cache-Control "max-age=3600, public, must-revalidate"
  </FilesMatch>
</IfModule>
```

**Tester headers** :
```bash
# Tester image
curl -I https://mastermentor.fr/assets/images/hero/hero-800.webp

# Vérifier ligne :
# Cache-Control: max-age=31536000, public, immutable

# Tester CSS
curl -I https://mastermentor.fr/assets/css/styles.min.css

# Vérifier ligne :
# Cache-Control: max-age=2592000, public
```

---

**🎯 Résultat Phase 2.3** :
- ✅ Cache optimisé (1 an images, 1 mois CSS/JS)
- ✅ `immutable` évite revalidations inutiles
- **Gain** : +2 points Performance

---

**📊 Résultat PHASE 2 Complète (2.1 + 2.2 + 2.3)** :
- **Gain total** : +12-17 points Performance
- **Durée** : 2-3 heures
- **Cumul Phase 1+2** : Desktop 58→110+, Mobile 49→101+

---

### ♿ PHASE 3 : ACCESSIBILITÉ 100/100

**Objectif** : +6 points Accessibilité → 100/100
**Durée** : 1 heure
**Impact** : Conformité WCAG 2.1 niveau AA

---

#### 3.1 Contraste Couleurs ⭐⭐⭐⭐

**Problème** :
- Contraste insuffisant sur certains textes
- Ratio < 4.5:1 (texte normal) ou < 3:1 (gros texte)

**Gains estimés** : +3 points Accessibilité

---

##### A. Identifier éléments avec mauvais contraste

**Checklist** :

- [ ] Ouvrir Chrome DevTools → Lighthouse
- [ ] Relancer audit Accessibility
- [ ] Noter section "Contraste" → éléments en rouge
- [ ] Lister classes CSS concernées

**Exemple rapport Lighthouse** :
```
❌ Contraste insuffisant détecté :
- .text-secondary : 3.2:1 (requis 4.5:1)
- .footer-link : 3.8:1 (requis 4.5:1)
- .testimonial-author : 4.1:1 (requis 4.5:1)
```

---

##### B. Corriger contrastes dans styles.css

**Checklist** :

- [ ] Ouvrir `assets/css/styles.css`
- [ ] Identifier couleurs problématiques
- [ ] Utiliser https://webaim.org/resources/contrastchecker/
- [ ] Ajuster couleurs pour atteindre 4.5:1 minimum
- [ ] Re-minifier `styles.min.css`

**Outil en ligne** :
https://webaim.org/resources/contrastchecker/

**Exemple correction** :

```css
/* ❌ AVANT (styles.css) : Contraste 3.2:1 */
.text-secondary {
  color: #999999; /* Gris clair sur fond blanc #FFFFFF */
}

/* ✅ APRÈS : Contraste 7:1 (AAA) */
.text-secondary {
  color: #666666; /* Gris foncé sur fond blanc */
}
```

**Autres exemples** :
```css
/* Footer links */
/* ❌ AVANT : #999999 sur #2C3E50 = 2.8:1 */
.footer-link {
  color: #999999;
}

/* ✅ APRÈS : #E0E0E0 sur #2C3E50 = 8.2:1 */
.footer-link {
  color: #E0E0E0;
}

/* Testimonials */
/* ❌ AVANT : #7F8C8D sur #FFFFFF = 4.1:1 */
.testimonial-author {
  color: #7F8C8D;
}

/* ✅ APRÈS : #5A6C7D sur #FFFFFF = 7.3:1 */
.testimonial-author {
  color: #5A6C7D;
}
```

---

##### C. Vérifier tous les contrastes

**Checklist contrastes à vérifier** :

- [ ] Texte principal sur fond blanc : var(--text-dark) #2C3E50 sur #FFFFFF
- [ ] Texte secondaire sur fond blanc : var(--text-light) ajusté
- [ ] Liens sur fond blanc : var(--primary) #577086 sur #FFFFFF
- [ ] Bouton CTA texte blanc sur bleu : #FFFFFF sur #0F52AA
- [ ] Footer texte sur fond sombre : couleur claire sur var(--text-dark)
- [ ] Navigation texte : couleur sur fond header

**Commande vérification automatique** :
```bash
# Utiliser Pa11y (outil CLI accessibilité)
npm install -g pa11y

# Tester page
pa11y https://mastermentor.fr --standard WCAG2AA

# Filtrer uniquement contrastes
pa11y https://mastermentor.fr --standard WCAG2AA --reporter cli | grep -i contrast
```

---

##### D. Re-minifier CSS après corrections

**Checklist** :

- [ ] Sauvegarder `styles.css` modifié
- [ ] Minifier avec Python ou tool
- [ ] Remplacer `styles.min.css`
- [ ] Tester site local
- [ ] Redéployer sur OVH si tout OK

**Commande minification** :
```bash
# Avec Python
python3 -c "
import re
css = open('assets/css/styles.css').read()
css = re.sub(r'/\*.*?\*/', '', css, flags=re.DOTALL)
css = re.sub(r'\s+', ' ', css)
css = re.sub(r'\s*([{}:;,])\s*', r'\1', css)
open('assets/css/styles.min.css', 'w').write(css.strip())
"

# Vérifier taille
ls -lh assets/css/styles.min.css
```

---

**🎯 Résultat Phase 3.1** :
- ✅ Tous les contrastes ≥ 4.5:1 (AA)
- ✅ Lisibilité améliorée
- **Gain** : +3 points Accessibilité

---

#### 3.2 Repère Principal `<main>` ⭐⭐⭐

**Problème** :
- Document ne contient pas de landmark `<main>`
- Navigation lecteurs d'écran difficile

**Gains estimés** : +3 points Accessibilité

---

##### A. Ajouter `<main>` dans toutes les pages

**Checklist** :

- [ ] `index.html` : Entourer contenu principal avec `<main>`
- [ ] `tarifs.html` : Idem
- [ ] `Charte-Integrite-Academique.html` : Idem
- [ ] `popup-demo.html` : Vérifier si pertinent
- [ ] `merci.html` : Idem

**Code AVANT (❌)** :
```html
<body>
  <header>
    <nav>...</nav>
  </header>

  <section class="hero">...</section>
  <section class="services">...</section>
  <section class="testimonials">...</section>

  <footer>...</footer>
</body>
```

**Code APRÈS (✅)** :
```html
<body>
  <header>
    <nav>...</nav>
  </header>

  <main>
    <section class="hero">...</section>
    <section class="services">...</section>
    <section class="testimonials">...</section>
    <!-- Toutes les sections de contenu principal -->
  </main>

  <footer>...</footer>
</body>
```

---

##### B. Vérifier landmarks ARIA complets

**Checklist landmarks sémantiques** :

- [ ] `<header>` présent (ou `role="banner"`)
- [ ] `<nav>` présent (ou `role="navigation"`)
- [ ] `<main>` présent (ou `role="main"`)
- [ ] `<footer>` présent (ou `role="contentinfo"`)
- [ ] `<aside>` si contenu annexe (ou `role="complementary"`)

**Vérification automatique** :
```javascript
// Console Chrome DevTools
console.log('Header:', document.querySelector('header') ? '✅' : '❌');
console.log('Nav:', document.querySelector('nav') ? '✅' : '❌');
console.log('Main:', document.querySelector('main') ? '✅' : '❌');
console.log('Footer:', document.querySelector('footer') ? '✅' : '❌');
```

---

##### C. Tester avec lecteur d'écran

**Checklist test** :

- [ ] macOS : Activer VoiceOver (Cmd+F5)
- [ ] Windows : Installer NVDA (gratuit)
- [ ] Naviguer avec Tab
- [ ] Utiliser raccourcis landmarks (NVDA: D pour landmark suivant)
- [ ] Vérifier annonce "Main region" ou "Contenu principal"

**Commandes VoiceOver (macOS)** :
- Activer : `Cmd + F5`
- Landmarks : `Ctrl + Option + U` → Landmarks
- Naviguer : `Ctrl + Option + →/←`

---

**🎯 Résultat Phase 3.2** :
- ✅ Structure sémantique complète
- ✅ Navigation lecteurs d'écran optimisée
- **Gain** : +3 points Accessibilité

---

**📊 Résultat PHASE 3 Complète (3.1 + 3.2)** :
- **Accessibilité** : 94 → **100** ✅
- **Durée** : 1 heure
- **Conformité** : WCAG 2.1 niveau AA

---

### 🛡️ PHASE 4 : BONNES PRATIQUES 100/100

**Objectif** : +23 points Bonnes Pratiques → 100/100
**Durée** : 2-3 heures
**Impact** : Sécurité renforcée, conformité web moderne

---

#### 4.1 Headers Sécurité HTTP ⭐⭐⭐⭐⭐

**Problème** :
- CSP (Content-Security-Policy) manquant
- HSTS (Strict-Transport-Security) manquant
- COOP (Cross-Origin-Opener-Policy) manquant
- Trusted Types manquant

**Gains estimés** : +15 points Bonnes Pratiques

---

##### A. Ajouter HSTS (HTTP Strict Transport Security)

**Checklist** :

- [ ] Ouvrir `.htaccess`
- [ ] Ajouter header HSTS avec preload
- [ ] Redéployer sur OVH
- [ ] Tester avec `curl -I`

**Code** :
```apache
# Dans .htaccess, section <IfModule mod_headers.c>

# HTTP Strict Transport Security (HSTS)
# Force HTTPS pendant 1 an (31536000 secondes)
# includeSubDomains : applique aux sous-domaines
# preload : éligible à la preload list navigateurs
Header always set Strict-Transport-Security "max-age=31536000; includeSubDomains; preload"
```

**Test** :
```bash
curl -I https://mastermentor.fr

# Vérifier ligne :
# Strict-Transport-Security: max-age=31536000; includeSubDomains; preload
```

**⚠️ Attention** : Une fois HSTS activé, le site ne sera accessible qu'en HTTPS pendant 1 an. S'assurer que SSL est stable.

---

##### B. Configurer CSP (Content-Security-Policy)

**Checklist** :

- [ ] Lister toutes les sources externes (GA4, Trustpilot, polices, etc.)
- [ ] Créer CSP mode `Content-Security-Policy-Report-Only` (test)
- [ ] Tester 24-48h sans erreurs console
- [ ] Activer CSP mode enforce `Content-Security-Policy`

**⚠️ IMPORTANT** : CSP peut casser le site si mal configuré. Toujours commencer en mode report-only.

**Code CSP (Phase 1 : Report-Only)** :
```apache
# Dans .htaccess

# CSP Mode Report-Only (ne bloque rien, log uniquement)
Header set Content-Security-Policy-Report-Only "default-src 'self'; script-src 'self' 'unsafe-inline' https://www.googletagmanager.com https://www.google-analytics.com https://widget.trustpilot.com; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; img-src 'self' data: https:; font-src 'self' https://fonts.gstatic.com; connect-src 'self' https://www.google-analytics.com https://stats.g.doubleclick.net; frame-src 'self' https://www.youtube.com; object-src 'none'; base-uri 'self'; form-action 'self'; upgrade-insecure-requests;"
```

**Tester CSP Report-Only** :
1. Déployer .htaccess avec CSP-Report-Only
2. Ouvrir https://mastermentor.fr
3. Ouvrir Console Chrome DevTools
4. Chercher erreurs "Content-Security-Policy"
5. Si aucune erreur pendant 24-48h → passer en mode enforce

**Code CSP (Phase 2 : Enforce)** :
```apache
# Après validation, remplacer Report-Only par enforce

# CSP Mode Enforce (bloque réellement)
Header set Content-Security-Policy "default-src 'self'; script-src 'self' 'unsafe-inline' https://www.googletagmanager.com https://www.google-analytics.com https://widget.trustpilot.com; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; img-src 'self' data: https:; font-src 'self' https://fonts.gstatic.com; connect-src 'self' https://www.google-analytics.com https://stats.g.doubleclick.net; frame-src 'self' https://www.youtube.com; object-src 'none'; base-uri 'self'; form-action 'self'; upgrade-insecure-requests;"
```

**Directives CSP expliquées** :
```apache
default-src 'self';  # Par défaut, uniquement même origine

script-src 'self' 'unsafe-inline'  # Scripts inline autorisés (critical JS)
  https://www.googletagmanager.com  # Google Analytics
  https://www.google-analytics.com
  https://widget.trustpilot.com;    # Trustpilot widget

style-src 'self' 'unsafe-inline'  # CSS inline autorisé (critical CSS)
  https://fonts.googleapis.com;   # Google Fonts

img-src 'self' data: https:;  # Images : même origine + data URIs + HTTPS

font-src 'self' https://fonts.gstatic.com;  # Polices Google

connect-src 'self'  # Fetch/XHR : même origine
  https://www.google-analytics.com
  https://stats.g.doubleclick.net;

frame-src 'self' https://www.youtube.com;  # iframes YouTube si vidéos

object-src 'none';  # Bloquer Flash, Java applets

base-uri 'self';  # Empêcher injection <base>

form-action 'self';  # Formulaires soumis uniquement même origine

upgrade-insecure-requests;  # Forcer HTTPS sur ressources HTTP
```

**⚠️ Si erreurs CSP** :
1. Noter domaine bloqué dans console
2. Ajouter domaine à directive appropriée
3. Redéployer et re-tester

---

##### C. Ajouter COOP (Cross-Origin-Opener-Policy)

**Checklist** :

- [ ] Ajouter header COOP `same-origin`
- [ ] Tester site (vérifier aucune casse)

**Code** :
```apache
# Dans .htaccess

# Cross-Origin-Opener-Policy (COOP)
# Isole fenêtre des autres origines (sécurité Spectre)
Header set Cross-Origin-Opener-Policy "same-origin"
```

**⚠️ Attention** : Si le site ouvre des fenêtres `window.open()` vers d'autres domaines, utiliser `same-origin-allow-popups`

---

##### D. Ajouter Permissions-Policy

**Checklist** :

- [ ] Désactiver fonctionnalités non utilisées (géolocalisation, caméra, etc.)
- [ ] Ajouter header Permissions-Policy

**Code** :
```apache
# Dans .htaccess

# Permissions-Policy (anciennement Feature-Policy)
# Désactive fonctionnalités non utilisées
Header set Permissions-Policy "geolocation=(), microphone=(), camera=(), payment=(), usb=(), magnetometer=(), gyroscope=(), accelerometer=()"
```

**Explications** :
- `geolocation=()` : Bloque accès géolocalisation
- `camera=()` : Bloque accès caméra
- `()` : Vide = aucun domaine autorisé (bloqué partout)

---

##### E. Code .htaccess complet section sécurité

**Checklist finale** :

- [ ] Copier code ci-dessous dans `.htaccess`
- [ ] Tester localement (si possible)
- [ ] Déployer sur OVH
- [ ] Tester https://securityheaders.com/ (viser A+)

**Code complet** :
```apache
# ========================================
# HEADERS SÉCURITÉ
# ========================================

<IfModule mod_headers.c>
  # X-XSS-Protection (déjà présent normalement)
  Header set X-XSS-Protection "1; mode=block"

  # X-Frame-Options (déjà présent)
  Header set X-Frame-Options "SAMEORIGIN"

  # X-Content-Type-Options (déjà présent)
  Header set X-Content-Type-Options "nosniff"

  # Referrer-Policy (déjà présent)
  Header set Referrer-Policy "strict-origin-when-cross-origin"

  # ===== NOUVEAUX HEADERS =====

  # HTTP Strict Transport Security (HSTS) - 1 an
  Header always set Strict-Transport-Security "max-age=31536000; includeSubDomains; preload"

  # Content-Security-Policy (CSP)
  # ⚠️ COMMENCER EN MODE REPORT-ONLY, PUIS ACTIVER APRÈS VALIDATION

  # Phase 1 : Report-Only (TEST - ne bloque rien)
  Header set Content-Security-Policy-Report-Only "default-src 'self'; script-src 'self' 'unsafe-inline' https://www.googletagmanager.com https://www.google-analytics.com https://widget.trustpilot.com; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; img-src 'self' data: https:; font-src 'self' https://fonts.gstatic.com; connect-src 'self' https://www.google-analytics.com https://stats.g.doubleclick.net; frame-src 'self' https://www.youtube.com; object-src 'none'; base-uri 'self'; form-action 'self'; upgrade-insecure-requests;"

  # Phase 2 : Enforce (PRODUCTION - après validation)
  # Décommenter après 24-48h sans erreurs
  # Header set Content-Security-Policy "default-src 'self'; script-src 'self' 'unsafe-inline' https://www.googletagmanager.com https://www.google-analytics.com https://widget.trustpilot.com; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; img-src 'self' data: https:; font-src 'self' https://fonts.gstatic.com; connect-src 'self' https://www.google-analytics.com https://stats.g.doubleclick.net; frame-src 'self' https://www.youtube.com; object-src 'none'; base-uri 'self'; form-action 'self'; upgrade-insecure-requests;"

  # Cross-Origin-Opener-Policy (COOP)
  Header set Cross-Origin-Opener-Policy "same-origin"

  # Cross-Origin-Resource-Policy (CORP)
  Header set Cross-Origin-Resource-Policy "same-origin"

  # Permissions-Policy (désactive fonctionnalités non utilisées)
  Header set Permissions-Policy "geolocation=(), microphone=(), camera=(), payment=(), usb=(), magnetometer=(), gyroscope=(), accelerometer=()"
</IfModule>
```

---

##### F. Tester headers sécurité

**Checklist tests** :

- [ ] https://securityheaders.com/?q=https://mastermentor.fr (viser A+)
- [ ] https://observatory.mozilla.org/ (viser A+)
- [ ] `curl -I https://mastermentor.fr` (vérifier tous headers)

**Commande curl** :
```bash
curl -I https://mastermentor.fr

# Vérifier présence de :
# Strict-Transport-Security: max-age=31536000; includeSubDomains; preload
# Content-Security-Policy-Report-Only: ...
# Cross-Origin-Opener-Policy: same-origin
# Permissions-Policy: geolocation=(), ...
```

---

**🎯 Résultat Phase 4.1** :
- ✅ HSTS actif (force HTTPS)
- ✅ CSP configuré (XSS protection)
- ✅ COOP activé (isolation)
- ✅ Permissions-Policy (privacy)
- **Gain** : +15 points Bonnes Pratiques

---

#### 4.2 Cookies Tiers ⭐⭐⭐

**Problème** :
- 3-4 cookies tiers (Google Analytics, Trustpilot)
- Tracking excessif

**Gains estimés** : +8 points Bonnes Pratiques

---

##### A. Audit cookies actuels

**Checklist** :

- [ ] Ouvrir Chrome DevTools → Application → Cookies
- [ ] Lister tous les cookies
- [ ] Identifier origine (domaine)

**Commande JavaScript** :
```javascript
// Console Chrome
document.cookie.split(';').forEach(c => console.log(c.trim()));
```

**Cookies probables** :
- `_ga`, `_gid`, `_gat` : Google Analytics
- `tp_*` : Trustpilot
- Session PHP si contact.php utilise sessions

---

##### B. Désactiver cookies Google Analytics (GA4)

**Checklist** :

- [ ] Modifier code Google Analytics
- [ ] Ajouter `client_storage: 'none'`
- [ ] Ajouter `anonymize_ip: true`
- [ ] Tester : vérifier disparition cookies `_ga`

**Code AVANT (❌)** :
```javascript
gtag('config', 'G-XXXXXXXXXX');
```

**Code APRÈS (✅)** :
```javascript
gtag('config', 'G-XXXXXXXXXX', {
  'client_storage': 'none',  // Désactive cookies
  'anonymize_ip': true,      // Anonymise IP
  'allow_google_signals': false,  // Désactive signaux publicitaires
  'allow_ad_personalization_signals': false  // Désactive personnalisation pubs
});
```

---

##### C. Trustpilot : Badge statique vs Widget

**Checklist** :

- [ ] Vérifier si Trustpilot charge cookies
- [ ] Si oui, envisager badge statique (image + lien)

**Alternative badge statique** :
```html
<!-- ❌ Widget dynamique (charge cookies) -->
<script src="https://widget.trustpilot.com/..."></script>

<!-- ✅ Badge statique (0 cookies) -->
<a href="https://fr.trustpilot.com/review/staka.fr" target="_blank" rel="noopener">
  <img
    src="assets/images/trustpilot-badge.webp"
    alt="Trustpilot 4.8/5 étoiles"
    width="200"
    height="60"
    loading="lazy">
</a>
```

---

##### D. Cookies PHP : SameSite + Secure

**Checklist** :

- [ ] Vérifier si `contact.php` utilise `session_start()`
- [ ] Si oui, ajouter `SameSite=Strict; Secure`

**Code** :
```apache
# Dans .htaccess

# Cookies PHP : SameSite + Secure
<IfModule mod_headers.c>
  Header always edit Set-Cookie ^(.*)$ "$1; SameSite=Strict; Secure"
</IfModule>
```

**Ou dans contact.php** (si sessions utilisées) :
```php
<?php
// En haut de contact.php, avant session_start()

// Configuration cookies sécurisés
ini_set('session.cookie_httponly', 1);  // Inaccessible JavaScript
ini_set('session.cookie_secure', 1);    // HTTPS uniquement
ini_set('session.cookie_samesite', 'Strict');  // SameSite

session_start();
?>
```

---

##### E. Vérifier réduction cookies

**Checklist** :

- [ ] Déployer modifications
- [ ] Ouvrir site en navigation privée
- [ ] DevTools → Application → Cookies
- [ ] Compter cookies (objectif : 0-1 max)

**Avant** : 3-4 cookies (GA4 + Trustpilot)
**Après** : 0-1 cookies (session PHP uniquement si nécessaire)

---

**🎯 Résultat Phase 4.2** :
- ✅ Cookies réduits de 3-4 → 0-1
- ✅ Tracking respectueux RGPD
- **Gain** : +8 points Bonnes Pratiques

---

**📊 Résultat PHASE 4 Complète (4.1 + 4.2)** :
- **Bonnes Pratiques** : 77 → **100** ✅
- **Durée** : 2-3 heures
- **Sécurité** : Grade A+ sur securityheaders.com

---

### ⚡ PHASE 5 : OPTIMISATIONS THREAD PRINCIPAL

**Objectif** : Réduire TBT (Total Blocking Time)
**Durée** : 2 heures
**Impact** : +5-10 points Performance, fluidité améliorée

---

#### 5.1 Éviter Tâches Longues (Long Tasks) ⭐⭐⭐⭐⭐

**Problème** :
- 6 tâches longues desktop (> 50ms)
- 5 tâches longues mobile
- TBT 520ms desktop, 350ms mobile

**Gains estimés** : +8 points Performance, -300ms TBT

---

##### A. Identifier tâches longues

**Checklist** :

- [ ] Ouvrir Chrome DevTools → Performance
- [ ] Cliquer "Record" (icône rond)
- [ ] Recharger page (Cmd+R / Ctrl+R)
- [ ] Stopper enregistrement après chargement complet
- [ ] Analyser timeline : chercher barres rouges (tâches > 50ms)
- [ ] Noter quels scripts causent blocage

**Interprétation** :
- Barres **vertes** : Tâches < 50ms ✅
- Barres **jaunes** : Tâches 50-100ms ⚠️
- Barres **rouges** : Tâches > 100ms ❌ (bloquer thread principal)

**Suspects probables** :
- Google Analytics init
- Trustpilot widget load
- quiz.js parsing
- main.js init

---

##### B. Déplacer scripts tiers en bas + defer

**Checklist** :

- [ ] Vérifier que tous scripts sont en bas `</body>`
- [ ] Vérifier attribut `defer` présent
- [ ] Scripts inline après scripts externes

**Code** (déjà fait normalement en Phase 1.2) :
```html
<body>
  <!-- Contenu HTML... -->

  <!-- Scripts externes avec defer -->
  <script defer src="https://www.googletagmanager.com/gtag/js?id=G-XXX"></script>
  <script defer src="assets/js/main.min.js"></script>

  <!-- Scripts inline APRÈS externes -->
  <script>
    // Critical JS inline
  </script>
</body>
```

---

##### C. Lazy load modules non-critiques

**Checklist** :

- [ ] Quiz.js chargé dynamiquement (déjà fait Phase 1.2 ✅)
- [ ] Google Analytics via `requestIdleCallback` (déjà fait Phase 1.2 ✅)
- [ ] Trustpilot widget lazy load

**Code Trustpilot lazy load** :
```javascript
// Charger Trustpilot après idle
function loadTrustpilot() {
  if (document.querySelector('.trustpilot-widget')) {
    const script = document.createElement('script');
    script.src = 'https://widget.trustpilot.com/bootstrap/v5/tp.widget.bootstrap.min.js';
    script.defer = true;
    document.body.appendChild(script);
  }
}

if ('requestIdleCallback' in window) {
  requestIdleCallback(loadTrustpilot, { timeout: 5000 });
} else {
  setTimeout(loadTrustpilot, 5000);
}
```

---

##### D. Code-splitting main.js (avancé)

**Checklist** (si main.js > 10K) :

- [ ] Séparer main.js en modules
- [ ] Module 1 : Critical (menu, scroll)
- [ ] Module 2 : Interactions (formulaire, quiz)
- [ ] Module 3 : Animations (scroll reveals)
- [ ] Charger modules via dynamic import

**Structure** :
```
assets/js/
├── critical.js      (inline dans HTML, 1-2K)
├── interactions.js  (defer, 3-4K)
└── animations.js    (lazy load, 2-3K)
```

**Chargement** :
```javascript
// Critical inline dans HTML
<script>
  // Menu burger, smooth scroll
</script>

// Interactions en defer
<script defer src="assets/js/interactions.min.js"></script>

// Animations lazy load
<script>
  if ('IntersectionObserver' in window) {
    requestIdleCallback(() => {
      import('./assets/js/animations.min.js');
    });
  }
</script>
```

---

**🎯 Résultat Phase 5.1** :
- ✅ TBT réduit de 520ms → ~200ms desktop
- ✅ TBT réduit de 350ms → ~150ms mobile
- **Gain** : +8 points Performance

---

#### 5.2 Animations Composées (GPU) ⭐⭐⭐

**Problème** :
- 1 élément animé force layout/paint (CPU)
- Devrait utiliser GPU (transform/opacity)

**Gains estimés** : +3 points Performance

---

##### A. Identifier animation problématique

**Checklist** :

- [ ] Lighthouse → Performance → "Éviter animations non composées"
- [ ] Noter élément concerné (classe CSS)

**Exemple rapport** :
```
❌ Animation non composée détectée :
- .cta-primary:hover → anime 'top' (force layout)
```

---

##### B. Corriger animation : utiliser transform

**Checklist** :

- [ ] Ouvrir `assets/css/styles.css`
- [ ] Chercher animation problématique
- [ ] Remplacer `top`/`left`/`width`/`height` par `transform`
- [ ] Ajouter `will-change` si nécessaire
- [ ] Re-minifier

**Code AVANT (❌)** :
```css
.cta-primary {
  transition: all 0.3s ease;
}

.cta-primary:hover {
  top: -5px;  /* Force layout (CPU) */
  box-shadow: 0 10px 20px rgba(0,0,0,0.2);
}
```

**Code APRÈS (✅)** :
```css
.cta-primary {
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  will-change: transform;  /* Prépare GPU */
}

.cta-primary:hover {
  transform: translateY(-5px);  /* GPU */
  box-shadow: 0 10px 20px rgba(0,0,0,0.2);
}
```

---

##### C. Propriétés animables GPU

**Checklist règles** :

- [ ] ✅ Utiliser `transform` (translate, scale, rotate)
- [ ] ✅ Utiliser `opacity`
- [ ] ❌ Éviter `width`, `height`, `top`, `left`, `margin`, `padding`
- [ ] ❌ Éviter `background-color` (sauf si nécessaire)

**Équivalences** :
```css
/* ❌ CPU (force layout) */
left: 100px;
top: 50px;
width: 200px;
height: 150px;

/* ✅ GPU (composite layer) */
transform: translateX(100px) translateY(50px) scale(1.5);
opacity: 0.8;
```

---

##### D. will-change : utilisation prudente

**Checklist** :

- [ ] Ajouter `will-change` uniquement sur éléments animés fréquemment
- [ ] Supprimer après animation (éviter surconsommation mémoire)
- [ ] Max 5-10 éléments avec `will-change` simultanément

**Code** :
```css
/* ✅ BON : will-change sur hover */
.cta-primary {
  transition: transform 0.3s;
}

.cta-primary:hover {
  transform: translateY(-5px);
  will-change: transform;
}

/* ❌ MAUVAIS : will-change permanent sur tous boutons */
button {
  will-change: transform;  /* Consomme mémoire GPU inutilement */
}
```

---

##### E. Tester animations

**Checklist** :

- [ ] Ouvrir site local
- [ ] DevTools → Performance → Record
- [ ] Interagir avec éléments animés (hovers, scrolls)
- [ ] Stopper → Analyser timeline
- [ ] Vérifier barres vertes (composite) au lieu de barres rouges (layout)

---

**🎯 Résultat Phase 5.2** :
- ✅ Animations GPU (composite layer)
- ✅ 60 FPS fluides
- **Gain** : +3 points Performance

---

**📊 Résultat PHASE 5 Complète (5.1 + 5.2)** :
- **Gain total** : +11 points Performance
- **TBT** : 520ms → ~200ms desktop, 350ms → ~150ms mobile
- **Durée** : 2 heures

---

## 📋 CHECKLIST GLOBALE (Toutes Phases)

### ✅ Phase 1 : Optimisations Critiques (4-6h)

**Images** :
- [ ] Ajouter `width` + `height` à toutes les `<img>`
- [ ] Remplacer hero par `<picture>` responsive
- [ ] Précharger image hero avec `<link rel="preload">`
- [ ] Ajouter `fetchpriority="high"` sur hero
- [ ] Ajouter `loading="lazy"` images hors viewport
- [ ] Vérifier formats WebP partout

**JavaScript** :
- [ ] Déplacer scripts en bas `</body>` avec `defer`
- [ ] Charger quiz.js dynamiquement (si présent)
- [ ] Google Analytics via `requestIdleCallback`
- [ ] Code-splitting : Critical JS inline
- [ ] Trustpilot lazy load

**CSS** :
- [ ] Extraire Critical CSS (~5-10K)
- [ ] Inline Critical CSS dans `<style>`
- [ ] Charger `styles.min.css` en différé
- [ ] Purger CSS inutilisé avec PurgeCSS
- [ ] Tester site (0 régression visuelle)

---

### ✅ Phase 2 : Optimisations Avancées (2-3h)

**Render-blocking** :
- [ ] Précharger polices (Google Fonts ou custom)
- [ ] DNS-prefetch scripts tiers
- [ ] Preconnect domaines critiques
- [ ] Resource hints complets dans `<head>`

**DOM** :
- [ ] Mesurer taille DOM (< 1500 nœuds cible)
- [ ] Supprimer wrappers `<div>` inutiles
- [ ] Lazy load sections hors viewport

**Cache** :
- [ ] Vérifier `.htaccess` Cache-Control
- [ ] Ajouter `immutable` aux images
- [ ] Tester headers avec `curl -I`

---

### ✅ Phase 3 : Accessibilité (1h)

**Contraste** :
- [ ] Lister éléments mauvais contraste (Lighthouse)
- [ ] Corriger couleurs (min 4.5:1)
- [ ] Vérifier sur https://webaim.org/resources/contrastchecker/
- [ ] Re-minifier CSS

**Landmarks** :
- [ ] Ajouter `<main>` dans toutes les pages
- [ ] Vérifier `<header>`, `<nav>`, `<footer>`
- [ ] Tester avec VoiceOver / NVDA

---

### ✅ Phase 4 : Bonnes Pratiques (2-3h)

**Headers Sécurité** :
- [ ] Ajouter HSTS dans `.htaccess`
- [ ] Configurer CSP mode Report-Only
- [ ] Tester CSP 24-48h (0 erreur console)
- [ ] Activer CSP mode Enforce
- [ ] Ajouter COOP `same-origin`
- [ ] Ajouter Permissions-Policy
- [ ] Tester sur https://securityheaders.com/ (A+ cible)

**Cookies** :
- [ ] Audit cookies (DevTools Application)
- [ ] Désactiver cookies GA4 (`client_storage: 'none'`)
- [ ] Trustpilot : badge statique si possible
- [ ] Cookies PHP : `SameSite=Strict; Secure`
- [ ] Vérifier réduction cookies (0-1 max)

---

### ✅ Phase 5 : Thread Principal (2h)

**Long Tasks** :
- [ ] Audit Performance DevTools (identifier tâches > 50ms)
- [ ] Scripts tiers en bas + defer (vérifier)
- [ ] Lazy load modules (quiz, analytics, Trustpilot)
- [ ] Code-splitting main.js si > 10K

**Animations** :
- [ ] Identifier animation problématique
- [ ] Remplacer `top`/`left` par `transform`
- [ ] Ajouter `will-change` sur hovers uniquement
- [ ] Tester animations (60 FPS)

---

## 📊 Résultats Attendus Finaux

### Desktop

| Métrique | Avant | Après | Gain |
|----------|-------|-------|------|
| **Performance** | 58 | **93-98** | +35-40 |
| **Accessibilité** | 94 | **100** | +6 |
| **Bonnes Pratiques** | 77 | **100** | +23 |
| **SEO** | 100 | **100** | ✅ |

**Core Web Vitals Desktop** :
- FCP : 1,7s → **0,9-1,2s** ✅
- LCP : 2,3s → **1,5-1,8s** ✅
- TBT : 520ms → **150-200ms** ✅
- CLS : 0 → **0** ✅

---

### Mobile

| Métrique | Avant | Après | Gain |
|----------|-------|-------|------|
| **Performance** | 49 | **84-94** | +35-45 |
| **Accessibilité** | 94 | **100** | +6 |
| **Bonnes Pratiques** | 77 | **100** | +23 |
| **SEO** | 100 | **100** | ✅ |

**Core Web Vitals Mobile** :
- FCP : 8,6s → **2,5-3,5s** ✅
- LCP : 10,4s → **3,5-4,5s** ✅
- TBT : 350ms → **100-150ms** ✅
- CLS : 0 → **0** ✅

---

## 🎯 Planning Recommandé

### Semaine 1 (6h)
**Gains rapides - Impact maximal**

**Jour 1 (3h)** :
- [ ] Phase 1.1 : Images (width/height, preload, lazy) → +15 pts
- [ ] Phase 3.2 : `<main>` landmark → +3 pts Accessibilité

**Jour 2 (3h)** :
- [ ] Phase 1.2 : JavaScript (defer, lazy, idle) → +15 pts
- [ ] Phase 3.1 : Contraste couleurs → +3 pts Accessibilité

**Résultat semaine 1** :
- Desktop : 58 → ~76 (+18)
- Mobile : 49 → ~67 (+18)
- Accessibilité : 94 → 100 ✅

---

### Semaine 2 (5h)
**Optimisations avancées**

**Jour 3 (2h)** :
- [ ] Phase 1.3 : Critical CSS + Purge → +10 pts

**Jour 4 (3h)** :
- [ ] Phase 4.1 : Headers sécurité (HSTS, CSP, COOP) → +15 pts BP

**Résultat semaine 2** :
- Desktop : 76 → ~86 (+10)
- Mobile : 67 → ~77 (+10)
- Bonnes Pratiques : 77 → 92 (+15)

---

### Semaine 3 (4h)
**Peaufinage et sécurité**

**Jour 5 (2h)** :
- [ ] Phase 4.2 : Cookies tiers → +8 pts BP
- [ ] Phase 2.1 : Preload/prefetch → +5 pts

**Jour 6 (2h)** :
- [ ] Phase 5 : Thread principal + Animations → +11 pts
- [ ] Phase 2.2 + 2.3 : DOM + Cache → +7 pts

**Résultat semaine 3** :
- Desktop : 86 → **93-98** (+7-12)
- Mobile : 77 → **84-94** (+7-17)
- Bonnes Pratiques : 92 → **100** ✅

---

**TOTAL** : ~15 heures réparties sur 3 semaines

---

## 🧪 Tests & Validation

### Tests après chaque phase

**Checklist validation** :

- [ ] PageSpeed Insights : noter nouveaux scores
- [ ] Chrome DevTools → Lighthouse : audit complet
- [ ] Tests visuels : 0 régression (toutes pages)
- [ ] Tests fonctionnels : formulaire, quiz, navigation
- [ ] Tests responsive : 320px, 768px, 1024px
- [ ] Console : 0 erreur JavaScript
- [ ] Console : 0 erreur CSP (après activation)

---

### Outils de test

**Performance** :
- https://pagespeed.web.dev/ (officiel Google)
- https://gtmetrix.com/ (détails waterfall)
- https://webpagetest.org/ (multi-locations)

**Sécurité** :
- https://securityheaders.com/ (headers HTTP)
- https://observatory.mozilla.org/ (audit complet)

**Accessibilité** :
- Chrome Lighthouse (intégré DevTools)
- https://wave.webaim.org/ (analyse visuelle)
- https://www.accessibilitychecker.org/

**SEO** :
- https://validator.schema.org/ (JSON-LD)
- Google Search Console (indexation)

**CSS/HTML** :
- https://validator.w3.org/nu/ (W3C validator)
- Chrome DevTools Coverage (CSS/JS inutilisé)

---

## 📝 Documentation & Suivi

### Créer MM-12 : Tracking Optimisations

**Checklist finale** :

- [ ] Créer ticket Jira MM-12 : "Optimisations Performance"
- [ ] Lier MM-12 à ce document (MM-11)
- [ ] Créer page Confluence "Performance & Core Web Vitals"
- [ ] Documenter scores avant/après chaque phase
- [ ] Screenshots PageSpeed Insights (avant/après)
- [ ] Mettre à jour CHANGELOG.md (version 1.4)
- [ ] Commit Git après chaque phase majeure

---

### Template commentaire Jira (après optimisations)

```markdown
# ✅ Phase X : [Nom Phase] Complétée

**Date** : [Date]
**Durée** : [Heures]

## Modifications

- [Liste modifications]

## Résultats PageSpeed Insights

**Desktop** :
- Performance : XX → **YY** (+ZZ)
- Accessibilité : XX → **YY**
- Bonnes Pratiques : XX → **YY**
- SEO : XX → **YY**

**Mobile** :
- Performance : XX → **YY** (+ZZ)

**Core Web Vitals** :
- FCP : Xs → Ys
- LCP : Xs → Ys
- TBT : XXms → YYms

## Fichiers modifiés

- [ ] index.html
- [ ] tarifs.html
- [ ] styles.css
- [ ] .htaccess

## Tests validés

- [x] Tests fonctionnels OK
- [x] Tests responsive OK
- [x] 0 erreur console
- [x] 0 régression visuelle

## Screenshots

[Joindre screenshot PageSpeed]

---

**Prochaine étape** : Phase X+1
```

---

## 🚀 Déploiement Optimisations

### Procédure déploiement OVH

**Checklist avant déploiement** :

- [ ] Tests locaux complets (toutes pages)
- [ ] Commit Git avec message descriptif
- [ ] Push sur GitHub
- [ ] Backup production actuelle (télécharger .htaccess, HTML, CSS, JS)

**Commande déploiement SFTP** :
```bash
cd /Users/chris/Documents/sites/master_mentor

# Upload fichiers modifiés uniquement
lftp -u mastevl,'Staka2020' sftp://ftp.cluster121.hosting.ovh.net <<'EOF'
set sftp:auto-confirm yes
set ssl:verify-certificate no
cd /home/mastevl/www

# Upload fichiers HTML
put index.html
put tarifs.html
put Charte-Integrite-Academique.html

# Upload CSS
cd assets/css
lcd assets/css
mput *.css

# Upload JS si modifié
cd ../js
lcd ../js
mput *.js

# Upload .htaccess
cd ../../
lcd ../../
put .htaccess

echo "✅ Déploiement terminé"
bye
EOF
```

**Vérification post-déploiement** :
```bash
# Test HTTPS
curl -I https://mastermentor.fr

# Test headers sécurité
curl -I https://mastermentor.fr | grep -E "(Strict-Transport-Security|Content-Security-Policy|Cross-Origin)"

# Test compression
curl -I -H "Accept-Encoding: gzip" https://mastermentor.fr/assets/css/styles.min.css | grep "Content-Encoding"
```

---

## 📚 Ressources & Documentation

### Guides officiels

**Google** :
- https://web.dev/performance-scoring/ (Lighthouse scoring)
- https://web.dev/vitals/ (Core Web Vitals)
- https://web.dev/optimize-lcp/ (Optimiser LCP)
- https://web.dev/optimize-fcp/ (Optimiser FCP)
- https://web.dev/optimize-cls/ (Optimiser CLS)

**MDN** :
- https://developer.mozilla.org/en-US/docs/Web/Performance (Performance globale)
- https://developer.mozilla.org/en-US/docs/Web/HTTP/CSP (Content-Security-Policy)
- https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Strict-Transport-Security (HSTS)

**W3C** :
- https://www.w3.org/WAI/WCAG21/quickref/ (WCAG 2.1 Quick Reference)
- https://webaim.org/resources/contrastchecker/ (Contrast Checker)

---

## ✅ Validation Finale

**Critères de succès** :

- [ ] **Performance Desktop** : ≥ 90/100 ✅
- [ ] **Performance Mobile** : ≥ 85/100 ✅
- [ ] **Accessibilité** : 100/100 ✅
- [ ] **Bonnes Pratiques** : 100/100 ✅
- [ ] **SEO** : 100/100 ✅
- [ ] **FCP Mobile** : < 3,5s ✅
- [ ] **LCP Mobile** : < 4,5s ✅
- [ ] **TBT Desktop** : < 200ms ✅
- [ ] **TBT Mobile** : < 150ms ✅
- [ ] **CLS** : 0 (maintenu) ✅
- [ ] **Security Headers** : Grade A+ ✅
- [ ] **W3C Validation** : 0 erreur (maintenu) ✅

---

**Document créé le** : 15 novembre 2025
**Auteur** : Claude Code
**Version** : 1.0
**Statut** : ✅ Prêt à exécuter

**🎯 Objectif** : Passer de 58/49 à 90+ Performance sur mastermentor.fr

---

**Prochaine étape** : Commencer Phase 1.1 (Images) ⚡
