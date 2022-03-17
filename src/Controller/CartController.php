<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Repository\StudioRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ReservationRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/cart", name="cart_")
 */
class CartController extends AbstractController
{

    private $em;
    private $reservationRepository;

    public function __construct(EntityManagerInterface $em, ReservationRepository $reservationRepository, StudioRepository $studioRepository)
    {
        $this->em = $em;
        $this->reservationRepository = $reservationRepository;
        $this->StudioRepository = $studioRepository;

        //parent::__construct();
    }

    /**
     * @Route("/", name="index")
     */
    public function index(SessionInterface $session, ReservationRepository $reserv, StudioRepository $studioRepository): Response
    {
        $cady = $session->get("cady", []);

        //build data
        $dataCady = [];
        $total = 0.00;
        //dd($cady);

        foreach ($cady as $id => $quantity) {
            $reservation = $reserv->find($id);

            $studioId = $reservation->getStudio()->getId();
            $studio = $studioRepository->findById($studioId);

            dd($reservation);

            $dataCady[] = [
                "reservation" => $reservation,
                "quantity" => $quantity,
            ];

            $total += $reservation->getAmount() * $quantity;
        }
        //dd($dataCady);

        return $this->render(
            'cart/index.html.twig', compact("dataCady", "total"));
        
    }

    /**
     * @Route("/add/{id}", name="add")
     */
    public function add(Reservation $reservation, SessionInterface $session): Response
    {
        //get the cady
        $cady = $session->get("cady", []);
        $id = $reservation->getId();

        if (empty($cady[$id])) {
            $cady[$id] = 1;
        } else {
            $cady[$id]++;
        }
        //save elts in session
        $session->set("cady", $cady);

        return $this->redirectToRoute('cart_index');
    }

    /**
     * @Route("/remove/{id}", name="remove")
     */
    public function remove(Reservation $reservation, SessionInterface $session): Response
    {
        //get the cady
        $cady = $session->get("cady", []);
        $id = $reservation->getId();

        if (!empty($cady[$id])) {
            if($cady[$id] > 1){
                $cady[$id]--;
            }else{
                unset($cady[$id]);
            }
        }
        //save elts in session
        $session->set("cady", $cady);

        return $this->redirectToRoute('cart_index');
    }

    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function delete(Reservation $reservation, SessionInterface $session): Response
    {
        //get the cady
        $cady = $session->get("cady", []);
        $id = $reservation->getId();

        if (!empty($cady[$id])) {
            unset($cady[$id]);
            }
        
        //save elts in session
        $session->set("cady", $cady);

        return $this->redirectToRoute('cart_index');
    }

    /**
     * @Route("/delete", name="delete_all")
     */
    public function deleteAll(SessionInterface $session): Response
    {
        $session->set("cady", []);

        return $this->redirectToRoute('cart_index');
    }
}

