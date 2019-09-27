<?php

namespace App\Controller;

use App\Entity\Trick;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CommunityController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        $repoTrick = $this->getDoctrine()->getRepository(Trick::class);
        $tricks = $repoTrick->findAll();

        return $this->render('community/home.html.twig', [
            'title' => "Salut les Snowboarders !",
            'tricks' => $tricks
        ]);
    }

    /**
     * @Route("/login", name="login")
     */
    public function login()
    {
        return $this->render('community/login.html.twig', [
            'controller_name' => 'CommunityController',
        ]);
    }

    /**
     * @Route("/trick/{id}", name="view_trick")
     */
    public function viewTrick($id)
    {
        $repo = $this->getDoctrine()->getRepository(Trick::class);
        $trick = $repo->find($id);

        return $this->render('community/viewTrick.html.twig', [
            'trick' => $trick
        ]);
    }
}
