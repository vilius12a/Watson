<?php


namespace App\Controller;

use App\Entity\Procedure;
use App\Form\ProcedureAddFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProcedureController extends AbstractController
{

    /**
     * @Route("/procedure/list", name="app_procedure")
     */
    public function Procedure() : Response{

        $repository = $this->getDoctrine()->getRepository(Procedure::class);
        $types = $repository->findAll();

        return $this->render('procedure/procedure.html.twig', [
            'types' => $types,
        ]);
    }

    /**
     * @Route("/procedure/add", name="app_procedure_add")
     */
    public function ProcedureAdd(Request $request) : Response{

        $procedure = new Procedure();

        $form = $this->createForm( ProcedureAddFormType::class, $procedure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $procedure->setCost($form->get('cost')->getData());
            $procedure->setName($form->get('name')->getData());
            $procedure->setActive(
                $form->get('active')->getData()
            );

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($procedure);
            $entityManager->flush();

            return $this->redirectToRoute('app_procedure');
        }

        return $this->render('procedure/procedureAdd.html.twig', [
            'procedureAddForm' => $form->createView(),
        ]);
    }
}