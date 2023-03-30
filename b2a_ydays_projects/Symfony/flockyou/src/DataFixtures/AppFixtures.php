<?php

namespace App\DataFixtures;

use App\Entity\Leagues;
use App\Entity\Products;
use App\Entity\Teams;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        $leagues =
            [
                'Euro 2020',
                'Champions League',
                'Premier League',
                'Ligue 1',
                'Liga BBVA',
                'Bundesliga'
            ];
        $leaguesTab = [];
        for ($l = 0; $l < sizeof($leagues); $l++) {
            $league = new Leagues();
            $league->setLeague($leagues[$l]);
            $league->setImage('https://picsum.photos/200/200?random='. $l);

            $leaguesTab[] = $league;

            $manager->persist($league);
        }


        $teams_euro =
            [
                'France',
                'Espagne',
                'Allemagne',
                'Brésil',
                'Angleterre',
                'Argentine',
                'Italie'
            ];
        $teams_eurotab = [];

        for ($t = 0; $t < sizeof($teams_euro); $t++) {
            $team = new Teams();
            $team->setLeague($leaguesTab[0]);
            $team->setTeam($teams_euro[$t]);
            $team->setImage('https://picsum.photos/200/200?random='. $t);

            $teams_eurotab[] = $team;

            $manager->persist($team);
        }
        $teams_cl =
            [
                'Paris-SG',
                'Real Madrid',
                'Bayern Munich',
                'Totthenham',
                'Manchester City',
                'Juventus',
                'Atlético Madrid',
                'Liverpool',
                'Naples',
                'Barcelone',
                'Inter Milan',
                'Dortmund',
                'Lyon',
                'Ajax',
                'Valence',
                'Chelsea',
                'Lille'
            ];
        $teams_cltab = [];
        for ($t = 0; $t < sizeof($teams_cl); $t++) {
            $team = new Teams();
            $team->setLeague($leaguesTab[1]);
            $team->setTeam($teams_cl[$t]);
            $team->setImage('https://picsum.photos/200/200?random='. $t);

            $teams_cltab[] = $team;

            $manager->persist($team);
        }
        $teams_pl =
            [
                'Arsenal',
                'Leicester City',
                'West Ham United',
                'Everton',
                'Watford',
                'Crystal Palace'
            ];
        $teams_pltab = [];
        for ($t = 0; $t < sizeof($teams_pl); $t++) {
            $team = new Teams();
            $team->setLeague($leaguesTab[2]);
            $team->setTeam($teams_pl[$t]);
            $team->setImage('https://picsum.photos/200/200?random='. $t);

            $teams_pltab[] = $team;

            $manager->persist($team);
        }
        $teams_lo =
            [
                'Marseille',
                'Saint-Etienne',
                'Monaco',
                'Nice',
                'Stade Rennais'
            ];
        $teams_lotab = [];
        for ($t = 0; $t < sizeof($teams_lo); $t++) {
            $team = new Teams();
            $team->setLeague($leaguesTab[3]);
            $team->setTeam($teams_lo[$t]);
            $team->setImage('https://picsum.photos/200/200?random='. $t);

            $teams_lotab[] = $team;

            $manager->persist($team);
        }
        $teams_bbva =
            [
                'Seville',
                'Villareal',
                'Levante'
            ];
        $teams_bbvatab = [];
        for ($t = 0; $t < sizeof($teams_bbva); $t++) {
            $team = new Teams();
            $team->setLeague($leaguesTab[4]);
            $team->setTeam($teams_bbva[$t]);
            $team->setImage('https://picsum.photos/200/200?random='. $t);

            $teams_bbvatab[] = $team;

            $manager->persist($team);
        }
        $teams_bd =
            [
                'RB Leipzig',
                'FC Shalke 04',
                'FC Cologne'
            ];
        $teams_bdtab = [];
        for ($t = 0; $t < sizeof($teams_bd); $t++) {
            $team = new Teams();
            $team->setLeague($leaguesTab[5]);
            $team->setTeam($teams_bd[$t]);
            $team->setImage('https://picsum.photos/200/200?random='. $t);

            $teams_bdtab[] = $team;

            $manager->persist($team);
        }
        $teams = [
            array($teams_euro),
            array($teams_cl),
            array($teams_pl),
            array($teams_lo),
            array($teams_bbva),
            array($teams_bd)
        ];
        $teamsTab = [];

        $products = [];
        $states = ['Domicile', 'Extérieur', 'Extra'];
        $sizes = ['XS', 'S', 'M', 'L', 'XL', 'XXL'];
        for ($p = 0; $p < 40; $p++) {
            $product = new Products();
            $product->setImage('https://picsum.photos/200/200?random='. $p);
            $product->setDescription($faker->text);
            $product->setFlocage($faker->title);
            $product->setPrice($faker->buildingNumber);

            $productStates = $faker->randomElements($states, $faker->numberBetween(0, sizeof($states)));
            foreach($productStates as $state) {
                $product->setState($state);
            }
            $productSizes = $faker->randomElements($sizes, $faker->numberBetween(0, sizeof($sizes)));
            foreach($productSizes as $size) {
                $product->setSize($size);
            }
            $productLeague = $faker->randomElements($leaguesTab, $faker->numberBetween(0, sizeof($leagues)));
            foreach($productLeague as $league) {
                $product->setLeague($league);
            }
            $productTeam = $faker->randomElements($teamsTab, $faker->numberBetween(0, sizeof($teams)));
            foreach($productTeam as $team) {
                $product->setTeam($team);
            }

            $products[] = $product;

            $manager->persist($product);
        }

        $manager->flush();
    }
}
