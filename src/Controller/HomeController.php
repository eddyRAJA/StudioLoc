<?php

namespace App\Controller;

use App\Repository\AboutUsRepository;
use App\Repository\CompanyRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function myCompany(CompanyRepository $companyRepo): Response
    {
        $company = $companyRepo->findOneBy(['id' => '1']);
        //dd($company);
        return $this->render('home/index.html.twig', [
            'company' => $company
        ]);
    }


    /**
     * @Route("/aboutUs", name="about_us")
     */
    public function aboutUs(AboutUsRepository $aboutUsRepo): Response
    {
        $allOfUs = $aboutUsRepo->findAll();
        //dd($allOfUs);
        return $this->render('home/aboutUs.html.twig', [
            'allOfUs' => $allOfUs
        ]);
    }
}
