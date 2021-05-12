<?php

namespace App\Controller;

use App\Entity\Procedure;
use App\Form\ProcedureType;
use App\Repository\ProcedureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/procedure")
 */
class ProcedureController extends AbstractController
{
    /**
     * @Route("/", name="procedure_index", methods={"GET"})
     */
    public function index(ProcedureRepository $procedureRepository): Response
    {
        return $this->render('procedure/index.html.twig', [
            'procedures' => $procedureRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="procedure_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $procedure = new Procedure();
        $form = $this->createForm(ProcedureType::class, $procedure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($procedure);
            $entityManager->flush();

            return $this->redirectToRoute('procedure_index');
        }

        return $this->render('procedure/new.html.twig', [
            'procedure' => $procedure,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="procedure_show", methods={"GET"})
     */
    public function show(Procedure $procedure): Response
    {
        return $this->render('procedure/show.html.twig', [
            'procedure' => $procedure,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="procedure_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Procedure $procedure): Response
    {
        $form = $this->createForm(ProcedureType::class, $procedure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('procedure_index');
        }

        return $this->render('procedure/edit.html.twig', [
            'procedure' => $procedure,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="procedure_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Procedure $procedure): Response
    {
        if ($this->isCsrfTokenValid('delete'.$procedure->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($procedure);
            $entityManager->flush();
        }

        return $this->redirectToRoute('procedure_index');
    }
}
