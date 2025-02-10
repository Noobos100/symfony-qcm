<?php

namespace App\DataFixtures;

use App\Entity\Dynamicqcm;
use App\Entity\Question;
use App\Entity\Answers;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $list_of_themes = ['SCRUM_AGILITE', 'KANBAN', 'LEAN', 'XP', 'FDD', 'DSDM', 'TDD', 'ATDD', 'BDD', 'SAFe', 'LESS', 'NEXUS', 'DA', 'PMI', 'PRINCE2', 'PMBOK', 'ITIL', 'COBIT', 'ISO', 'CEMM', 'TOGAF', 'ARCHIMATE', 'UML', 'SYSML', 'BPMN', 'DMN', 'CMMI', 'SPICE'];

        $list_of_languages = ['ENGLISH', 'FRENCH', 'SPANISH', 'GERMAN', 'ITALIAN', 'PORTUGUESE', 'DUTCH', 'RUSSIAN', 'CHINESE', 'JAPANESE', 'KOREAN', 'ARABIC'];

        // Liste de questions possibles
        $questions = [
            "Qu'est-ce que {theme}?",
            "Quels sont les principes de base de {theme}?",
            "Comment {theme} est-il appliqué dans {language}?",
            "Quels sont les avantages de {theme}?",
            "Quels sont les défis courants dans l'application de {theme}?",
            "Comment {theme} se compare-t-il à d'autres méthodologies?",
            "Quels sont les outils couramment utilisés dans {theme}?",
            "Quels sont les rôles typiques dans une équipe {theme}?",
            "Quelles sont les meilleures pratiques pour {theme}?",
            "Comment {theme} est-il enseigné en {language}?"
        ];

        // Réponses possibles
        $answersList = [
            "C'est une méthodologie de gestion de projet.",
            "Cela permet d'améliorer la productivité.",
            "Il favorise la collaboration en équipe.",
            "C'est une approche utilisée dans le développement logiciel.",
            "Il améliore la flexibilité et l'adaptabilité.",
            "Cela réduit les délais de livraison.",
            "Il permet une meilleure gestion des priorités.",
            "Utilisé principalement dans les grandes entreprises.",
            "Il met l'accent sur la communication continue.",
            "Un cadre bien défini pour la gestion de projet."
        ];

        // Génération des données
        foreach ($list_of_themes as $theme) {
            foreach ($list_of_languages as $language) {
                $dynamicqcm = new Dynamicqcm();
                $dynamicqcm->setTheme($theme);
                $dynamicqcm->setLangue($language);

                // Ajouter des questions au Dynamicqcm
                $numberOfQuestions = rand(3, 6); // Choisir entre 3 et 6 questions
                for ($i = 0; $i < $numberOfQuestions; $i++) {
                    $question = new Question();
                    $questionText = str_replace(['{theme}', '{language}'], [$theme, $language], $questions[array_rand($questions)]);
                    $question->setQuestion($questionText);
                    $question->setType('multiple_choice'); // Exemple de type de question
                    $question->setDynamicqcm($dynamicqcm);
                    $dynamicqcm->addQuestion($question);
                    $manager->persist($question);

                    // Ajouter des réponses à la question
                    $numberOfAnswers = rand(2, 4); // Chaque question aura entre 2 et 4 réponses
                    for ($j = 0; $j < $numberOfAnswers; $j++) {
                        $answer = new Answers();
                        $answer->setAnswer($answersList[array_rand($answersList)]); // Choisir une réponse aléatoire
                        $answer->setIsCorrect(rand(0, 1) === 1); // Définir si la réponse est correcte ou non
                        $answer->setQuestion($question);
                        $manager->persist($answer);
                    }
                }

                $manager->persist($dynamicqcm);
            }
        }

        $manager->flush();
    }
}
