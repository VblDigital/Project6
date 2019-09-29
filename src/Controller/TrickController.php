<?php


namespace App\Controller;


use App\Entity\Trick;
use Symfony\Component\Routing\Annotation\Route;

class TrickController extends CommunityController
{
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
