<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use App\Entity\Categories;
use App\Entity\Movie;
use App\Repository\CategoriesRepository;
use App\Repository\MovieRepository;
use Doctrine\ORM\Mapping\Id;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Tests\Fixtures\Validation\Category;
use Symfony\Component\HttpFoundation\Response;

class LuckyController extends AbstractController
{
    public function base()
    {
        return $this->render('base.html.twig', [
        ]);
    }

    public function home(MovieRepository $movieRepository)
    {
        return $this->render('home.html.twig', [
            'lastMovies' => $movieRepository->findLatestMovies()
        ]);
    }

    public function name(string $name) {
        return $this->render('name.html.twig', [
            'name' => $name
        ]);
    }

    public function navBar() {
        $em = $this->getDoctrine();
        $repo = $em->getRepository(Categories::class)->findAll();
        return $this->render('header.html.twig', [
            'categories' => $repo
        ]);
    }
}