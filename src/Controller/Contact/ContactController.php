<?php

namespace App\Controller\Contact;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Contact\Contact;
use App\Form\Contact\ContactType;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends Controller{

    /**
     * L'index du site
     */
    public function ClientIndex(Request $request)
    {
        $contact = new contact;
        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            dump($form->getData());
        }

        return $this->render('Contact/index.html.twig', array(
                'form' => $form->createView()
            )
        );
    }

}

?>