<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ContactController
 * @package App\Controller
 */
class ContactController extends SecurityController
{
    /**
     * @return Response
     */
    public function index()
    {
        $contacts = $this->getDoctrine()
            ->getRepository(Contact::class)
            ->findAll();

        return $this->render('contacts/overview.html.twig', ['contacts' => $contacts]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function new(Request $request)
    {
        $contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contact);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Contact succesvol toegevoegd.'
            );

            return $this->redirectToRoute('contact_index');
        }

        return $this->render('contacts/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param Contact $contact
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function edit(Contact $contact, Request $request)
    {
        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contact);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Contact succesvol bijgewerkt.'
            );

            return $this->redirectToRoute('contact_index');
        }

        return $this->render('contacts/edit.html.twig', [
            'form' => $form->createView(),
            'contact' => $contact,
        ]);
    }
}