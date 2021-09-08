<?php

namespace App\Controller;

use App\Entity\Posts;
use App\Entity\Users;
use App\Entity\Media;
use App\Form\PostsType;
use App\Repository\PostsRepository;
use App\Repository\MediaRepository;
use App\Repository\UsersRepository;
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
     * @Route("/explore", name="explore", methods={"GET"})
     */
    public function index(MediaRepository $mediaRepository, PostsRepository $postsRepository): Response
    {


        return $this->render('posts/index.html.twig', [
            'media' => $mediaRepository->findAll(),
            'posts' => $postsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{username}/new", name="posts_new", methods={"GET","POST"})
     */
    public function new(UsersRepository $userRepository, Request $request): Response
    {
        $post = new Posts();
        $form = $this->createForm(PostsType::class, $post);
        $form->handleRequest($request);

        
        $username = $request->attributes->get('username');
        $user = $userRepository->findBy(['username' => $username]);

        // $file stores the uploaded file
        /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
        

        if ($form->isSubmitted() && $form->isValid()) {
          
            $files = $request->files->get('posts')['media']['__name__']['path'];
            $folder = 'assets/';
            foreach($files as $file){
           
                if ($file) {
                    $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    // this is needed to safely include the file name as part of the URL
                    // $safeFilename = $slugger->slug($originalFilename);
                    $newFilename = $folder. $originalFilename.'-'.uniqid().'.'.$file->guessExtension();

                    // Move the file to the directory where brochures are stored
                    try {
                        $file->move(
                            $this->getParameter('assets'),
                            $newFilename
                        );
                    } catch (FileException $e) {
                        // ... handle exception if something happens during file upload
                    }
            
                    // updates the 'brochureFilename' property to store the path file name
                    
                    $img = new Media;
                    $img->setPath($newFilename);
                    $post->addMedium($img);
            }    
                $post->setUrl('instagram/');
                $post->setIdUser($user[0]);

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($post);
                $entityManager->flush();
            }
            

            return $this->redirectToRoute('users_show', ['username' => $username], Response::HTTP_SEE_OTHER);
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
