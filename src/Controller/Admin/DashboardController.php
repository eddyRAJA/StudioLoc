<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Studio;
use App\Entity\AboutUs;
use App\Entity\Company;
use App\Entity\Reservation;
use App\Entity\CategoryStudio;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('StudioLoc');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
         yield MenuItem::linkToCrud('Our company', 'fas fa-comment', Company::class);
         yield MenuItem::linkToCrud('About us', 'fas fa-comment', AboutUs::class);
         yield MenuItem::linkToCrud('The gategories of studios', 'fas fa-tags', CategoryStudio::class);
         yield MenuItem::linkToCrud('All studios', 'fas fa-list', Studio::class);
         yield MenuItem::linkToCrud('The reservations', 'fas fa-list', Reservation::class);
         yield MenuItem::linkToCrud('The users', 'fas fa-user', User::class);
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
         yield MenuItem::linkToRoute('Back to the website', 'fas fa-sing-out', 'home');
    }
}
