<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

use Faker\Factory;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
   /* const SEASONS = [
        ['Number' => '1','Year' => '2019', 'Description' => 'La découverte de baby Yoda!', 'Program' => 'program_The Mandalorian'],
        ['Number' => '2','Year' => '2021', 'Description' => 'Baby Yoda s\'appel Grogu et est livré à Luke!', 'Program' => 'program_The Mandalorian'],
        ['Number' => '3','Year' => '2023', 'Description' => 'Le retour des Mandaloriens!', 'Program' => 'program_The Mandalorian'],
        ['Number' => '4','Year' => '2024', 'Description' => 'Aucune idée, on verra bien!', 'Program' => 'program_The Mandalorian'],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::SEASONS as $seasonLine) {
            $season = new Season();
            $season->setNumber($seasonLine['Number']);
            $season->setYear($seasonLine['Year']);
            $season->setDescription($seasonLine['Description']);
            $season->setProgram($this->getReference($seasonLine['Program']));
            $manager->persist($season);
            $this->addReference('season_' . $seasonLine['Number'], $season);
        }

        $manager->flush();
    }*/

        public function load(ObjectManager $manager): void
    {

        $faker = Factory::create();

        foreach (ProgramFixtures::PROGRAMS as $programLine) {
            for($i = 1; $i <= 5; $i++) {
                $season = new Season();
                $season->setNumber($i);
                $season->setYear($faker->year());
                $season->setDescription($faker->paragraphs(3, true));
                $season->setProgram($this->getReference('program_' . $programLine['Title']));
                $this->addReference('season_' . $i . '_' . $programLine['Title'] , $season);

                $manager->persist($season);
            }  
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont SeasonFixtures dépend
        return [
          ProgramFixtures::class,
        ];
    }
}
