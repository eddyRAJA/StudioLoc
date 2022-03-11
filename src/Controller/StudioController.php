<?php

namespace App\Controller;

use App\Repository\CategoryStudioRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StudioController extends AbstractController
{
    /**
     * @Route("/category", name="category")
     */
    public function categories(CategoryStudioRepository $categoryRepo): Response
    {
        $categories = $categoryRepo->findAll();

        //dd($categories);
        return $this->render('studio/category.html.twig', [
            'categories' => $categories,
        ]);
    }
}
