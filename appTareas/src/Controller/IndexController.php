<?php

namespace App\Controller;

use App\Form\FiltroTareasType;
use App\Repository\TareaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{

    const ELEMENTS_PER_PAGE = 10;

    #[Route('/{pagina}',
        name: 'app_index',
        requirements: ['pagina' => '\d+'],
        defaults: ['pagina' => 1],
        methods: ['GET'])]
    public function index(int $pagina, TareaRepository $tareaRepository, Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $filter_form = $this->createForm(FiltroTareasType::class, null, [
            'method' => 'GET',
        ]);
        $filter_form->handleRequest($request);

        $nombre = $filter_form->get('nombre')->getData();
        $descripcion = $filter_form->get('descripcion')->getData();
        $estado = $filter_form->get('estado')->getData();

        $usuarios = $tareaRepository->findAll();

        if ($nombre || $descripcion || $estado) {
            $tareas = $tareaRepository->buscarConFiltros($pagina, 10, $nombre, $descripcion, $estado);
        } else {
            $tareas = $tareaRepository->buscarTodas($pagina, 10);
        }

        return $this->render(
            'index/index.html.twig',
            [
                'tareas' => $tareas,
                'pagina' => $pagina,
                'filtro_form' => $filter_form->createView(),
                'usuarios' => $usuarios,
            ]
        );
    }
}
