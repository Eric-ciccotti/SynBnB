<?php

namespace App\DataFixtures;

use App\Entity\Ad;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr-FR');

        for ($i = 1; $i <= 30; $i++) {
            
            $title = $faker->sentence(5);
            $coverImage = $faker->imageUrl(1000, 350);
            $introduction = $faker->paragraph(2);
            $content = '<p>' . join("</p><p>", $faker->paragraphs(5)) . '</p>'; // <p> dutext </p><p> dutext </p>

            $ad = new Ad();
            $ad->setTitle($title)
                ->setSlug("titre-de-l-annonce-n-$i")
                ->setCoverImage($coverImage)
                ->setIntroduction($introduction)
                ->setContent($content)
                ->setPrice(mt_rand(40, 200))
                ->setRooms(mt_rand(2, 8));

            $manager->persist($ad);
        }

        $manager->flush();
    }
}
