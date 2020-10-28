<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use App\Entity\Randonnee;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();

        $cat = array();

        for ($i = 0; $i < 3; $i++) {
            $cat[$i] = new Categorie();
            $cat[$i]->setNom($faker->word);
            $manager->persist($cat[$i]);
        }

        
        for ($i = 0; $i < 100; $i++) {
            $rando = new Randonnee();
            $rando->setTitre($faker->word);
            $rando->setDescription($faker->word);

            $rando->setDuree($faker->randomDigitNotNull);
            $rando->setDateRando($faker->dateTimeBetween($startDate = '-5 years', $endDate = '+ 5 years', $timezone = null));

            $numCat = mt_rand(0, 2);
            $rando->setCategorie($cat[$numCat]);

            $manager->persist($rando);
        }

        $manager->flush();
    }
}
