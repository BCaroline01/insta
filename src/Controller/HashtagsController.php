<?php

namespace App\Controller;

use App\Entity\Hashtags;
use App\Form\HashtagsType;
use App\Repository\HashtagsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/hashtags")
 */
class HashtagsController extends AbstractController
{
    /**
     * @Route("/", name="hashtags_index", methods={"GET"})
     */
    public function index(HashtagsRepository $hashtagsRepository): Response
    {
        return $this->render('hashtags/index.html.twig', [
            'hashtags' => $hashtagsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="hashtags_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $hashtag = new Hashtags();
        $form = $this->createForm(HashtagsType::class, $hashtag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($hashtag);
            $entityManager->flush();

            return $this->redirectToRoute('hashtags_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('hashtags/new.html.twig', [
            'hashtag' => $hashtag,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="hashtags_show", methods={"GET"})
     */
    public function show(Hashtags $hashtag): Response
    {
        return $this->render('hashtags/show.html.twig', [
            'hashtag' => $hashtag,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="hashtags_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Hashtags $hashtag): Response
    {
        $form = $this->createForm(HashtagsType::class, $hashtag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('hashtags_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('hashtags/edit.html.twig', [
            'hashtag' => $hashtag,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="hashtags_delete", methods={"POST"})
     */
    public function delete(Request $request, Hashtags $hashtag): Response
    {
        if ($this->isCsrfTokenValid('delete'.$hashtag->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($hashtag);
            $entityManager->flush();
        }

        return $this->redirectToRoute('hashtags_index', [], Response::HTTP_SEE_OTHER);
    }
}
