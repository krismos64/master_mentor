      // Gestion du formulaire
      function handleSubmit(event) {
        event.preventDefault();

        // Récupération des données du formulaire
        const formData = new FormData(event.target);
        const data = Object.fromEntries(formData);

        // Simulation d'envoi (à remplacer par votre système backend)
        // TODO: Intégrer système backend

        // Message de confirmation
        alert(
          "Merci pour votre demande ! Nous vous contactons sous 24h pour planifier votre diagnostic gratuit."
        );

        // Réinitialisation du formulaire
        event.target.reset();

        // Tracking conversion (à intégrer avec votre outil analytics)
        if (typeof gtag !== "undefined") {
          gtag("event", "conversion", {
            send_to: "VOTRE_ID_CONVERSION",
            value: 1.0,
            currency: "EUR",
          });
        }
      }

      // Animation au scroll
      const observerOptions = {
        threshold: 0.1,
        rootMargin: "0px 0px -50px 0px",
      };

      const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.style.opacity = "1";
            entry.target.style.transform = "translateY(0)";
          }
        });
      }, observerOptions);

      document
        .querySelectorAll(
          ".discipline-card, .diff-card, .step, .testimonial-card"
        )
        .forEach((el) => {
          el.style.opacity = "0";
          el.style.transform = "translateY(30px)";
          el.style.transition = "all 0.6s ease-out";
          observer.observe(el);
        });

      // Smooth scroll pour les liens d'ancrage
      document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
        anchor.addEventListener("click", function (e) {
          e.preventDefault();
          const target = document.querySelector(this.getAttribute("href"));
          if (target) {
            target.scrollIntoView({
              behavior: "smooth",
              block: "start",
            });
          }
        });
      });

      // Header sticky avec effet
      let lastScroll = 0;
      const header = document.querySelector("header");

      window.addEventListener("scroll", () => {
        const currentScroll = window.pageYOffset;

        if (currentScroll > 100) {
          header.style.boxShadow = "0 4px 20px rgba(0,0,0,0.1)";
        } else {
          header.style.boxShadow = "0 2px 10px rgba(0,0,0,0.1)";
        }

        lastScroll = currentScroll;
      });

      // Menu burger mobile
      const menuToggle = document.querySelector('.menu-toggle');
      const navLinks = document.querySelector('.nav-links');
      const body = document.body;

      const toggleMenu = () => {
        menuToggle.classList.toggle('active');
        navLinks.classList.toggle('active');
        body.classList.toggle('menu-open');

        // Accessibilité : mise à jour aria-expanded
        const isExpanded = menuToggle.classList.contains('active');
        menuToggle.setAttribute('aria-expanded', isExpanded);
      };

      const closeMenu = () => {
        menuToggle.classList.remove('active');
        navLinks.classList.remove('active');
        body.classList.remove('menu-open');
        menuToggle.setAttribute('aria-expanded', 'false');
      };

      // Toggle menu au clic du burger
      if (menuToggle) {
        menuToggle.addEventListener('click', toggleMenu);
      }

      // Fermer le menu au clic sur un lien
      if (navLinks) {
        navLinks.querySelectorAll('a').forEach(link => {
          link.addEventListener('click', closeMenu);
        });
      }

      // Fermer le menu au clic sur l'overlay (body::before)
      body.addEventListener('click', (e) => {
        if (body.classList.contains('menu-open') &&
            !navLinks.contains(e.target) &&
            !menuToggle.contains(e.target)) {
          closeMenu();
        }
      });

      // Fermer le menu avec la touche Escape
      document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && body.classList.contains('menu-open')) {
          closeMenu();
        }
      });
