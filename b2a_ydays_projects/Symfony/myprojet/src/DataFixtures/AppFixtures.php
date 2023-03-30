<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Movie;
use App\Entity\People;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        $categories = ['Comedie', 'Policier', 'Action', 'Aventure', 'Drame'];
        $categoriesTab = [];
        for ($i = 0; $i < 5; $i++) {
            $category = new Category();
            $category->setTitle($categories[$i]);

            $categoriesTab[] = $category;

            $manager->persist($category);
        }

        $actors = [];
        for ($p = 0; $p < 20; $p++) {
            $people = new People();
            $people->setLastName($faker->lastName)
                ->setFirstName($faker->firstName)
                ->setDescription($faker->sentence)
                ->setPicture('https://randomuser.me/api/portraits/men/'. $p . '.jpg');

            $manager->persist($people);
            $actors[] = $people;
        }

        for ($m = 0; $m <= 30; $m++) {
            $movie = new Movie();
            $movie->setTitle($faker->realText(20))
                ->setImage('https://picsum.photos/500/200?random='. $m)
                ->setReleasedAt($faker->dateTimeBetween('-30 years'))
                ->setSynopsis('<p>'. join('</p><p>', $faker->paragraphs(3) ) . '</p>');

            $movieActors = $faker->randomElements($actors, $faker->numberBetween(2, 14));
            foreach ($movieActors as $actor) {
                $movie->addActor($actor);
            }

            $movieCategories = $faker->randomElements($categoriesTab, $faker->numberBetween(0, 4));
            foreach ($movieCategories as $category) {
                $movie->addCategory($category);
            }

            $manager->persist($movie);
        }

        $manager->flush();
    }
}