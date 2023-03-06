<?php

namespace App\Controller;

use App\Entity\EstadoTarea;
use App\Form\EstadoTareaType;
use App\Repository\EstadoTareaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/estado/tarea')]
class EstadoTareaController extends AbstractController
{
    #[Route('/', name: 'app_estado_tarea_index', methods: ['GET'])]
    public function index(EstadoTareaRepository $estadoTareaRepository): Response
    {
        return $this->render('estado_tarea/index.html.twig', [
            'estado_tareas' => $estadoTareaRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_estado_tarea_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EstadoTareaRepository $estadoTareaRepository): Response
    {
        $estadoTarea = new EstadoTarea();
        $form = $this->createForm(EstadoTareaType::class, $estadoTarea);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $estadoTareaRepository->save($estadoTarea, true);

            return $this->redirectToRoute('app_estado_tarea_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('estado_tarea/new.html.twig', [
            'estado_tarea' => $estadoTarea,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_estado_tarea_show', methods: ['GET'])]
    public function show(EstadoTarea $estadoTarea): Response
    {
        return $this->render('estado_tarea/show.html.twig', [
            'estado_tarea' => $estadoTarea,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_estado_tarea_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EstadoTarea $estadoTarea, EstadoTareaRepository $estadoTareaRepository): Response
    {
        $form = $this->createForm(EstadoTareaType::class, $estadoTarea);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $estadoTareaRepository->save($estadoTarea, true);

            return $this->redirectToRoute('app_estado_tarea_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('estado_tarea/edit.html.twig', [
            'estado_tarea' => $estadoTarea,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_estado_tarea_delete', methods: ['POST'])]
    public function delete(Request $request, EstadoTarea $estadoTarea, EstadoTareaRepository $estadoTareaRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$estadoTarea->getId(), $request->request->get('_token'))) {
            $estadoTareaRepository->remove($estadoTarea, true);
        }

        return $this->redirectToRoute('app_estado_tarea_index', [], Response::HTTP_SEE_OTHER);
    }
}
