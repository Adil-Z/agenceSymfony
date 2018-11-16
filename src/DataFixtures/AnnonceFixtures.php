<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Annonce;
use Faker;

class AnnonceFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
       $faker = Faker\Factory::create('fr_FR');
       for($i = 1; $i<=3 ; $i++){
           $annonce = new Annonce();
           $title = join($faker->words());
           $annonce->setTitle($title)
                   ->setDescription($faker->paragraph())
                   ->setImage($faker->imageUrl($width = 300, $height = 150))
                   ->setPrice($faker->numberBetween($min = 100000, $max = 500000))
                   ->setCity($faker->city);

                   $manager->persist($annonce);

       }

        $manager->flush();
    }
}
