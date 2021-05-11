<?php

namespace App\Controller;

use App\Entity\Formationsarep;
use App\Form\FormationsarepType;
use App\Repository\FormationsarepRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/formationsarep")
 */
class FormationsarepController extends AbstractController
{
    /**
     * @Route("/", name="formationsarep_index", methods={"GET"})
     */
    public function index(FormationsarepRepository $formationsarepRepository): Response
    {
        return $this->render('formationsarep/index.html.twig', [
            'formationsareps' => $formationsarepRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="formationsarep_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $formationsarep = new Formationsarep();
        $form = $this->createForm(FormationsarepType::class, $formationsarep);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($formationsarep);
            $entityManager->flush();

            return $this->redirectToRoute('formationsarep_index');
        }

        return $this->render('formationsarep/new.html.twig', [
            'formationsarep' => $formationsarep,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="formationsarep_show", methods={"GET"})
     */
    public function show(Formationsarep $formationsarep): Response
    {
        return $this->render('formationsarep/show.html.twig', [
            'formationsarep' => $formationsarep,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="formationsarep_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Formationsarep $formationsarep): Response
    {
        $form = $this->createForm(FormationsarepType::class, $formationsarep);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('formationsarep_index');
        }

        return $this->render('formationsarep/edit.html.twig', [
            'formationsarep' => $formationsarep,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="formationsarep_delete", methods={"POST"})
     */
    public function delete(Request $request, Formationsarep $formationsarep): Response
    {
        if ($this->isCsrfTokenValid('delete'.$formationsarep->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($formationsarep);
            $entityManager->flush();
        }

        return $this->redirectToRoute('formationsarep_index');
    }
}
