<?php

namespace App\Controller\General;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\General\Langue;
use App\Entity\Galerie\Galerie;
use App\Entity\Galerie\Categorie;

class GeneralController extends Controller{

    /**
     * L'index du site
     */
    public function ClientIndex()
    {
        return $this->render('General/Page/index.html.twig');
    }

    /**
     * L'index de l'administration
     */
    public function AdminIndex()
    {

        /* La liste des galeries */
        $galeries = $this->getDoctrine()
                         ->getRepository(Galerie::class)
                         ->findAll();

        $categories = $this->getDoctrine()
                           ->getRepository(Categorie::class)
                           ->findAll(); 

        dump($categories);

        return $this->render('General/Admin/Page/index.html.twig', array(
                'galeries' => $galeries,
                'categories' => $categories
            )
        );
    }

    /**
     * Selecteur de langue
     */
    public function SelecteurLangue()
    {
        $langues = $this->getDoctrine()->getRepository(Langue::class)->findAll();

        return $this->render('General/Langue/selecteur.html.twig',array(
                'langues' => $langues
            )
        );
    }

}

?>