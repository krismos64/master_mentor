      // Soumission AJAX du formulaire de contact
      function submitFormAjax(event) {
        event.preventDefault();

        // Réinitialiser toutes les erreurs
        const errorMessages = document.querySelectorAll('.error-message');
        errorMessages.forEach(error => {
          error.style.display = 'none';
          error.textContent = '';
        });

        let isValid = true;

        // Validation Nom et Prénom
        const name = document.getElementById('name');
        const nameError = document.getElementById('name-error');
        if (!name.value.trim()) {
          nameError.textContent = 'Le nom et prénom sont requis';
          nameError.style.display = 'block';
          isValid = false;
        } else if (name.value.trim().length < 2) {
          nameError.textContent = 'Le nom doit contenir au moins 2 caractères';
          nameError.style.display = 'block';
          isValid = false;
        }

        // Validation Email
        const email = document.getElementById('email');
        const emailError = document.getElementById('email-error');
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!email.value.trim()) {
          emailError.textContent = 'L\'email est requis';
          emailError.style.display = 'block';
          isValid = false;
        } else if (!emailRegex.test(email.value.trim())) {
          emailError.textContent = 'Veuillez entrer un email valide';
          emailError.style.display = 'block';
          isValid = false;
        }

        // Validation Téléphone (International)
        const phone = document.getElementById('phone');
        const phoneError = document.getElementById('phone-error');
        // Accepte tous formats internationaux : +33, +1, 01, 06, etc. (8-20 caractères)
        const phoneRegex = /^[0-9\s\+\-\.\(\)]{8,20}$/;
        const phoneValue = phone.value.trim();
        if (!phoneValue) {
          phoneError.textContent = 'Le téléphone est requis';
          phoneError.style.display = 'block';
          isValid = false;
        } else if (!phoneRegex.test(phoneValue)) {
          phoneError.textContent = 'Numéro invalide (minimum 8 chiffres)';
          phoneError.style.display = 'block';
          isValid = false;
        }

        // Validation Discipline
        const discipline = document.getElementById('discipline');
        const disciplineError = document.getElementById('discipline-error');
        if (!discipline.value) {
          disciplineError.textContent = 'Veuillez sélectionner une discipline';
          disciplineError.style.display = 'block';
          isValid = false;
        }

        // Si erreurs, arrêter
        if (!isValid) {
          return false;
        }

        // UX pendant envoi
        const submitBtn = document.getElementById('submit-btn');
        const originalText = submitBtn.textContent;
        submitBtn.disabled = true;
        submitBtn.textContent = 'Envoi en cours...';

        // Préparation des données
        const formData = new FormData(event.target);

        // Envoi AJAX vers contact.php
        fetch('contact.php', {
          method: 'POST',
          body: formData
        })
        .then(response => {
          if (!response.ok) {
            throw new Error('Erreur réseau');
          }
          return response.json();
        })
        .then(data => {
          if (data.success) {
            // Tracking conversion Google Analytics si disponible
            if (typeof gtag !== 'undefined') {
              gtag('event', 'conversion', {
                send_to: 'VOTRE_ID_CONVERSION',
                value: 1.0,
                currency: 'EUR',
                event_category: 'Form',
                event_label: 'Contact Form Submitted'
              });
            }

            // Redirection vers page de remerciement
            window.location.href = 'merci.html';
          } else {
            // Afficher le message d'erreur du serveur
            alert(data.message || 'Erreur lors de l\'envoi. Veuillez réessayer.');
            submitBtn.disabled = false;
            submitBtn.textContent = originalText;
          }
        })
        .catch(error => {
          console.error('Erreur:', error);
          alert('Erreur de connexion. Veuillez vérifier votre connexion internet et réessayer.');
          submitBtn.disabled = false;
          submitBtn.textContent = originalText;
        });

        return false;
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

      // Header sticky avec effet (optimisé avec requestAnimationFrame)
      let lastScroll = 0;
      let ticking = false;
      const header = document.querySelector("header");

      const updateHeader = () => {
        const currentScroll = window.pageYOffset;

        if (currentScroll > 100) {
          header.style.boxShadow = "0 4px 20px rgba(0,0,0,0.1)";
        } else {
          header.style.boxShadow = "0 2px 10px rgba(0,0,0,0.1)";
        }

        lastScroll = currentScroll;
        ticking = false;
      };

      window.addEventListener("scroll", () => {
        if (!ticking) {
          window.requestAnimationFrame(updateHeader);
          ticking = true;
        }
      }, { passive: true });

      // Note: Menu burger code moved to inline critical JS in index.html for better UX
