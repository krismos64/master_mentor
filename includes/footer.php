<?php
// Détecter la page courante pour adapter les liens de navigation
$current_page = basename($_SERVER['PHP_SELF']);
$is_index = ($current_page === 'index.php');
$prefix = $is_index ? '#' : 'index.php#';
?>
<!-- Footer -->
<footer>
  <div class="footer-content">
    <div class="footer-top">
      <div class="footer-section footer-section-logo">
        <div class="logo footer-logo-container">
          <img
            src="assets/logos/logo-main.png"
            alt="MasterMentor"
            class="logo-img-footer"
            width="220"
            height="auto"
          />
        </div>
      </div>

      <div class="footer-section">
        <h4>À propos</h4>
        <p>
          Master Mentor au service de la réussite de votre mémoire depuis
          2007. Méthodologie, structuration, soutenance : un accompagnement
          complet et personnalisé.
        </p>
        <p class="payment-title-inline">Moyens de paiement acceptés</p>
        <div class="payment-icons-inline">
          <picture>
            <source srcset="assets/logos/paiement/visa.webp" type="image/webp">
            <img src="assets/logos/paiement/visa.png" alt="Visa" loading="lazy" width="50" height="23">
          </picture>
          <picture>
            <source srcset="assets/logos/paiement/mastercard.webp" type="image/webp">
            <img src="assets/logos/paiement/mastercard.png" alt="Mastercard" loading="lazy" width="41" height="23">
          </picture>
          <picture>
            <source srcset="assets/logos/paiement/paypal.webp" type="image/webp">
            <img src="assets/logos/paiement/paypal.png" alt="PayPal" loading="lazy" width="30" height="23">
          </picture>
        </div>
      </div>

      <div class="footer-section">
        <h4>Navigation</h4>
        <div class="footer-nav-list">
          <a href="<?php echo $prefix; ?>disciplines" class="footer-nav-link">Disciplines</a>
          <a href="<?php echo $prefix; ?>equipe" class="footer-nav-link">L'Équipe</a>
          <a href="/tarifs" class="footer-nav-link">Tarifs</a>
          <a href="<?php echo $prefix; ?>methode" class="footer-nav-link">Notre Méthode</a>
          <a href="<?php echo $prefix; ?>temoignages" class="footer-nav-link">Témoignages</a>
          <a href="<?php echo $prefix; ?>contact" class="footer-nav-link">Contact</a>
        </div>
      </div>

      <div class="footer-section">
        <h4>Nos Garanties</h4>
        <div class="footer-guarantees-list">
          <div>✓ 100% Docteurs</div>
          <div>✓ Satisfait ou remboursé</div>
          <div>✓ Sans IA ni plagiat</div>
          <div>✓ 100% Confidentiel</div>
          <div>✓ 17 ans d'expérience</div>
        </div>
      </div>
    </div>

    <div class="footer-certifications-row">
      <a href="https://www.ekomi.de/" target="_blank" rel="noopener noreferrer" class="certification-logo certification-logo-lg" title="eKomi - Avis clients vérifiés">
        <picture>
          <source srcset="assets/logos/certifications/ekomi.webp" type="image/webp" />
          <img src="assets/logos/certifications/ekomi.png" alt="eKomi - Avis clients vérifiés - Note 4.9/5" loading="lazy" width="60" height="60" />
        </picture>
      </a>
      <a href="https://fr.trustpilot.com/review/staka.fr" target="_blank" rel="noopener noreferrer" class="certification-logo" title="Trustpilot - Notation publique">
        <picture>
          <source srcset="assets/logos/certifications/trustpilot.webp" type="image/webp" />
          <img src="assets/logos/certifications/trustpilot.png" alt="Trustpilot - Notation publique - Note 4.8/5" loading="lazy" width="245" height="60" />
        </picture>
      </a>
      <a href="https://www.compilatio.net/" target="_blank" rel="noopener noreferrer" class="certification-logo certification-logo-lg" title="Compilatio - Détection plagiat">
        <picture>
          <source srcset="assets/logos/certifications/compilatio.webp" type="image/webp" />
          <img src="assets/logos/certifications/compilatio.png" alt="Compilatio - Logiciel de détection de plagiat" loading="lazy" width="128" height="60" />
        </picture>
      </a>
      <a href="https://lucide.ai/" target="_blank" rel="noopener noreferrer" class="certification-logo" title="Lucide.ai - Technologie IA">
        <picture>
          <source srcset="assets/logos/certifications/lucide.webp" type="image/webp" />
          <img src="assets/logos/certifications/lucide.png" alt="Lucide.ai - Certification contenu sans IA générative" loading="lazy" width="227" height="60" />
        </picture>
      </a>
    </div>

    <div class="footer-links">
      <a href="/charte-integrite-academique">Charte d'Intégrité Académique</a>
      <a href="/mentions-legales">Mentions Légales</a>
      <a href="/cgu">CGU</a>
    </div>

    <div class="footer-bottom">
      <p>
        &copy; 2007-2025 MasterMentor - Un site du groupe Staka. Tous droits
        réservés.
      </p>
      <p class="mt-1">
        Coaching académique par des enseignants-chercheurs docteurs français
      </p>
      <p class="footer-values">
        100% Français • Éthique • Exigeant • 100% Confidentiel
      </p>
    </div>
  </div>
</footer>
