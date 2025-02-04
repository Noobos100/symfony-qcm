<?php

namespace App\DataFixtures;

use App\Entity\Dynamicqcm;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $list_of_themes = ['SCRUM_AGILITE', 'KANBAN', 'LEAN', 'XP', 'FDD', 'DSDM', 'TDD', 'ATDD', 'BDD', 'SAFe', 'LESS', 'NEXUS', 'DA', 'PMI', 'PRINCE2', 'PMBOK', 'ITIL', 'COBIT', 'ISO', 'CEMM', 'TOGAF', 'ARCHIMATE', 'UML', 'SYSML', 'BPMN', 'DMN', 'CMMI', 'SPICE'];

        $list_of_languages = ['ENGLISH', 'FRENCH', 'SPANISH', 'GERMAN', 'ITALIAN', 'PORTUGUESE', 'DUTCH', 'RUSSIAN', 'CHINESE', 'JAPANESE', 'KOREAN', 'ARABIC', 'TURKISH', 'PERSIAN', 'HINDI', 'URDU', 'BENGALI', 'PUNJABI', 'TELUGU', 'MARATHI', 'TAMIL', 'GUJARATI', 'KANNADA', 'ORIYA', 'MALAYALAM', 'SINDHI', 'NEPALI', 'SINHALA', 'BURMESE', 'KHMER', 'LAO', 'THAI', 'VIETNAMESE', 'INDONESIAN', 'TAGALOG', 'MALAY'];

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

        // Create a random Dynamicqcm object for each theme and language
        foreach ($list_of_themes as $theme) {
            foreach ($list_of_languages as $language) {
                $dynamicqcm = new Dynamicqcm();
                $dynamicqcm->setTheme($theme);
                $dynamicqcm->setLangue($language);

                // Sélectionner aléatoirement une question
                $randomKey = array_rand($questions);
                $selectedQuestion = str_replace(['{theme}', '{language}'], [$theme, $language], $questions[$randomKey]);

                // Convertir la question en une chaîne JSON ou simplement la concaténer
                $dynamicqcm->setQuestions(json_encode([$selectedQuestion])); // ou $selectedQuestion

                $manager->persist($dynamicqcm);
            }
        }

        $manager->flush();
    }
}