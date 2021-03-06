<?php
namespace App\Controller;

use App\Entity\Movie;
use App\Entity\Sale;
use App\Event\SaleEvent;
use App\Form\SaleType;
use App\Logger\SaleLogger;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ApiMovieController extends Controller
{
    /**
     * @Route("/api/movies", name="get_movies")
     * @Method({"GET"})
     */
    public function index(SerializerInterface $serializer)
    {
        $movies = $this->getDoctrine()
            ->getRepository(Movie::class)
            ->findAll();

        return new JsonResponse($serializer->serialize($movies, 'json', ['groups' => ['movie']]), 200, [], true);
    }

    /**
     * @Route("/api/movies/{movieId}", name="get_movie")
     * @Method({"GET"})
     */
    public function movie(SerializerInterface $serializer, int $movieId)
    {
        $em = $this->getDoctrine()->getManager();
        $movie = $em->getRepository(Movie::class)->findOneWithActors($movieId);

        return new JsonResponse($serializer->serialize($movie, 'json', ['groups' => ['movie']]), 200, [], true);

    }

    /**
     * @Route("/api/movies/{movieId}/sale", name="post_booking")
     * @Method({"POST"})
     */
    public function newSale(SaleLogger $saleLogger, Request $request, $movieId)
    {
        $sale = new Sale();
        $movie = $this->getDoctrine()
            ->getRepository(Movie::class)
            ->find($movieId);

        $form = $this->createForm(SaleType::class, $sale, ['movie' => $movie, 'csrf_protection' => false]);

        $data = json_decode($request->getContent(), true);
        $form->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($sale);

            $numTickets = $data['numTickets'];

            $this->get('event_dispatcher')
                ->dispatch(
                    SaleEvent::NAME,
                    new SaleEvent($sale, $movie, $numTickets)
                );

            $em->flush();

            $saleLogger->log($sale);

            // Location should be a GET request to the sale
            return new Response(null, 201, [
                'Location' => $this->generateUrl(
                    'get_movie',
                    ['movieId' => $movie->getId()]
                ),
            ]);
        }

        // Here we should serialize the errors of the form
        return new Response(null, 406);
    }
}
