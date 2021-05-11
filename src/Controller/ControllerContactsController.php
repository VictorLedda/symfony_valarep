<?php

namespace App\Controller;

use App\Entity\Contacts;
use App\Form\ContactsType;
use App\Repository\ContactsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/controller/contacts")
 */
class ControllerContactsController extends AbstractController
{
    /**
     * @Route("/", name="controller_contacts_index", methods={"GET"})
     */
    public function index(ContactsRepository $contactsRepository): Response
    {
        return $this->render('controller_contacts/index.html.twig', [
            'contacts' => $contactsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="controller_contacts_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $contact = new Contacts();
        $form = $this->createForm(ContactsType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contact);
            $entityManager->flush();

            return $this->redirectToRoute('controller_contacts_index');
        }

        return $this->render('controller_contacts/new.html.twig', [
            'contact' => $contact,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="controller_contacts_show", methods={"GET"})
     */
    public function show(Contacts $contact): Response
    {
        return $this->render('controller_contacts/show.html.twig', [
            'contact' => $contact,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="controller_contacts_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Contacts $contact): Response
    {
        $form = $this->createForm(ContactsType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('controller_contacts_index');
        }

        return $this->render('controller_contacts/edit.html.twig', [
            'contact' => $contact,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="controller_contacts_delete", methods={"POST"})
     */
    public function delete(Request $request, Contacts $contact): Response
    {
        if ($this->isCsrfTokenValid('delete'.$contact->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($contact);
            $entityManager->flush();
        }

        return $this->redirectToRoute('controller_contacts_index');
    }
}
