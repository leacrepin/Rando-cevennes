<?php
// src/Controller/HomeController.php
namespace App\Controller;

use App\Repository\CategorieRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\RandonneeRepository;

class HomeController extends AbstractController
{

    /**
     * @Route("/home",name="Home")
     * @param CategorieRepository $categoryRepository
     * @return Response
     */
    public function Home(RandonneeRepository $randonneeRepository)
    {
        $randos = $randonneeRepository->findTOP3Randonnees();

        return $this->render('randonnee.html.twig', [
            'randos' => $randos,
        ]);
    }

    /**
     * @Route("/VoirCat",name="VoirCat")
     * @param CategorieRepository $categoryRepository
     * @return Response
     */
    public function VoirCat(CategorieRepository $categoryRepository)
    {
        $categories = $categoryRepository
            ->findAll();

        return $this->render('categorie.html.twig', [
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/categoryRender")
     * @param RandonneeRepository $randonneeRepository
     * @return Response
     */
    public function categoryRender(RandonneeRepository $randonneeRepository)
    {
        $nbRandonnees = $randonneeRepository
            ->count([]);

        return $this->render('footer.html.twig', [
            'nbRandonnee' => $nbRandonnees,
        ]);
    }

}