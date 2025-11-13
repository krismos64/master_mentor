# 🚀 MasterMentor - Guide d'Installation

## 📁 Structure du Site

```
mastermentor/
├── index.html                          # Page d'accueil (renommer mastermentor.html)
├── tarifs.html                         # Page tarifs
├── Charte-Integrite-Academique.html   # Charte éthique
├── popup-demo.html                     # Démo popup (optionnel)
├── README-INSTALLATION.md              # Ce fichier
└── robots.txt                          # SEO (à créer)
```

---

## 🌐 ÉTAPE 1 : Hébergement

### Options Recommandées

#### Option A : Netlify (GRATUIT - Recommandé pour démarrage)
1. Créer un compte sur [netlify.com](https://netlify.com)
2. Glisser-déposer le dossier complet
3. Site en ligne en 30 secondes !
4. SSL automatique (HTTPS)
5. Domaine gratuit : `votre-site.netlify.app`

#### Option B : Vercel (GRATUIT)
1. Compte sur [vercel.com](https://vercel.com)
2. Import GitHub ou upload direct
3. Déploiement automatique

#### Option C : OVH / O2Switch (Payant ~5€/mois)
1. Hébergement mutualisé
2. Upload via FTP (FileZilla)
3. Plus de contrôle

---

## 🔧 ÉTAPE 2 : Configuration Avant Upload

### 1. Renommer le fichier principal

```bash
# Renommer mastermentor.html en index.html
mv mastermentor.html index.html
```

**Pourquoi ?** 
- `index.html` est reconnu automatiquement comme page d'accueil
- URL : `mastermentor.fr/` au lieu de `mastermentor.fr/mastermentor.html`

### 2. Créer robots.txt

Créer un fichier `robots.txt` à la racine :

```txt
User-agent: *
Allow: /

Sitemap: https://mastermentor.fr/sitemap.xml

# Bloquer pages non essentielles
Disallow: /popup-demo.html
```

### 3. Créer sitemap.xml

Créer `sitemap.xml` :

```xml
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  
  <url>
    <loc>https://mastermentor.fr/</loc>
    <lastmod>2025-11-09</lastmod>
    <changefreq>weekly</changefreq>
    <priority>1.0</priority>
  </url>
  
  <url>
    <loc>https://mastermentor.fr/tarifs.html</loc>
    <lastmod>2025-11-09</lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.8</priority>
  </url>
  
  <url>
    <loc>https://mastermentor.fr/Charte-Integrite-Academique.html</loc>
    <lastmod>2025-11-09</lastmod>
    <changefreq>yearly</changefreq>
    <priority>0.5</priority>
  </url>
  
</urlset>
```

### 4. Vérifier les liens internes

**Dans index.html, remplacer :**
```html
<!-- Ancien -->
<a href="mastermentor.html">Retour</a>

<!-- Nouveau -->
<a href="index.html">Retour</a>
<!-- OU -->
<a href="/">Retour</a>
```

**Dans tarifs.html et Charte, vérifier :**
```html
<a href="index.html">← Retour au site principal</a>
<!-- OU -->
<a href="/">← Retour au site principal</a>
```

---

## 📊 ÉTAPE 3 : Tracking & Analytics

### Google Analytics 4

1. Créer une propriété sur [analytics.google.com](https://analytics.google.com)
2. Obtenir l'ID de mesure (format : `G-XXXXXXXXXX`)
3. Ajouter dans `<head>` de **TOUS les fichiers HTML** :

```html
<!-- Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-XXXXXXXXXX"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-XXXXXXXXXX');
</script>
```

### Tracking des Conversions

Ajouter cette fonction dans tous les fichiers :

```html
<script>
function trackWhatsAppClick(source) {
  gtag('event', 'whatsapp_click', {
    'event_category': 'conversion',
    'event_label': source
  });
}

function trackChatbotClick() {
  gtag('event', 'chatbot_click', {
    'event_category': 'support',
    'event_label': 'Chatbot Rouge'
  });
}
</script>
```

Puis modifier les liens WhatsApp :

```html
<!-- Avant -->
<a href="https://wa.me/33615078152?text=...">

<!-- Après -->
<a href="https://wa.me/33615078152?text=..." 
   onclick="trackWhatsAppClick('hero_cta')">
```

---

## 🔍 ÉTAPE 4 : SEO - Configuration Critique

### 1. Ajouter Favicon

Créer `favicon.ico` (16x16 ou 32x32 pixels) et ajouter dans `<head>` :

```html
<link rel="icon" type="image/x-icon" href="/favicon.ico">
<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
```

### 2. Ajouter Meta Tags Essentiels

**Dans index.html :**

```html
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- SEO Essentiel -->
    <title>Accompagnement Mémoire Master 2 par Docteurs | MasterMentor</title>
    <meta name="description" content="Coaching personnalisé pour réussir votre mémoire de Master 2. Accompagnement par enseignants-chercheurs docteurs. 98% de satisfaction. Diagnostic gratuit 30 min.">
    <meta name="keywords" content="aide mémoire master 2, coaching mémoire, accompagnement master, relecture mémoire, préparation soutenance">
    
    <!-- Open Graph (Facebook/LinkedIn) -->
    <meta property="og:title" content="MasterMentor | Coaching Mémoire Master 2">
    <meta property="og:description" content="Réussissez votre mémoire avec l'accompagnement d'enseignants-chercheurs docteurs.">
    <meta property="og:image" content="https://mastermentor.fr/og-image.jpg">
    <meta property="og:url" content="https://mastermentor.fr">
    <meta property="og:type" content="website">
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="MasterMentor | Coaching Mémoire Master 2">
    <meta name="twitter:description" content="Réussissez votre mémoire avec des enseignants-chercheurs docteurs.">
    <meta name="twitter:image" content="https://mastermentor.fr/og-image.jpg">
    
    <!-- Canonical -->
    <link rel="canonical" href="https://mastermentor.fr/">
    
    <!-- Schema.org JSON-LD -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "EducationalOrganization",
      "name": "MasterMentor",
      "description": "Accompagnement académique pour mémoires de Master 2 par enseignants-chercheurs docteurs",
      "url": "https://mastermentor.fr",
      "telephone": "+33615078152",
      "priceRange": "€€",
      "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "4.9",
        "reviewCount": "247"
      },
      "areaServed": {
        "@type": "Country",
        "name": "France"
      }
    }
    </script>
</head>
```

**Dans tarifs.html :**

```html
<title>Tarifs Coaching Mémoire Master 2 | À partir de 280€ | MasterMentor</title>
<meta name="description" content="Tarifs transparents pour l'accompagnement mémoire Master 2. À partir de 280€. Paiement en 10 fois. Diagnostic gratuit de 30 min.">
<link rel="canonical" href="https://mastermentor.fr/tarifs.html">
```

### 3. Créer une Image Open Graph

Dimensions : 1200x630 pixels
Nom : `og-image.jpg`
Contenu suggéré :
- Logo MasterMentor
- Texte : "Réussissez Votre Mémoire Master 2"
- "500+ Étudiants Accompagnés"

---

## 🌍 ÉTAPE 5 : Nom de Domaine

### Acheter un Domaine

**Options :**
1. **OVH** : ~10€/an pour `.fr`
2. **Namecheap** : ~12€/an
3. **Google Domains** : ~12€/an

**Nom recommandé :**
- mastermentor.fr ✅ (si disponible)
- coach-memoire.fr
- reussir-memoire.fr

### Configurer DNS

**Si hébergement Netlify :**
1. Dans Netlify : Domain Settings → Add custom domain
2. Chez votre registrar (OVH, etc.) :
   - Type A : `@` → `75.2.60.5`
   - CNAME : `www` → `votre-site.netlify.app`

**Si hébergement classique :**
1. Type A : `@` → Adresse IP serveur
2. CNAME : `www` → `@`

---

## 🔒 ÉTAPE 6 : HTTPS (SSL)

### Netlify/Vercel
✅ Automatique et gratuit (Let's Encrypt)

### Hébergement classique (OVH, etc.)
1. Activer SSL gratuit dans cPanel
2. OU utiliser Cloudflare (gratuit)

**Vérification :**
- Le site doit être accessible en `https://`
- Cadenas vert dans le navigateur

---

## 📧 ÉTAPE 7 : Email Professionnel

### Option A : Google Workspace (Recommandé)
- 6€/mois par utilisateur
- contact@mastermentor.fr
- Professionnel et crédible

### Option B : Zoho Mail (Gratuit)
- 1 domaine, 5 utilisateurs gratuits
- Fonctionnalités limitées

### Configuration
1. Ajouter enregistrements MX chez votre registrar
2. Vérifier domaine
3. Créer contact@mastermentor.fr

---

## 🧪 ÉTAPE 8 : Tests Avant Lancement

### Checklist Complète

**Fonctionnalités :**
- [ ] Tous les liens WhatsApp fonctionnent
- [ ] Chatbot rouge s'affiche (bas gauche)
- [ ] Popup urgence apparaît (après 15s ou scroll 50%)
- [ ] Tous les liens internes fonctionnent
- [ ] Footer complet sur toutes les pages
- [ ] Formulaire contact fonctionne (si présent)

**Mobile :**
- [ ] Site responsive sur iPhone
- [ ] Site responsive sur Android
- [ ] Chatbot visible et cliquable
- [ ] Popup ne bloque pas le scroll
- [ ] Boutons CTA assez grands (min 44x44px)

**Performance :**
- [ ] Tester sur [PageSpeed Insights](https://pagespeed.web.dev/)
- [ ] Score > 90 sur mobile
- [ ] Temps de chargement < 3 secondes

**SEO :**
- [ ] Tester sur [Search Console](https://search.google.com/search-console)
- [ ] Soumettre sitemap.xml
- [ ] Vérifier indexation : `site:mastermentor.fr`

**Navigateurs :**
- [ ] Chrome
- [ ] Firefox
- [ ] Safari
- [ ] Edge

---

## 🚀 ÉTAPE 9 : Déploiement

### Méthode Netlify (Recommandée)

1. **Préparer le dossier :**
```bash
mastermentor/
├── index.html (renommé depuis mastermentor.html)
├── tarifs.html
├── Charte-Integrite-Academique.html
├── robots.txt
└── sitemap.xml
```

2. **Déployer :**
- Aller sur [app.netlify.com](https://app.netlify.com)
- "Add new site" → "Deploy manually"
- Glisser-déposer le dossier
- ✅ Site en ligne !

3. **Configurer domaine personnalisé :**
- Domain settings → Add custom domain
- Suivre instructions DNS

### Méthode FTP (Hébergement classique)

1. **Installer FileZilla** : [filezilla-project.org](https://filezilla-project.org/)

2. **Se connecter :**
- Hôte : ftp.votre-hebergeur.com
- Utilisateur : votre_login
- Mot de passe : votre_mdp
- Port : 21

3. **Uploader :**
- Sélectionner tous les fichiers
- Glisser vers le dossier `public_html/` ou `www/`

---

## 📈 ÉTAPE 10 : Post-Lancement

### Jour 1
- [ ] Vérifier que le site est accessible
- [ ] Tester tous les liens
- [ ] Envoyer URL à 5 amis pour feedback
- [ ] Créer Google My Business
- [ ] Créer page Facebook

### Semaine 1
- [ ] Configurer Google Analytics
- [ ] Soumettre sitemap à Google Search Console
- [ ] Demander 10 premiers avis Google
- [ ] Premier post LinkedIn

### Mois 1
- [ ] Lancer première campagne Google Ads (500€)
- [ ] Publier 4 articles blog
- [ ] Collecter 30+ avis Google
- [ ] Analyser Google Analytics

---

## 🆘 Dépannage Courant

### Le site ne s'affiche pas
1. Vider le cache navigateur (Ctrl+Shift+R)
2. Attendre propagation DNS (24-48h)
3. Vérifier configuration DNS

### Les liens ne fonctionnent pas
1. Vérifier chemins relatifs vs absolus
2. S'assurer que `index.html` est bien renommé
3. Vérifier majuscules/minuscules dans noms fichiers

### HTTPS ne fonctionne pas
1. Attendre activation SSL (peut prendre 1h)
2. Forcer HTTPS dans paramètres hébergeur
3. Utiliser Cloudflare en proxy

### Popup ne s'affiche pas
1. Ouvrir Console navigateur (F12)
2. Chercher erreurs JavaScript
3. Vérifier que le script est bien chargé

---

## 📞 Support

**Questions ?**
- Email : support@mastermentor.fr (à créer)
- WhatsApp : +33 6 15 07 81 52

**Ressources utiles :**
- Netlify Docs : [docs.netlify.com](https://docs.netlify.com)
- Google Search Console : [search.google.com/search-console](https://search.google.com/search-console)
- PageSpeed Insights : [pagespeed.web.dev](https://pagespeed.web.dev)

---

## ✅ Checklist Finale Avant Mise en Ligne

- [ ] Fichiers HTML complets (index, tarifs, charte)
- [ ] Renommé mastermentor.html → index.html
- [ ] robots.txt créé
- [ ] sitemap.xml créé
- [ ] Meta tags SEO ajoutés
- [ ] Google Analytics configuré
- [ ] Favicon ajouté
- [ ] Liens WhatsApp avec tracking
- [ ] Testé sur mobile
- [ ] Testé sur desktop
- [ ] Tous liens internes vérifiés
- [ ] Nom de domaine acheté
- [ ] DNS configuré
- [ ] SSL activé (HTTPS)
- [ ] Email professionnel créé

---

**🎉 Félicitations ! Votre site MasterMentor est prêt pour le lancement ! 🚀**

Version : 1.0
Date : 9 novembre 2025
