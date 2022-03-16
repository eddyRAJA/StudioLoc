<?php

namespace App\Controller;

use App\Repository\ReservationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalendarController extends AbstractController
{
    /**
     * @Route("/calendar", name="calendar")
     */
    public function index(ReservationRepository $reservationRepository): Response
    {
        $events = $reservationRepository->findAll();
//dd($events);
        $reservations = [];

        foreach ($events as $event) {
            $reservations[] = [
                'id' => $event->getId(),
                'studio' => $event->getStudio(),
                'author' => $event->getAuthor(),
                'start' => $event->getStart()->format('Y-m-d H:i:s'),  //transfomed to string
                'end' => $event->getEnd()->format('Y-m-d H:i:s'),
                'amount' => $event->getAmount(),
                'createdAt' => $event->getCreatedAt()->format('Y-m-d H:i:s'),
                'updatedAt' => $event->getUpdatedAt()->format('Y-m-d H:i:s'),
            ];
        }

        $data = json_encode($reservations);
        
        return $this->render('calendar/index.html.twig', compact('data'));
    }
}
