<?php

namespace App\Controller;

use App\Entity\IncriptionRando;
use App\Form\IncriptionRandoType;
use App\Repository\IncriptionRandoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/inscription/rando")
 */
class IncriptionRandoController extends AbstractController
{
    /**
     * @Route("/", name="incription_rando_index", methods={"GET"})
     */
    public function index(IncriptionRandoRepository $incriptionRandoRepository): Response
    {
        return $this->render('incription_rando/index.html.twig', [
            'incription_randos' => $incriptionRandoRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}", name="incription_rando_show", methods={"GET"})
     */
    public function show(IncriptionRando $incriptionRando): Response
    {
        return $this->render('incription_rando/show.html.twig', [
            'incription_rando' => $incriptionRando,
        ]);
    }

}
