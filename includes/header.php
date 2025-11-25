<?php
// Détecter la page courante pour adapter les liens de navigation
$current_page = basename($_SERVER['PHP_SELF']);
$is_index = ($current_page === 'index.php');
$prefix = $is_index ? '#' : 'index.php#';
?>
<!-- Header -->
<header>
  <nav>
    <div class="logo">
      <a href="index.php" title="Retour à l'accueil">
        <img
          src="assets/logos/logo-main.png"
          alt="MasterMentor - Retour à l'accueil"
          class="logo-img"
          width="240"
          height="auto"
        />
      </a>
    </div>
    <button
      class="menu-toggle"
      aria-label="Toggle navigation menu"
      aria-expanded="false"
    >
      <span></span>
      <span></span>
      <span></span>
    </button>
    <ul class="nav-links">
      <li><a href="<?php echo $prefix; ?>disciplines">Disciplines</a></li>
      <li><a href="<?php echo $prefix; ?>equipe">L'Équipe</a></li>
      <li><a href="<?php echo $prefix; ?>quiz">Quiz</a></li>
      <li><a href="tarifs.php">Tarifs</a></li>
      <li><a href="<?php echo $prefix; ?>methode">Notre Méthode</a></li>
      <li><a href="<?php echo $prefix; ?>temoignages">Témoignages</a></li>
      <li><a href="<?php echo $prefix; ?>contact">Contact</a></li>
    </ul>
    <div class="header-actions">
      <a href="tel:+33184255678" class="phone-number" aria-label="Appelez-nous au +33 1 84 25 56 78">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
          <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
        </svg>
        <span class="phone-text">+33 1 84 25 56 78</span>
      </a>
      <a href="<?php echo $prefix; ?>contact" class="cta-nav">Diagnostic Gratuit</a>
    </div>
  </nav>
</header>
