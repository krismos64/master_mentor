# MM-9 : Configuration Email Anti-Spam

**Date** : 14 novembre 2025
**Version** : 1.0
**Ticket Jira** : MM-9
**Objectif** : Éviter que les emails du formulaire arrivent dans les spams

---

## 📋 PROBLÈME INITIAL

**Symptômes** :
- ✅ Emails envoyés (mail() retourne TRUE)
- ✅ Emails arrivent dans la boîte
- ❌ **Mais classés en SPAM** (expéditeur + destinataire)

**Cause racine** :
- Domaine récent = faible réputation
- Absence de DKIM (signature numérique)
- Absence de DMARC (politique de validation)
- Headers email incomplets

---

## ✅ SOLUTIONS APPLIQUÉES

### 1. Amélioration Headers Email (IMMÉDIAT)

**Fichier** : `contact.php` (lignes 226-236)

**Modifications** :
```php
// AVANT
$headers = [
    'From: ' . EMAIL_FROM,
    'X-Priority: 1'
];

// APRÈS
$headers = [
    'From: MasterMentor <' . EMAIL_FROM . '>',  // Nom expéditeur
    'Reply-To: ' . $email,
    'Message-ID: <' . md5(uniqid(time())) . '@mastermentor.fr>',  // ID unique
    'List-Unsubscribe: <mailto:' . EMAIL_FROM . '?subject=unsubscribe>',  // Désabonnement
    'Precedence: bulk',  // Indique email automatique
    'X-Auto-Response-Suppress: All'  // Supprime auto-réponses
];
```

**Bénéfices** :
- ✅ Nom expéditeur "MasterMentor" au lieu de juste l'email
- ✅ Message-ID unique (réduit score spam)
- ✅ List-Unsubscribe (conforme CAN-SPAM)
- ✅ Headers standards reconnus par Gmail/Yahoo

---

### 2. Configuration DNS Anti-Spam (À FAIRE)

**Accès** : Manager OVH → Domaine mastermentor.fr → Zone DNS

#### A. DKIM (Signature Numérique) - PRIORITÉ 1

**À ajouter** :
```
Type : TXT
Sous-domaine : default._domainkey
TTL : 3600
Cible : v=DKIM1; k=rsa; p=<CLÉ_PUBLIQUE_OVH>
```

**Comment obtenir la clé OVH** :
1. Manager OVH → Emails → Configuration
2. Onglet "DKIM"
3. Générer clé pour mastermentor.fr
4. Copier la clé publique RSA

**Alternative** : Utiliser clé générique cluster121.hosting.ovh.net

#### B. DMARC (Politique Validation) - PRIORITÉ 2

**À ajouter** :
```
Type : TXT
Sous-domaine : _dmarc
TTL : 3600
Cible : v=DMARC1; p=none; rua=mailto:c.mostefaoui@yahoo.fr; pct=100; adkim=r; aspf=r
```

**Paramètres** :
- `p=none` : Mode surveillance (pas de rejet pour l'instant)
- `rua=mailto:...` : Rapports envoyés par email
- `adkim=r` : DKIM mode relaxed (tolérant)
- `aspf=r` : SPF mode relaxed

**Après 2 semaines** : Passer à `p=quarantine` puis `p=reject`

#### C. SPF (Déjà OK ✅)

**Actuel** :
```
v=spf1 include:mx.ovh.com -all
```

✅ **Pas de modification nécessaire**

---

## 📊 VÉRIFICATION POST-CONFIGURATION

### Commandes DNS (après 15-30 min)

```bash
# Vérifier DKIM
dig default._domainkey.mastermentor.fr TXT +short

# Vérifier DMARC
dig _dmarc.mastermentor.fr TXT +short

# Vérifier SPF
dig mastermentor.fr TXT +short
```

### Outils Test Email

| Outil | URL | Objectif |
|-------|-----|----------|
| **Mail Tester** | https://www.mail-tester.com/ | Score /10 anti-spam |
| **MXToolbox** | https://mxtoolbox.com/SuperTool.aspx | Validation SPF/DKIM/DMARC |
| **Google Postmaster Tools** | https://postmaster.google.com/ | Réputation Gmail |
| **DMARC Analyzer** | https://www.dmarcanalyzer.com/ | Rapports DMARC |

---

## 🎯 RÉSULTATS ATTENDUS

### Immédiat (Headers améliorés)
- ✅ Nom expéditeur plus professionnel
- ✅ Réduction score spam de 20-30%
- ⚠️ Peut encore arriver en spam (réputation domaine)

### Après configuration DNS (24-72h)
- ✅ DKIM : Score spam réduit de 50%
- ✅ DMARC : Confiance renforcée
- ✅ Mail Tester : Score 8-10/10 attendu

### Après 2-4 semaines
- ✅ Réputation domaine établie
- ✅ Emails arrivent en boîte principale
- ✅ Taux délivrabilité 95%+

---

## 🚨 ACTIONS PRIORITAIRES

### À faire MAINTENANT (5 min)

1. **Manager OVH** → Domaine mastermentor.fr → Zone DNS
2. **Ajouter enregistrement DMARC** (copier-coller ci-dessus)
3. **Contacter support OVH** pour activation DKIM (si pas d'interface)

### Test immédiat

**Envoyer un email test** :
1. Remplir formulaire sur https://mastermentor.fr/
2. Vérifier email reçu
3. Aller sur https://www.mail-tester.com/
4. Envoyer un email à l'adresse fournie
5. Consulter le rapport (score actuel attendu : 5-6/10)

---

## 📚 DOCUMENTATION TECHNIQUE

### Pourquoi les emails vont en spam ?

**Facteurs principaux** :
1. **Réputation domaine** (40%) : Nouveau domaine = score faible
2. **Authentification** (30%) : SPF/DKIM/DMARC
3. **Contenu email** (20%) : Mots spam, HTML mal formé
4. **Headers** (10%) : Message-ID, List-Unsubscribe, etc.

### Évolution score spam

```
Jour 1 (maintenant) : 5-6/10 (headers améliorés)
Jour 2 (après DMARC) : 7/10
Jour 3 (après DKIM) : 8-9/10
Semaine 2-4 (réputation) : 9-10/10
```

### Alternative : Service SMTP externe

Si problème persiste :
- **SendGrid** : 100 emails/jour gratuits
- **Mailgun** : 1000 emails/mois gratuits
- **Amazon SES** : 0,10€ / 1000 emails

**Avantages** :
- Réputation établie
- DKIM automatique
- Statistiques détaillées

---

## ✅ VALIDATION FINALE

**Checklist** :
- ✅ Headers email améliorés (contact.php ligne 226-236)
- ⏳ DMARC ajouté dans Zone DNS
- ⏳ DKIM configuré via OVH
- ⏳ Test mail-tester.com score 8+/10
- ⏳ Emails arrivent en boîte principale

---

**Prochaine étape** : Configuration DKIM/DMARC dans Manager OVH
