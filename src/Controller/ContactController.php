<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ContactType;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Message;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class ContactController extends AbstractController
{
    /**
     * @var Security
     */
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request, MailerInterface $mailer): Response
    {
        $user = $this->security->getUser();
        //dd($user);
        if (!$user) {
            //throw new NotFoundHttpException('Please, login!');
            return $this->redirectToRoute('app_login');
        };

        $form = $this->createForm(ContactType::class);
        $contact = $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $email = (new TemplatedEmail())
                //->from($user->getUser()->getUsername())
                ->from($user->getUserIdentifier())
                ->to('studioLoc@email.com')
                ->subject($contact->get('object')->getData())
                ->htmlTemplate('contact/msg.html.twig')
                ->context([
                    'object' => $contact->get('object')->getData(),
                    'message' => $contact->get('message')->getData(),
                ]);
            $mailer->send($email);

            $this->addFlash('message', 'Message bien envoyé!');
            return $this->redirectToRoute('contact');
        }
        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
