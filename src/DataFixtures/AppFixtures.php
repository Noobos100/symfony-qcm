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

        $list_of_languages = ['ENGLISH', 'FRENCH', 'SPANISH', 'GERMAN', 'ITALIAN', 'PORTUGUESE', 'DUTCH', 'RUSSIAN', 'CHINESE', 'JAPANESE', 'KOREAN', 'ARABIC', 'TURKISH', 'PERSIAN', 'HINDI', 'URDU', 'BENGALI', 'PUNJABI', 'TELUGU', 'MARATHI', 'TAMIL', 'GUJARATI', 'KANNADA', 'ORIYA', 'MALAYALAM', 'SINDHI', 'NEPALI', 'SINHALA', 'BURMESE', 'KHMER', 'LAO', 'THAI', 'VIETNAMESE', 'INDONESIAN', 'TAGALOG', 'MALAY', 'HOKKIEN', 'MANDARIN', 'CANTONESE', 'JAVANESE', 'SUNDANESE', 'TELUGU', 'TAMIL', 'MARATHI', 'URDU', 'KANNADA', 'GUJARATI', 'ORIYA', 'MALAYALAM', 'SINDHI', 'NEPALI', 'SINHALA', 'BURMESE', 'KHMER', 'LAO', 'THAI', 'VIETNAMESE', 'INDONESIAN', 'TAGALOG', 'MALAY'];

        // Create a random Dynamicqcm object for each theme and language
        foreach ($list_of_themes as $theme) {
            foreach ($list_of_languages as $language) {
                $dynamicqcm = new Dynamicqcm();
                $dynamicqcm->setTheme($theme);
                $dynamicqcm->setLangue($language);
                $manager->persist($dynamicqcm);
                $manager->flush();
            }
        }
    }
}
