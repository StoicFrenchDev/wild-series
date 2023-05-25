<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategoryRepository;
use App\Repository\ProgramRepository;

#[Route('/category', name: 'category_')]
class CategoryController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();

        return $this->render('category/index.html.twig', [
            'categories' => $categories
        ]);
    }

    #[Route('/{categoryName}', name: 'show')]
    public function show(string $categoryName, CategoryRepository $categoryRepository, ProgramRepository $programRepository):Response
    {
        $category = $categoryRepository->findOneBy(['name' => $categoryName]);

        $programs = $programRepository->findby(
                ['category' => $category],
                ['id' => 'DESC'],
                limit:3
            );

        if (!$categoryName) {
            throw $this->createNotFoundException(
                'No program with name : '.$categoryName.' found in category\'s table.'
            );
        }

        return $this->render('category/show.html.twig', [
            'category' => $category,
            'programs' => $programs,
         ]);


    }

}
