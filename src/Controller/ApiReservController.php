<?php

namespace App\Controller;

use DateTime;
use App\Entity\Reservation;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;

class ApiReservController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;

        //parent::__construct();
    }

    /**
     * @Route("/api/reserv", name="api_reserv")
     */
    public function index(): Response
    {
        return $this->render('api_reserv/index.html.twig', [
            'controller_name' => 'ApiReservController',
        ]);
    }

    /**
     * @Route("/api/{id}/edit", name="api_reserv_edit", methods={"PUT"})
     */
    public function majReservation(?Reservation $reservation, Request $request): Response
    {
        //récupération des données
        $donnees = json_decode($request->getContent());

        if (
            isset($donnees->studio) && !empty($donnees->studio) &&
            isset($donnees->author) && !empty($donnees->author) &&
            isset($donnees->start) && !empty($donnees->start) &&
            isset($donnees->end) && !empty($donnees->end) &&
            isset($donnees->createdAt) && !empty($donnees->createdAt) &&
            isset($donnees->updatedAt) && !empty($donnees->updatedAt) &&
            //isset($donnees->amount) && !empty($donnees->amount)  && 
            isset($donnees->updatedAt) && !empty($donnees->registered)
            
        ) {
            //on a les donneées complètes
            //on initialise un code
            $code = 200;      // succes ie màj

            //on verifie si l'id existe
            if (!$reservation) {
                // on instancie une réservation
                $reservation = new Reservation;

                //on chge le code
                $code = 201;    //ie created
            }

            //on hydrate l'obj avec les données
            $reservation->setStudio($donnees->studio);
            $reservation->setAuthor($donnees->author);
            $reservation->setStart(new DateTime($donnees->start));
            $reservation->setEnd(new DateTime($donnees->end));
            //$reservation->getCreatedAt($donnees->createdAt);
            $reservation->setRegistered($donnees->registered);

            $em = $this->entityManager;
            //$em = $this->getDoctrine()->getManager();
            $em->persist($reservation);
            $em->flush();

            // On retourne le code
            return new Response('Ok', $code);
        } else {
            //les données sont incomplètes
            return new Response('Données incomplètes', 404);
        }

        return $this->render('api_reserv/index.html.twig', [
            'controller_name' => 'ApiReservController',
        ]);
    }
}
