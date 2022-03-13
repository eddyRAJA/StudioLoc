<?php

namespace App\Controller;

use App\Entity\Studio;
use App\Entity\CategoryStudio;
use App\Repository\StudioRepository;
use App\Repository\CategoryStudioRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class StudioController extends AbstractController
{
    /**
     * @Route("/categories", name="categories_show")
     */
    public function showCategories(CategoryStudioRepository $categoryRepo): Response
    {
        $categories = $categoryRepo->findAll();

        //dd($categories);
        return $this->render('studio/showCategories.html.twig', [
            'categories' => $categories,
        ]);
    }


    /**
     * show a category with all of them studios
     * 
     * @Route("/category/{id}", name="category_show", methods={"GET"})
     */
    public function showCategory(CategoryStudio $category): Response
    {
        $studios = $category->getStudios();

        return $this->render('studio/showCategory.html.twig', [
            'category' => $category,
            'studios' => $studios
        ]);
    }


    /**
     * show a studio 
     * 
     * @Route("/studio/{id}", name="studio_show", methods={"GET"})
     */
    public function showStudio(Studio $studio): Response
    {
        return $this->render('studio/showStudio.html.twig', [
            'studio' => $studio
        ]);
    }
}
