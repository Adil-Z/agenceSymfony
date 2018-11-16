<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\AnnonceRepository;
use App\Form\AnnonceType;
use App\Entity\Annonce;
use Doctrine\Common\Persistence\ObjectManager;

class AdminAnnonceController extends AbstractController{

    public function __construct(AnnonceRepository $repository)
    {
        $this->repo = $repository;
    }

    /** 
    *@Route("/admin", name="admin.annonce.index")
    */
    public function index(){
        $annonces = $this->repo->findAll();
        return $this->render('admin/annonce/index.html.twig', array('annonces'=> $annonces));
    }

    /** 
    *@Route("/admin/creer", name="admin.annonce.create")
    *@Route("/admin/{id}/edit", name="admin.annonce.edit")
    */

    public function create(Annonce $annonce = null, Request $request, ObjectManager $em){

        if(!$annonce){
            $annonce = new Annonce();
        }
        $formAnnonce = $this->createForm(AnnonceType::class, $annonce);
        $formAnnonce->handleRequest($request);

        if($formAnnonce->isSubmitted() && $formAnnonce->isValid()){

            // $annonce = $formAnnonce->getData();
            $em->persist($annonce);
            $em->flush();

            return $this->redirectToRoute( 'annonce.show',['id' => $annonce->getId()] );
        }


        return $this->render('admin/annonce/create.html.twig',[
            'form' => $formAnnonce->createView(),
            'edit_mode' => $annonce->getId()
        ]);
    }

}