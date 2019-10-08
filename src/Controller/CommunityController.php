<?php

namespace App\Controller;

use App\Entity\Trick;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CommunityController
 * @package App\Controller
 */
class CommunityController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        $tricks = $this->getDoctrine()
            ->getRepository(Trick::class)
            ->getFindAllQuery();
        //Il ne reconnaît pas ma fonction (ref doc : https://symfony.com/doc/current/doctrine.html Querying for Objects: The Repository)

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
}
