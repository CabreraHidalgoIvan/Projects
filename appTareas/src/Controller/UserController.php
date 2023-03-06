<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\FiltroUsersType;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user')]
class UserController extends AbstractController
{
    const ELEMENTOS_POR_PAGINA = 10;
    private $passwordHasher;
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    #[Route('/list/{pagina}', name: 'app_user_index', methods: ['GET'], requirements: ['pagina' => '\d+'], defaults: ['pagina' => 1])]
    public function index(int $pagina, UserRepository $userRepository, Request $request): Response
    {
        $filter_form = $this->createForm(FiltroUsersType::class, null, [
            'method' => 'GET',
        ]);
        $filter_form->handleRequest($request);

        $nombre = $filter_form->get('nombre')->getData();
        $email = $filter_form->get('email')->getData();
        $rol = $filter_form->get('roles')->getData();

        if ($nombre || $email || $rol) {
            $users = $userRepository->buscarConFiltros($pagina, 10, $nombre, $email, $rol);
        } else {
            $users = $userRepository->buscarTodos($pagina, 10);
        }

        return $this->render('user/index.html.twig', [
            'users' => $users,
            'pagina' => $pagina,
            'filtro_form' => $filter_form->createView(),
        ]);
    }

    #[Route('/new', name: 'app_user_new', methods: ['GET', 'POST'])]
    public function new(Request $request, UserRepository $userRepository): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setRoles(['ROLE_USER']);
            $user->setPassword($this->passwordHasher->hashPassword($user, $user->getPassword()));
            $userRepository->save($user, true);

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_user_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, UserRepository $userRepository): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword($this->passwordHasher->hashPassword($user, $user->getPassword()));
            $userRepository->save($user, true);

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, UserRepository $userRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $userRepository->remove($user, true);
        }

        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}/disable', name: 'app_user_disable', methods: ['GET'])]
    public function disable(Request $request, User $user, UserRepository $userRepository)
    {
        $user->setActivo(false);
        $userRepository->save($user, true);

        $this->addFlash('success', 'La cuenta del usuario ha sido deshabilitada');

        return $this->redirectToRoute('app_user_edit', ['id' => $user->getId()]);
    }

    #[Route('/{id}/enable', name: 'app_user_enable', methods: ['GET'])]
    public function enable(Request $request, User $user, UserRepository $userRepository)
    {
        $user->setActivo(true);
        $userRepository->save($user, true);

        $this->addFlash('success', 'La cuenta del usuario ha sido habilitada');

        return $this->redirectToRoute('app_user_edit', ['id' => $user->getId()]);
    }
}
