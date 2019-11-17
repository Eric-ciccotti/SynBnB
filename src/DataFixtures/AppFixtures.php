<?php

namespace App\DataFixtures;

use App\Entity\Ad;
use App\Entity\Image;
use Faker\Factory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr-FR');  //pour avoir des dummy data

        //boucle qui créer les articles
        for ($i = 1; $i <= 30; $i++) {

            $title = $faker->sentence(5);
            $coverImage = $faker->imageUrl(1000, 350);
            $introduction = $faker->paragraph(2);
            $content = '<p>' . join("</p><p>", $faker->paragraphs(5)) . '</p>'; // <p> dutext </p><p> dutext </p>

            $ad = new Ad();
            $ad->setTitle($title)
                ->setCoverImage($coverImage)
                ->setIntroduction($introduction)
                ->setContent($content)
                ->setPrice(mt_rand(40, 200))
                ->setRooms(mt_rand(2, 8));

            //pour chaque article boucle qui créer des photos
            for ($j = 1; $j < mt_rand(2, 5); $j++) {
                $image = new Image();
                $image->setUrl($faker->imageUrl())
                    ->setCaption($faker->sentence())
                    ->setAd($ad);

                $manager->persist($image); // "prepare toi a faire perdurer dans le temps cette image dans la base de donnée"
            }

            $manager->persist($ad);
        }

        $manager->flush();
    }
}
