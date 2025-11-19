      // Quiz intégré
      const quizDataEmbedded = [
        {
          question: "Qu'est-ce que la méthode inductive en recherche ?",
          answers: [
            "Partir d'une théorie pour tester des hypothèses spécifiques",
            "Partir d'observations spécifiques pour construire une théorie générale",
            "Utiliser des méthodes quantitatives uniquement",
            "Analyser des données secondaires exclusivement",
          ],
          correct: 1,
          explanation:
            "La méthode inductive consiste à partir d'observations empiriques spécifiques pour élaborer progressivement une théorie générale. C'est une approche ascendante (bottom-up) qui va du particulier au général, contrairement à la méthode déductive qui part de la théorie vers le terrain.",
        },
        {
          question: "Qu'est-ce qu'une scoping review (revue exploratoire) ?",
          answers: [
            "Une revue systématique avec méta-analyse quantitative",
            "Une cartographie exploratoire de la littérature pour identifier l'étendue des connaissances",
            "Une simple liste de références bibliographiques",
            "Une analyse critique d'un seul article",
          ],
          correct: 1,
          explanation:
            "La scoping review est une méthode systématique pour cartographier les concepts clés, les types de preuves et les lacunes dans un domaine de recherche. Elle permet d'avoir une vue d'ensemble exploratoire de la littérature disponible sans nécessairement évaluer la qualité des études comme dans une revue systématique.",
        },
        {
          question: "Qu'est-ce que le diagramme PRISMA en recherche ?",
          answers: [
            "Un logiciel d'analyse statistique",
            "Un outil visuel documentant les étapes d'une revue systématique de manière transparente",
            "Une méthode de collecte de données qualitatives",
            "Un type de questionnaire pour les études",
          ],
          correct: 1,
          explanation:
            "Le diagramme de flux PRISMA (Preferred Reporting Items for Systematic Reviews and Meta-Analyses) est un outil visuel servant à documenter et présenter de manière transparente les étapes d'une revue systématique, depuis l'identification des sources initiales jusqu'à l'inclusion finale des études. Il montre le nombre d'études à chaque étape (identification, screening, éligibilité, inclusion) et les raisons d'exclusion.",
        },
        {
          question:
            "Que représente l'acronyme IMRAD dans la structure d'un article scientifique ?",
          answers: [
            "Introduction, Méthodologie, Résultats, Analyse, Discussion",
            "Introduction, Methods, Results, And Discussion",
            "Investigation, Méthode, Recherche, Analyse, Données",
            "Index, Méta-analyse, Références, Annexes, Données",
          ],
          correct: 1,
          explanation:
            "IMRAD signifie Introduction, Methods (Méthodes), Results (Résultats), And Discussion. C'est la structure standard des articles scientifiques : l'Introduction pose le contexte et la problématique, Methods décrit la méthodologie, Results présente les résultats, et Discussion interprète les résultats et leurs implications.",
        },
        {
          question:
            "Quelle est la principale fonction d'une base de données documentaire ?",
          answers: [
            "Stocker uniquement des documents personnels",
            "Indexer et permettre la recherche systématique de publications scientifiques",
            "Créer des bibliographies automatiques",
            "Publier de nouveaux articles",
          ],
          correct: 1,
          explanation:
            "Une base de données documentaire (comme Web of Science, Scopus, PubMed) permet d'indexer, organiser et rechercher systématiquement des publications scientifiques. Elle offre des outils de recherche avancée, des filtres, et des métadonnées essentielles pour identifier la littérature pertinente dans un domaine de recherche.",
        },
        {
          question: "Comment sont classées les revues scientifiques ?",
          answers: [
            "Uniquement par ordre alphabétique",
            "Par facteur d'impact, quartiles (Q1-Q4) et indexation dans des bases",
            "Par couleur de couverture",
            "Par nombre de pages publiées",
          ],
          correct: 1,
          explanation:
            "Les revues scientifiques sont classées selon plusieurs critères : le facteur d'impact (nombre moyen de citations), les quartiles (Q1 = top 25%, Q2, Q3, Q4), l'indexation dans des bases prestigieuses (Web of Science, Scopus), le processus de révision par les pairs, et parfois des classements spécifiques par discipline (liste FNEGE, CNRS, etc.).",
        },
      ];

      let currentQuestionQuiz = 0;
      let scoreQuiz = 0;
      let selectedAnswerQuiz = null;

      function initQuizEmbedded() {
        showQuestionEmbedded(0);
        updateProgressQuiz();
      }

      function showQuestionEmbedded(index) {
        const quizContent = document.getElementById("quizContentEmbedded");
        const question = quizDataEmbedded[index];

        quizContent.innerHTML = `
                <div class="question-card-quiz active">
                    <div class="question-number-quiz">Question ${
                      index + 1
                    } sur ${quizDataEmbedded.length}</div>
                    <h3 class="question-text-quiz">${question.question}</h3>
                    <div class="answers-quiz" id="answersQuiz">
                        ${question.answers
                          .map(
                            (answer, i) => `
                            <button class="answer-btn-quiz" onclick="selectAnswerQuiz(${i})" data-index="${i}">
                                <span class="answer-letter-quiz">${String.fromCharCode(
                                  65 + i
                                )}</span>
                                <span>${answer}</span>
                            </button>
                        `
                          )
                          .join("")}
                    </div>
                    <div class="explanation-quiz" id="explanationQuiz">
                        <h4>💡 Explication</h4>
                        <p>${question.explanation}</p>
                    </div>
                    <div class="quiz-navigation-embedded">
                        <button class="btn-next-quiz" id="nextBtnQuiz" onclick="nextQuestionQuiz()" disabled>
                            ${
                              index === quizDataEmbedded.length - 1
                                ? "Voir les résultats"
                                : "Question suivante →"
                            }
                        </button>
                    </div>
                </div>
            `;
      }

      function selectAnswerQuiz(index) {
        if (selectedAnswerQuiz !== null) return;

        selectedAnswerQuiz = index;
        const buttons = document.querySelectorAll(".answer-btn-quiz");
        const correctAnswer = quizDataEmbedded[currentQuestionQuiz].correct;

        buttons.forEach((btn, i) => {
          btn.classList.add("disabled");
          if (i === correctAnswer) {
            btn.classList.add("correct");
          }
          if (i === index && i !== correctAnswer) {
            btn.classList.add("incorrect");
          }
          if (i === index) {
            btn.classList.add("selected");
          }
        });

        document.getElementById("explanationQuiz").classList.add("show");
        document.getElementById("nextBtnQuiz").disabled = false;

        if (index === correctAnswer) {
          scoreQuiz++;
        }
      }

      function nextQuestionQuiz() {
        currentQuestionQuiz++;
        selectedAnswerQuiz = null;

        if (currentQuestionQuiz < quizDataEmbedded.length) {
          showQuestionEmbedded(currentQuestionQuiz);
          updateProgressQuiz();
        } else {
          showResultsQuiz();
        }
      }

      function updateProgressQuiz() {
        const progress = (currentQuestionQuiz / quizDataEmbedded.length) * 100;
        document.getElementById("progressBarQuiz").style.width = progress + "%";
      }

      function showResultsQuiz() {
        document.getElementById("quizContentEmbedded").style.display = "none";
        const resultsContainer = document.getElementById(
          "resultsContainerEmbedded"
        );
        resultsContainer.style.display = "block";

        const percentage = (scoreQuiz / quizDataEmbedded.length) * 100;
        let scoreClass, message, detail;

        if (percentage >= 80) {
          scoreClass = "excellent";
          message = "Excellent ! 🎓";
          detail =
            'Vous maîtrisez parfaitement les méthodologies de recherche. Vous êtes prêt pour votre mémoire !<br><br><strong style="color: #25D366; font-size: 1.1rem;">🎁 Félicitations ! Vous avez gagné une consultation gratuite avec un enseignant-chercheur !</strong>';
        } else if (percentage >= 60) {
          scoreClass = "good";
          message = "Bien joué ! 📚";
          detail =
            'Vous avez de bonnes bases. Un accompagnement vous aidera à perfectionner votre méthodologie.<br><br><strong style="color: #25D366; font-size: 1.1rem;">🎁 Bravo ! Vous avez gagné une consultation gratuite avec un enseignant-chercheur !</strong>';
        } else if (percentage >= 40) {
          scoreClass = "average";
          message = "À améliorer 📖";
          detail =
            'Vous avez des lacunes méthodologiques. Un coaching adapté vous permettra de progresser rapidement.<br><br><strong style="color: #25D366; font-size: 1.1rem;">🎁 Bonne nouvelle ! Vous avez gagné une consultation gratuite avec un enseignant-chercheur !</strong>';
        } else {
          scoreClass = "poor";
          message = "Besoin d'aide ? 🆘";
          detail =
            'Les méthodologies de recherche nécessitent un apprentissage. Nos enseignants-chercheurs sont là pour vous guider.<br><br><strong style="color: #25D366; font-size: 1.1rem;">🎁 Pas d\'inquiétude ! Vous avez gagné une consultation gratuite avec un enseignant-chercheur !</strong>';
        }

        resultsContainer.innerHTML = `
                <div class="score-circle-quiz ${scoreClass}">
                    <div>
                        <span>${scoreQuiz}</span>
                        <span class="score-label-quiz">/6</span>
                    </div>
                </div>
                <h3 class="results-message-quiz">${message}</h3>
                <p class="results-detail-quiz">${detail}</p>
                <div class="review-answers-quiz">
                    <button class="btn-restart-quiz" onclick="restartQuizEmbedded()">Recommencer le quiz</button>
                    <a href="https://wa.me/33615078152?text=Bonsoir%2C%20j%27ai%20gagn%C3%A9%20une%20consultation%20gratuite%20pour%20mon%20projet.%20Merci%20Master%20Mentor%20de%20me%20contacter.%20Bien%20%C3%A0%20vous%2C" target="_blank" class="btn-whatsapp-quiz">
                        <span style="margin-right: 8px;">📱</span> Réclamer ma consultation gratuite
                    </a>
                </div>
            `;

        document.getElementById("progressBarQuiz").style.width = "100%";
      }

      function restartQuizEmbedded() {
        currentQuestionQuiz = 0;
        scoreQuiz = 0;
        selectedAnswerQuiz = null;
        document.getElementById("resultsContainerEmbedded").style.display =
          "none";
        document.getElementById("quizContentEmbedded").style.display = "block";
        initQuizEmbedded();
      }

      // Initialiser le quiz au chargement de la page
      document.addEventListener("DOMContentLoaded", function () {
        initQuizEmbedded();
      });

      // FAQ Toggle
      function toggleFaq(index) {
        const faqItems = document.querySelectorAll(".faq-item");
        const clickedItem = faqItems[index];
        const isActive = clickedItem.classList.contains("active");

        // Fermer tous les items
        faqItems.forEach((item) => item.classList.remove("active"));

        // Ouvrir l'item cliqué si il n'était pas déjà ouvert
        if (!isActive) {
          clickedItem.classList.add("active");
        }
      }

      // Popup Urgence
      function showPopup() {
        document.getElementById("popupUrgence").classList.add("show");
        document.body.style.overflow = "hidden"; // Bloquer le scroll
      }

      function closePopup() {
        document.getElementById("popupUrgence").classList.remove("show");
        document.body.style.overflow = ""; // Réactiver le scroll
      }

      // Fermer le popup si on clique sur l'overlay
      document
        .getElementById("popupUrgence")
        .addEventListener("click", function (e) {
          if (e.target === this) {
            closePopup();
          }
        });

      // Fermer avec la touche Escape
      document.addEventListener("keydown", function (e) {
        if (e.key === "Escape") {
          closePopup();
        }
      });

      // Afficher le popup selon différents triggers
      let popupShown = false;

      // Trigger 1 : Après 5 secondes sur la page (à chaque visite)
      setTimeout(function () {
        if (!popupShown) {
          showPopup();
          popupShown = true;
        }
      }, 5000); // 5 secondes

      // Trigger 2 : Intention de sortie (mouvement vers le haut)
      let exitIntentTriggered = false;
      document.addEventListener("mousemove", function (e) {
        if (!popupShown && !exitIntentTriggered && e.clientY < 50) {
          exitIntentTriggered = true;
          setTimeout(function () {
            showPopup();
            popupShown = true;
          }, 500);
        }
      });

      // Trigger 3 : Après avoir scrollé 50% de la page
      let scrollTriggered = false;
      window.addEventListener("scroll", function () {
        if (!popupShown && !scrollTriggered) {
          const scrollPercent =
            (window.scrollY /
              (document.body.scrollHeight - window.innerHeight)) *
            100;
          if (scrollPercent > 50) {
            scrollTriggered = true;
            showPopup();
            popupShown = true;
          }
        }
      });
