<?php

namespace App\Controller;

use App\Entity\Likes;
use App\Entity\Media;
use App\Entity\Posts;
use App\Entity\PostsSave;
use App\Entity\Users;
use App\Form\PostsType;
use App\Repository\LikesRepository;
use App\Repository\MediaRepository;
use App\Repository\PostsRepository;
use App\Repository\PostsSaveRepository;
use App\Repository\UsersRepository;
use Symfony\Component\Mime\Message;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
     * @Route("/explore/{username}", name="explore", methods={"GET"})
     */
    public function explore(Request $request, UsersRepository $userRepository, MediaRepository $mediaRepository, PostsRepository $postsRepository): Response
    {
        $username = $request->attributes->get('username');
        $user = $userRepository->findBy(['username' => $username]);
        $userId = $user[0]->getId();

        return $this->render('posts/explore.html.twig', [
            'media' => $mediaRepository->findAll(),
            'users' => $userRepository->findAll(),
            'posts' => $postsRepository->findAllExceptUser($userId),
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
            $file = $request->files->get('posts')['media']['__name__']['path'];
            $folder = 'assets/';

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
                $post->getMedia()[0]->setPath($newFilename);
            }
                $post->setUrl('instagram/');
                $post->setIdUser($user[0]);

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($post);
                $entityManager->flush();
            
            

            return $this->redirectToRoute('users_show', ['username' => $username], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('posts/new.html.twig', [
                    'post' => $post,
                    'form' => $form,
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

    
    /**
     * like or unlike a post
     *
     * @param  App\Entity\Posts;
     * @param  Doctrine\Persistence\ObjectManager;
     * @param  App\Repository\LikesRepository;
     * @return Symfony\Component\HttpFoundation\Response
     */
     /**
     * @Route("/{id}/like", name="post_like", methods={"GET"})
     */
    public function like(Posts $post, LikesRepository $likeRepository): Response
    {
     
        $user = $this->getUser();

        if(!$user) return $this->json([
            'Message' => 'Unauthorized'
        ], 403);

        if($post->isLikedByUser($user)){
            $like = $likeRepository->findOneBy([
                'id_post' => $post,
                'id_user' => $user,
            ]);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($like);
            $entityManager->flush();

            return $this->json([
                'message' => 'Like delete',
                'likes' => $likeRepository->count(['id_post' => $post])
            ], 200);
        }

        $like = new Likes;
        $like->setIdPost($post);
        $like->setIdUser($user);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($like);
        $entityManager->flush();

       return $this->json([
           'Message' => 'Like add',
           'likes' => $likeRepository->count(['id_post' => $post])
       ], 200);
    }

    /**
     * save a post
     *
     * @param  App\Entity\Posts;
     * @param  Doctrine\Persistence\ObjectManager;
     * @param  App\Repository\PostsSaveRepository;
     * @return Symfony\Component\HttpFoundation\Response
     */
     /**
     * @Route("/{id}/save", name="post_save", methods={"GET"})
     */
    public function postSave(Posts $post, PostsSaveRepository $postsSaveRepository): Response
    {
     
        $user = $this->getUser();

        if(!$user) return $this->json([
            'Message' => 'Unauthorized'
        ], 403);

        if($post->isSavedByUser($user)){
            $save = $postsSaveRepository->findOneBy([
                'id_post' => $post,
                'id_user' => $user,
            ]);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($save);
            $entityManager->flush();

            return $this->json([
                'message' => 'Save delete',
                'save' => $postsSaveRepository->count(['id_post' => $post])
            ], 200);
        }

        $save = new PostsSave;
        $save->setIdPost($post);
        $save->setIdUser($user);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($save);
        $entityManager->flush();

       return $this->json([
           'Message' => 'save add',
           'Save' => $postsSaveRepository->count(['id_post' => $post])
       ], 200);
    }

   
}
