<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

use Faker\Factory;
class ProgramFixtures extends Fixture implements DependentFixtureInterface
{

    const PROGRAMS = [
        ['Title' => 'Walking dead','Synopsis' => 'Des zombies envahissent la terre', 'Country' => 'USA', 'Year' => '2011', 'Category' => 'category_Action'],
        ['Title' => 'The Mandalorian','Synopsis' => 'Les aventures du Mandalorien', 'Country' => 'USA', 'Year' => '2019', 'Category' => 'category_Aventure'],
        ['Title' => 'Breaking Bad','Synopsis' => 'Reportage sur un prof de chimi', 'Country' => 'USA', 'Year' => '2012','Category' => 'category_Action'],
        ['Title' => 'The Boys','Synopsis' => 'La bagarre', 'Country' => 'USA', 'Year' => '2018','Category' => 'category_Horreur'],
        ['Title' => 'Andor','Synopsis' => 'Blade Runner dans Star Wars', 'Country' => 'USA', 'Year' => '2023','Category' => 'category_Fantastique']
    ];

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
        
        foreach (self::PROGRAMS as $programLine) {
            $program = new Program();
            $program->setTitle($programLine['Title']);
            $program->setSynopsis($programLine['Synopsis']);
            $program->setCountry($programLine['Country']);
            $program->setYear($programLine['Year']);
            $program->setCategory($this->getReference($programLine['Category']));
            $manager->persist($program);
            $this->addReference('program_' . $programLine['Title'], $program);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
          CategoryFixtures::class,
        ];
    }


}