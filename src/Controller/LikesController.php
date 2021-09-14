<?php

namespace App\Controller;

use App\Entity\Likes;
use App\Form\LikesType;
use App\Repository\LikesRepository;
use App\Repository\PostsRepository;
use App\Repository\UsersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/likes")
 */
class LikesController extends AbstractController
{
    /**
     * @Route("/", name="likes_index", methods={"GET"})
     */
    public function index(LikesRepository $likesRepository): Response
    {
        return $this->render('likes/index.html.twig', [
            'likes' => $likesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{username}/new", name="likes_new", methods={"GET","POST"})
     */
    public function new(Request $request, PostsRepository $postsrepository, UsersRepository $usersrepository ): Response
    {
        $like = new Likes;

        $id_post_input = $request->request->get('post_id');
        $id_post = $postsrepository->find($id_post_input);

        $id_user_input = $request->request->get('user_id');
        $id_user = $usersrepository->find($id_user_input);
       
        $like->setIdPost($id_post);
        $like->setIdUser($id_user);

        
        if($id_user_input != null && $id_post_input != null){

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($like);
            $entityManager->flush();

            return $this->redirectToRoute('likes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('likes/new.html.twig', [
            'like' => $like,
        ]);
    }

    /**
     * @Route("/{id}", name="likes_show", methods={"GET"})
     */
    public function show(Likes $like): Response
    {
        return $this->render('likes/show.html.twig', [
            'like' => $like,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="likes_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Likes $like): Response
    {
        $form = $this->createForm(LikesType::class, $like);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('likes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('likes/edit.html.twig', [
            'like' => $like,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="likes_delete", methods={"POST"})
     */
    public function delete(Request $request, Likes $like): Response
    {
        if ($this->isCsrfTokenValid('delete'.$like->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($like);
            $entityManager->flush();
        }

        return $this->redirectToRoute('likes_index', [], Response::HTTP_SEE_OTHER);
    }
}
