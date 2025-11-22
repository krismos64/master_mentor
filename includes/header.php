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
    <a href="<?php echo $prefix; ?>contact" class="cta-nav">Diagnostic Gratuit</a>
  </nav>
</header>
