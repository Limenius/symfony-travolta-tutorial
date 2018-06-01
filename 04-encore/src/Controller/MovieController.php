<?php
namespace App\Controller;

use App\Entity\Movie;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends Controller
{
    /**
     * @Route("/movie/{movieId}", name="movie")
     */
    public function movie(int $movieId)
    {
        $em = $this->getDoctrine()->getManager();

        return $this->render('movies/movie.html.twig', [
            'movie' => $em->getRepository(Movie::class)->findOneWithActors($movieId),
        ]);
    }

    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        $movies = $this->getDoctrine()
            ->getRepository(Movie::class)
            ->findAll();

        return $this->render('movies/index.html.twig', [
            'movies' => $movies,
        ]);
    }
}
