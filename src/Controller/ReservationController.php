<?php

namespace App\Controller;

use DateTime;
use App\Entity\User;
use App\Entity\Studio;
use App\Entity\Reservation;
use App\Form\ReservationType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ReservationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/reservation")
 */
class ReservationController extends AbstractController
{
    private $em;
    private $reservationRepository;

    public function __construct(EntityManagerInterface $em, ReservationRepository $reservationRepository)
    {
        $this->em = $em;
        $this->reservationRepository = $reservationRepository;

        //parent::__construct();
    }

    /**
     * @Route("/", name="reservation_index", methods={"GET"})
     */
    public function index(ReservationRepository $reservationRepository): Response
    {
        return $this->render('reservation/index.html.twig', [
            'reservations' => $reservationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new/{name}", name="reservation_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $em, Studio $studio): Response
    {
        $unitPrice = $studio->getUnitPrice();
        
        $reservation = new Reservation();
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        $reservation->setAuthor($this->getUser());
        $reservation->setStudio($studio);

        $id = $this->getUser()->getId();
        if ($form->isSubmitted() && $form->isValid()) {

            $d1 = $reservation->getStart();
            $d2 = $reservation->getEnd();
            $diff = $d1->diff($d2);
            $qtty = $diff->h;
        $reservation->setAmount($unitPrice*$qtty);
        
        $em->persist($reservation);
        $em->flush();

            return $this->redirectToRoute('user_show', ['id' => $id]);
            #return $this->redirectToRoute('categories_show');
            #return $this->redirectToRoute('reservation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reservation/new.html.twig', [
            'reservation' => $reservation,
            'studio' => $studio,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="reservation_show", methods={"GET"})
     */
    public function show(Reservation $reservation): Response
    {
        return $this->render('reservation/show.html.twig', [
            'reservation' => $reservation,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="reservation_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Reservation $reservation, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('reservation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reservation/edit.html.twig', [
            'reservation' => $reservation,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="reservation_delete", methods={"POST"})
     */
    public function delete(Request $request, Reservation $reservation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reservation->getId(), $request->request->get('_token'))) {
            $entityManager->remove($reservation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('reservation_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * show a user with all of them studios
     * 
     * @Route("/user/{id}", name="user_show", methods={"GET"})
     */
    public function showreservationOfUser(User $user): Response
    {
        $reservations = $user->getReservations();

        return $this->render('reservation/show_user.html.twig', [
            'user' => $user,
            'reservations' => $reservations
        ]);
    }
}
