<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use App\Repository\ProgramRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ActorFixtures extends Fixture implements DependentFixtureInterface
{

    public function __construct(private ProgramRepository $programRepository)
    {
        
    }

    public function load(ObjectManager $manager): void
    {

        $faker = Factory::create();

        $actors = [];
            for($i = 0; $i < 10; $i++) {
                $actor = new Actor();
                $actor->setName($faker->name());
                $manager->persist($actor);
                $actors[] = $actor;
            }
            
            $programs = $this->programRepository->findAll();

            foreach ($programs as $program) {
                for ($i = 0; $i < 3; $i++){
                    $program->addActor(
                        $actors[mt_rand(0, count($actors) - 1)]
                    );
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
