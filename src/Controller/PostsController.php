<?php

namespace App\Controller;

use App\Entity\Posts;
use App\Entity\Media;
use App\Form\PostsType;
use App\Repository\PostsRepository;
use App\Repository\MediaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/posts")
 */
class PostsController extends AbstractController
{
    
    public function baseIndex()
    {
        return $this->render('posts/index.html.twig');
    }

    /**
     * @Route("/", name="posts_index", methods={"GET"})
     */
    public function index(MediaRepository $mediaRepository, PostsRepository $postsRepository): Response
    {
        return $this->render('posts/index.html.twig', [
            'media' => $mediaRepository->findAll(),
            'posts' => $postsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="posts_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $post = new Posts();
        $form = $this->createForm(PostsType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($post);
            $entityManager->flush();

            return $this->redirectToRoute('posts_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('posts/new.html.twig', [
            'post' => $post,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="posts_show", methods={"GET"})
     */
    public function show(Posts $post): Response
    {
        return $this->render('posts/show.html.twig', [
            'post' => $post,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="posts_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Posts $post): Response
    {
        $form = $this->createForm(PostsType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('posts_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('posts/edit.html.twig', [
            'post' => $post,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="posts_delete", methods={"POST"})
     */
    public function delete(Request $request, Posts $post): Response
    {
        if ($this->isCsrfTokenValid('delete'.$post->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($post);
            $entityManager->flush();
        }

        return $this->redirectToRoute('posts_index', [], Response::HTTP_SEE_OTHER);
    }
}
