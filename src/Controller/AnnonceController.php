<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AnnonceRepository;
use App\Entity\Annonce;

class AnnonceController extends AbstractController
{
     /**
     * @var AnnonceRepository
     */
    private $repo;

    public function __construct(AnnonceRepository $repository)
    {   
        $this->repo = $repository;     
    }

    /**
     * @Route("/annonces", name="annonce.index")
     */
    public function index()
    {
        $annonces = $this->repo->findAll();

        return $this->render('annonce/index.html.twig',[
            'annonces' => $annonces
        ]);
    }

    /**
     * @Route("/annonces/{id}", name="annonce.show")
     */

    public function show(Annonce $annonce)
    {
        // $annonce = $this->repo->find($id);
        return $this->render('annonce/show.html.twig',[
            'annonce' => $annonce
        ]);
    }
}
