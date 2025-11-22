# 🚀 Checklist Déploiement - MasterMentor sur OVH

**Domaine** : mastermentor.fr
**Hébergement** : OVH (mutualisé)
**IP Serveur** : 213.186.33.5
**Version** : 1.2
**Date** : 14 novembre 2025

---

## 📦 1. FICHIERS À UPLOADER

### Structure Complète du Projet

```
mastermentor.fr/
├── 📄 index.html                          ✅ Page d'accueil principale
├── 📄 tarifs.html                         ✅ Page tarifs et offres
├── 📄 popup-demo.html                     ✅ Démo popup urgence
├── 📄 Charte-Integrite-Academique.html    ✅ Charte éthique
├── 📄 merci.html                          ✅ Page confirmation formulaire
├── 📄 contact.php                         ✅ Backend formulaire sécurisé
├── 📄 robots.txt                          ✅ SEO robots Google
├── 📄 sitemap.xml                         ✅ Sitemap XML (4 pages)
├── 📄 .htaccess                           ✅ Configuration Apache
│
├── 📁 assets/
│   ├── 📁 css/
│   │   ├── styles.css                    ✅ CSS principal
│   │   ├── styles.min.css                ✅ Version minifiée
│   │   ├── integrations.css              ✅ CSS intégrations
│   │   ├── integrations.min.css          ✅ Version minifiée
│   │   ├── tarifs.css                    ✅ CSS page tarifs
│   │   ├── charte.css                    ✅ CSS page charte
│   │   ├── popup-demo.css                ✅ CSS popup démo
│   │   ├── merci.css                     ✅ CSS page merci
│   │   └── merci.min.css                 ✅ Version minifiée
│   │
│   ├── 📁 js/
│   │   ├── main.js                       ✅ Core UI JavaScript
│   │   ├── main.min.js                   ✅ Version minifiée
│   │   ├── quiz.js                       ✅ Module quiz interactif
│   │   └── quiz.min.js                   ✅ Version minifiée
│   │
│   ├── 📁 images/
│   │   ├── hero-background.webp          ✅ Image hero optimisée
│   │   ├── logo-master-mentor.png        ✅ Logo principal
│   │   ├── trustpilot-stars.webp         ✅ Étoiles Trustpilot
│   │   ├── accompagnement-methodo.webp   ✅ Image méthodologie
│   │   ├── coaching-redaction.webp       ✅ Image coaching
│   │   ├── revision-correction.webp      ✅ Image révision
│   │   └── [tous les autres .webp/.png]  ✅ Toutes images optimisées
│   │
│   ├── 📁 icons/
│   │   ├── favicon.ico                   ✅ Favicon 32x32
│   │   ├── favicon-16x16.png             ✅ Favicon petite taille
│   │   ├── favicon-32x32.png             ✅ Favicon taille moyenne
│   │   ├── apple-touch-icon.png          ✅ Icône iOS (180x180)
│   │   ├── android-chrome-192x192.png    ✅ Icône Android
│   │   └── android-chrome-512x512.png    ✅ Icône Android HD
│   │
│   └── 📁 logos/
│       ├── logo-mastermentor-white.svg   ✅ Logo blanc vectoriel
│       └── logo-mastermentor-color.svg   ✅ Logo couleur vectoriel
```

**Total fichiers à uploader** : ~40 fichiers

---

## ❌ 2. FICHIERS À EXCLURE (NE PAS UPLOADER)

```
❌ .git/                    # Versioning Git (local uniquement)
❌ .gitignore               # Configuration Git
❌ node_modules/            # Dépendances npm (si existant)
❌ docs/                    # Documentation technique privée
❌ README.md                # Documentation projet
❌ CHANGELOG.md             # Historique versions
❌ DEPLOY_CHECKLIST.md      # Ce fichier (guide déploiement)
❌ .env                     # Variables d'environnement (si existant)
❌ .vscode/                 # Configuration éditeur
❌ .DS_Store                # Fichiers système macOS
❌ *.log                    # Fichiers logs
❌ *.bak                    # Fichiers backup
❌ *~                       # Fichiers temporaires
```

---

## 🔐 3. PERMISSIONS FICHIERS (CHMOD)

### Permissions Recommandées

**Fichiers HTML, PHP, CSS, JS, XML, TXT** :

```bash
chmod 644 index.html
chmod 644 tarifs.html
chmod 644 popup-demo.html
chmod 644 Charte-Integrite-Academique.html
chmod 644 merci.html
chmod 644 contact.php
chmod 644 robots.txt
chmod 644 sitemap.xml
chmod 644 .htaccess
chmod 644 assets/css/*.css
chmod 644 assets/js/*.js
```

**Dossiers** :

```bash
chmod 755 assets/
chmod 755 assets/css/
chmod 755 assets/js/
chmod 755 assets/images/
chmod 755 assets/icons/
chmod 755 assets/logos/
```

**Images et fichiers binaires** :

```bash
chmod 644 assets/images/*
chmod 644 assets/icons/*
chmod 644 assets/logos/*
```

### Résumé Permissions

- **644** (rw-r--r--) : Fichiers HTML, PHP, CSS, JS, images → Lecture publique, écriture propriétaire
- **755** (rwxr-xr-x) : Dossiers → Exécution + lecture publique, écriture propriétaire

---

## ✅ 4. CHECKLIST POST-DÉPLOIEMENT (25 POINTS)

### 4.1 Accessibilité & SSL (5 points)

- [ ] **1.** Site accessible sur `http://mastermentor.fr` (redirection HTTPS ?)
- [ ] **2.** Site accessible sur `https://mastermentor.fr` (SSL valide ?)
- [ ] **3.** Redirection `www.mastermentor.fr` → `mastermentor.fr` (canonique)
- [ ] **4.** Certificat SSL valide (cadenas vert dans navigateur)
- [ ] **5.** Tester avec SSL Labs : https://www.ssllabs.com/ssltest/ (A+ souhaité)

### 4.2 Navigation & Pages (5 points)

- [ ] **6.** Page d'accueil `index.html` s'affiche correctement
- [ ] **7.** Page tarifs `tarifs.html` accessible et fonctionnelle
- [ ] **8.** Page charte `Charte-Integrite-Academique.html` accessible
- [ ] **9.** Popup démo `popup-demo.html` fonctionne (timer, scroll, exit intent)
- [ ] **10.** Page confirmation `merci.html` affiche checkmark animé

### 4.3 Formulaire de Contact (5 points)

- [ ] **11.** Formulaire contact visible et stylisé
- [ ] **12.** Validation côté client fonctionne (champs obligatoires)
- [ ] **13.** Envoi formulaire réussi (pas d'erreur PHP)
- [ ] **14.** Email reçu sur `contact@staka.fr` avec toutes les données
- [ ] **15.** Email confirmation client reçu (si configuré)

### 4.4 Interactivité (3 points)

- [ ] **16.** Quiz fonctionne (6 questions + résultats)
- [ ] **17.** Menu burger mobile fonctionne (overlay, fermeture)
- [ ] **18.** Animations au scroll actives (fade-in, slide-up)

### 4.5 Responsive Design (3 points)

- [ ] **19.** Test mobile 320px-767px (Chrome DevTools)
- [ ] **20.** Test tablette 768px-1023px
- [ ] **21.** Test desktop 1024px+ (affichage optimal)

### 4.6 Performance & SEO (4 points)

- [ ] **22.** Google PageSpeed Insights : 85+ Performance, 90+ Accessibility, 90+ SEO
- [ ] **23.** Compression Gzip active (vérifier headers : `Content-Encoding: gzip`)
- [ ] **24.** Cache navigateur actif (vérifier headers : `Cache-Control`)
- [ ] **25.** `robots.txt` accessible : https://mastermentor.fr/robots.txt

---

## 🛠️ 5. OUTILS DE TEST

### Tests Automatiques

| Outil                    | URL                                            | Objectif                        |
| ------------------------ | ---------------------------------------------- | ------------------------------- |
| **PageSpeed Insights**   | https://pagespeed.web.dev/                     | Performance, Accessibility, SEO |
| **GTmetrix**             | https://gtmetrix.com/                          | Performance globale             |
| **SSL Labs**             | https://www.ssllabs.com/ssltest/               | Sécurité SSL/TLS                |
| **Security Headers**     | https://securityheaders.com/                   | Headers sécurité                |
| **W3C HTML Validator**   | https://validator.w3.org/nu/                   | Validation HTML5                |
| **Mobile-Friendly Test** | https://search.google.com/test/mobile-friendly | Compatibilité mobile            |

### Tests Manuels

- **Chrome DevTools** : Console (0 erreur), Network (compression, cache), Lighthouse
- **Firefox Developer Tools** : Console, Responsive Design Mode
- **Safari** : Tests macOS + iOS (si disponible)
- **Tests réels** : Smartphone Android + iPhone (idéal)

---

## 📊 6. CRITÈRES DE SUCCÈS

### Performance (Lighthouse)

- ✅ **Performance** : 85-92
- ✅ **Accessibility** : 90+
- ✅ **Best Practices** : 90+
- ✅ **SEO** : 85+

### Sécurité

- ✅ Headers sécurité actifs (X-XSS-Protection, X-Frame-Options, etc.)
- ✅ SSL/TLS Grade A ou A+
- ✅ Aucune erreur console navigateur

### Fonctionnel

- ✅ Formulaire envoie emails correctement
- ✅ Quiz interactif fonctionne sans erreur
- ✅ Menu burger mobile opérationnel
- ✅ Toutes les pages accessibles

---

## 🔄 7. PROCÉDURE DE MISE À JOUR FUTURE

### Upload fichiers modifiés uniquement (via FTP)

**Exemple : Mise à jour CSS**

```bash
# 1. Connexion FTP
# 2. Naviguer vers /assets/css/
# 3. Uploader styles.min.css (écrase ancien)
# 4. Vider cache navigateur + test
```

**Exemple : Ajout nouvelle page**

```bash
# 1. Uploader nouvelle-page.html à la racine
# 2. Mettre à jour sitemap.xml (ajouter URL)
# 3. Uploader sitemap.xml
# 4. Soumettre nouveau sitemap à Google Search Console
```

### Commandes Git Recommandées

```bash
# Avant déploiement : commit local
git add .
git commit -m "MM-8: Mise à jour production [description]"
git push origin main

# Créer tag version
git tag -a v1.2 -m "Version 1.2 - MM-6 complété"
git push origin v1.2
```

---

## ⚠️ 8. POINTS DE VIGILANCE

### Emails

- **Problème potentiel** : Si `EMAIL_FROM = noreply@mastermentor.fr`, risque de rejet par serveurs emails
- **Solution actuelle** : `EMAIL_FROM = contact@staka.fr` (validé ✅)
- **Alternative** : Configurer SMTP externe (Gmail, SendGrid, Mailgun)

### Rate Limiting

- **Mécanisme** : Fichier `/tmp/contact_rate_limit.txt` stocke IPs
- **Surveillance** : Vérifier fonctionnement après 1er envoi
- **Alternative** : Utiliser base SQLite ou session PHP

### Propagation DNS

- **Nouveau domaine** : Peut prendre 24-48h pour propagation mondiale
- **Test anticipé** : Modifier fichier `/etc/hosts` local pour tester avant propagation

### PHP Version

- **Minimum requis** : PHP 7.4+
- **Recommandé** : PHP 8.1+ pour performances optimales
- **Vérification** : cPanel → Sélection version PHP

---

## 📚 9. DOCUMENTATION COMPLÉMENTAIRE

### Fichiers Documentation

- `/docs/MM-6-Validation-W3C.md` : Rapport validation HTML5
- `/docs/MM-5-Formulaire-contact-FormSubmit.md` : Documentation formulaire PHP
- `/docs/MM-4-Integrations-externes.md` : Google Analytics, Trustpilot

### Liens Utiles

- **Manager OVH** : https://www.ovh.com/manager/
- **cPanel OVH** : https://[votre-cluster].hosting.ovh.net:2083/
- **Google Search Console** : https://search.google.com/search-console
- **Google Analytics** : https://analytics.google.com/

---

## ✅ VALIDATION FINALE

**Déploiement réussi si :**

- ✅ 25/25 points checklist post-déploiement validés
- ✅ Lighthouse 85+ sur tous les scores
- ✅ 0 erreur console navigateur
- ✅ Formulaire envoie emails sans erreur
- ✅ SSL/TLS Grade A ou A+
- ✅ W3C HTML5 100% conforme (5/5 fichiers)

---

**Dernière mise à jour** : 14 novembre 2025
**Version déploiement** : 1.2 (MM-6 complété)
**Prochaine étape** : MM-8 - Déploiement effectif sur OVH

---

## 🚀 COMMANDES FTP RAPIDES

### Connexion FileZilla

```
Hôte : ftp.mastermentor.fr ou ftp.cluster0XX.hosting.ovh.net
Protocole : FTPS (FTP over TLS)
Port : 21
Utilisateur : [fourni par OVH]
Mot de passe : [fourni par OVH]
```

### Upload Rapide (ligne de commande alternative)

```bash
# Alternative : lftp (à installer : brew install lftp)
lftp -u username,password ftps://ftp.mastermentor.fr
lcd /Users/chris/Documents/sites/master_mentor
cd /www/mastermentor
mirror -R --only-newer --exclude .git/ --exclude docs/
bye
```

---

**🎯 Objectif** : Site 100% opérationnel sur https://mastermentor.fr en production OVH !
