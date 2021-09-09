<?php

namespace App\Controller;

use App\Entity\Media;
use App\Entity\Posts;
use App\Entity\Users;
use App\Form\UsersType;
use App\Entity\Followers;
use App\Repository\MediaRepository;
use App\Repository\PostsRepository;
use App\Repository\UsersRepository;
use App\Repository\FollowersRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


/**
 * @Route("/")
 */
class UsersController extends AbstractController 
{

    public function profilthumbnail(UsersRepository $usersRepository): Response
    {
        return $this->render('base.html.twig', [
            'users' => $usersRepository->findAll(),
        ]);
    }


    /**
     * @Route("/", name="users_index", methods={"GET"})
     */
    public function index(UsersRepository $usersRepository): Response
    {
        return $this->render('users/index.html.twig', [
            'users' => $usersRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="users_new", methods={"GET","POST"})
     */
    public function new(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = new Users();
        $form = $this->createForm(UsersType::class, $user);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('password')->getData()
                )
            );
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            
            if($this->getUser()){
                $username = $this->getUser()->getUsername(); 
                return $this->redirectToRoute('users_show', ['username' => $username]);
            }
        }

        return $this->renderForm('users/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{username}", name="users_show", methods={"GET"})
     */
    public function show(Users $user, PostsRepository $postsRepository): Response
    {
        
        $id_user = $user->getId();
        
        return $this->render('users/show.html.twig', [
            'user' => $user,
            'posts' => $postsRepository->findBy(['id_user' => $id_user]),
            
        ]);

    }

    /**
     * @Route("/{username}/home}", name="home", methods={"GET"})
     */
    public function home(Users $user,UsersRepository $usersRepository, FollowersRepository $FollowersRepository, PostsRepository $postsRepository): Response
    {
        
        $id_user = $user->getId();
        
        $followersarray =$FollowersRepository->findBy(['id_user' => $id_user]); 

        foreach($followersarray as $follower ){
            $id_followers[] = $follower->getFollower();
        }

        return $this->render('users/home.html.twig', [
            'user' => $user,
            'users_post' => $usersRepository->findBy(['id' => $id_followers]),
        ]);

    }

    /**
     * @Route("/{username}", name="thumbnail_edit", methods={"GET","POST"})
     */
    public function userthumbnail(Request $request, Users $user): Response
    {

            // $file stores the uploaded file
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $request->files->get('thumbnail_input');
            $folder = 'assets/profil/';
                
            if ($file) {
                $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                // $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $folder. $originalFilename.'-'.uniqid().'.'.$file->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $file->move(
                        $this->getParameter('profil'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the path file name
                $user->setThumbnail($newFilename);
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            
            $username = $this->getUser()->getUsername(); 
            return $this->redirectToRoute('users_show', ['username' => $username], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/{username}/deletethumbnail", name="thumbnail_delete", methods={"GET","POST"})
     */
    public function deletethumbnail(Request $request, Users $user): Response
    {
            
            $this->getUser()->setThumbnail('assets/profil/default_picture.jpg');
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            
            $username = $this->getUser()->getUsername(); 
            return $this->redirectToRoute('users_show', ['username' => $username], Response::HTTP_SEE_OTHER);
    }
        
     /**
     * @Route("/{username}/edit", name="users_edit", methods={"GET","POST"})
     */
    public function userprofile(Request $request, Users $user): Response
    {
        $form = $this->createForm(UsersType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('users_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('users/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }


    /**
     * @Route("/{username}", name="users_delete", methods={"POST"})
     */
    public function delete(Request $request, Users $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('users_index', [], Response::HTTP_SEE_OTHER);
    }
}
