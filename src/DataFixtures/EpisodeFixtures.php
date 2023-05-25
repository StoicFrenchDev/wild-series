<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;


use Faker\Factory;

class EpisodeFixtures extends Fixture  implements DependentFixtureInterface
{
    /*
    const EPISODES = [
        ['Number' => '1','Title' => 'Chapter 1: The Mandalorian', 'Synopsis' => 'Cinq ans après la chute de l\'Empire, un chasseur de primes mandalorien récupère un fugitif après une bagarre dans un bar sur la planète de glace Pagodon et retourne sur la planète Nevarro dans son vaisseau, le Razor Crest.
        ', 'Season' => 'season_1'],
        ['Number' => '2','Title' => 'Chapter 2: The Child', 'Synopsis' => 'Ayant localisé sa précieuse proie, le Mandalorien doit affronter une bande de pillards.', 'Season' => 'season_1'],
        ['Number' => '3','Title' => 'Chapter 3: The Sin', 'Synopsis' => 'Épuisé, le Mandalorien retrouve son client pour toucher sa prime, mais cela se termine mal.', 'Season' => 'season_1'],
        ['Number' => '4','Title' => 'Chapter 4: Sanctuary', 'Synopsis' => 'Le Mandalorien fait équipe avec un ex-soldat pour protéger des prédateurs un village de fermiers.', 'Season' => 'season_1'],
        ['Number' => '5','Title' => 'Chapter 5: The Gunslinger', 'Synopsis' => 'Sur une planète désertique, le Mandalorien aide un chasseur de primes dépassé par sa mission.', 'Season' => 'season_1'],
        ['Number' => '6','Title' => 'Chapter 6: The Prisoner', 'Synopsis' => 'Le Mandalorien se joint à des mercenaires dans une dangereuse mission.', 'Season' => 'season_1'],
        ['Number' => '7','Title' => 'Chapter 7: The Reckoning', 'Synopsis' => 'Un ancien rival invite le Mandalorien à faire la paix.', 'Season' => 'season_1'],
        ['Number' => '8','Title' => 'Chapter 8: Redemption', 'Synopsis' => 'Le Mandalorien et ses alliés sont face à leur véritable ennemi, qui lui les a déjà bien cernés.', 'Season' => 'season_1'],

    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::EPISODES as $episodeLine) {
            $episode = new Episode();
            $episode->setNumber($episodeLine['Number']);
            $episode->setTitle($episodeLine['Title']);
            $episode->setSynopsis($episodeLine['Synopsis']);
            $episode->setSeason($this->getReference($episodeLine['Season']));
            $manager->persist($episode);
        }

        $manager->flush();
    }*/

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        foreach (ProgramFixtures::PROGRAMS as $programLine) {
            for($i = 1; $i <=50; $i++) {
                $episode = new Episode();
                $episode->setNumber($i);
                $episode->setTitle($faker->word());
                $episode->setSynopsis($faker->sentence());
                $episode->setSeason($this->getReference('season_' . $faker->numberBetween(1 , 10) . '_' . $programLine['Title']));

                $manager->persist($episode);
            }
        }
        $manager->flush();
   
}

    public function getDependencies()
    {
    // Tu retournes ici toutes les classes de fixtures dont EpisodeFixtures dépend
        return [
            SeasonFixtures::class,
        ];
    }
}
