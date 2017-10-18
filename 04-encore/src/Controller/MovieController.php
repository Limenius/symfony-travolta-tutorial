<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Movie;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends Controller
{
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

    /**
     * @Route("/movie/{movieId}", name="movie")
     */
    public function movie(int $movieId)
    {
        $movie = $this->getDoctrine()
            ->getRepository(Movie::class)
            ->find($movieId);

        return $this->render('movies/movie.html.twig', [
            'movie' => $movie,
        ]);
    }

}
