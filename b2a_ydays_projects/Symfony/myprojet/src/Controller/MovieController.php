<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Form\MovieType;
use App\Repository\MovieRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Illuminate\Cache\Repository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MovieController extends AbstractController
{
    public function showMovies(PaginatorInterface $paginator, MovieRepository $movieRepository, Request $request)
    {
        $query = $movieRepository->findAll();
        $pagination = $paginator->paginate(
          $query,
          $request->query->getInt('page', 1),
            5
        );
        $em = $this->getDoctrine();
        $repo = $em->getRepository(Movie::class)->findAll();
        return $this->render('showMovies.html.twig', [
            'movies' => $repo
        ]);
    }

    public function showMovie(Movie $movie)
    {
        return $this->render('showMovie.html.twig', [
            'movie' => $movie
        ]);
    }

    public function createMovie(Request $request) {
        $movie = new Movie();
        $form = $this->createForm(MovieType::class, $movie);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($movie);
            $em->flush();

            return $this->redirectToRoute('movie', ['id' => $movie->getId()]);
        }

        return $this->render('formMovie.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function updateMovie(Request $request, Movie $movie, ObjectManager $manager) {
        $form = $this->createForm(MovieType::class, $movie);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $manager->flush();

            return $this->redirectToRoute('movies');
        }

        return $this->render('updateMovie.html.twig', [
            'form' => $form->createView(),
            'movie' => $movie
        ]);
    }

    public function deleteMovie(Movie $movie, ObjectManager $manager) {
        $manager->remove($movie);
        $manager->flush();

        return $this->redirectToRoute('movies');
    }
}