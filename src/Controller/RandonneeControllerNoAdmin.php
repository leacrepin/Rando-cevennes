<?php
// src/Controller/RandonneeControllerNoAdmin.php
namespace App\Controller;

use App\Entity\IncriptionRando;
use App\Form\Type\InscriptionRandoType;
use App\Repository\CategorieRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\RandonneeRepository;
use Symfony\Component\HttpFoundation\Request;

class RandonneeControllerNoAdmin extends AbstractController
{

    /**
     * @Route("/cat/{id}",name="VoirRandoByCat")
     * @param RandonneeRepository $randonneeRepository
     * @return Response
     */
    public function VoirCategorie(RandonneeRepository $randonneeRepository, $id)
    {
        $randos = $randonneeRepository->findRandonneeByCat($id);

        return $this->render('randonnee.html.twig', [
            'randos' => $randos,
        ]);
    }

    /**
     * @Route("/rando/{id}",name="VoirRando")
     * @param RandonneeRepository $randonneeRepository
     * @return Response
     */
    public function VoirRando(RandonneeRepository $randonneeRepository, $id)
    {
        $rando = $randonneeRepository->find($id);

        return $this->render('randonneeDetail.html.twig', [
            'rando' => $rando,
        ]);
    }

    /**
     * @Route("/inscriptionRandonnee/{id}",name="InscriptionRando")
     * @param RandonneeRepository $randonneeRepository
     * @return Response
     */
    public function AjouterRando(RandonneeRepository $randonneeRepository, Request $request, $id = null)
    {
        $inscription = new IncriptionRando();

        if($id != null){
            $rando = $randonneeRepository->find($id);
            $formRando = $this->createForm(InscriptionRandoType::class, $inscription, array('randoDefault' => $rando));
        }else{
            $formRando = $this->createForm(InscriptionRandoType::class, $inscription);
        }

        $formRando->handleRequest($request);

        if ($formRando->isSubmitted() && $formRando->isValid()) {

            $inscription = $formRando->getData();
            $inscription->setDateDemande(new \DateTime('now'));

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($inscription);
            $entityManager->flush();

            return $this->redirectToRoute('Success');

        }else{
            return $this->render('form/form.html.twig', [
                'form' => $formRando->createView(),
            ]);
        }

    }

    /**
     * @Route("/Success",name="Success")
     * @return Response
     */
    public function Success()
    {
        return $this->render('text.html.twig', [
            'text' => 'Inscription prise en compte',
            'title' => 'Success'
        ]);
    }

}