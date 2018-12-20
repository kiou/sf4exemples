<?php

namespace App\Controller\Galerie;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Galerie\Galerie;
use App\Form\Galerie\GalerieType;
use Doctrine\Common\Collections\ArrayCollection;

class GalerieController extends Controller{

    /**
     * Ajouter une galerie
     */
    public function AddAdmin(Request $request)
    {
        $galerie = new Galerie;
        $form = $this->createForm(GalerieType::class, $galerie);

        /* Récéption du formulaire */
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /* Ajout des formats */
            foreach ($galerie->getFormats() as $format){
                $format->setGalerie($galerie);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($galerie);
            $em->flush();

            $request->getSession()->getFlashBag()->add('succes', 'Galerie enregistrée avec succès');
            return $this->redirect($this->generateUrl('admin_page_index'));
        }

        return $this->render('Galerie/Admin/add.html.twig', array(
                'form' => $form->createView()
            )
        );
    }

    public function EditAdmin(Galerie $galerie, Request $request){

        $form = $this->createForm(GalerieType::class, $galerie);

        /* fichiers en bdd */
        $originalFormats = new ArrayCollection();
        foreach ($galerie->getFormats() as $format) {
            $originalFormats->add($format);
        }

        /* Récéption du formulaire */
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();

            /* Comparaison entre bdd et modification (suppression) */
            foreach ($originalFormats as $format) {
                if (false === $galerie->getFormats()->contains($format)) {
                    $em->remove($format);
                }
            }

            /* Ajout du fichier */
            foreach ($galerie->getFormats() as $format){
                $format->setGalerie($galerie);
            }

            $em->persist($galerie);
            $em->flush();

            $request->getSession()->getFlashBag()->add('succes', 'Galerie enregistrée avec succès');
            return $this->redirect($this->generateUrl('admin_page_index'));
        }

        return $this->render('Galerie/Admin/edit.html.twig', array(
            'form' => $form->createView()
            )
        );

    }

}

?>