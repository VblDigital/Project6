<?php


namespace App\Controller;

use App\Entity\Trick;
use App\Entity\Comment;
use App\Form\CommentType;
use App\Form\TrickType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TrickController
 * @package App\Controller
 */
class TrickController extends CommunityController
{
    /**
     * @Route("/newtrick", name="new_trick")
     * @Route("/trick/{id}/edit", name="edit_trick")
     */
    public function trickForm(Trick $trick = null, Request $request, ObjectManager $manager)
    {
        if(!$trick){
            $trick = new Trick();
        }

        $form = $this->createForm(TrickType::class, $trick);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $manager->persist($trick);
            $manager->flush();

            return $this->redirectToRoute('view_trick', ['id' => $trick->getId()]);
        }

        return $this->render('community/newTrick.html.twig', [
            'formTrick' => $form->createView(),
            'editMode' => $trick->getId() !== null
        ]);
    }

    /**
     * @Route("/trick/{id}", name="view_trick")
     */
    public function viewTrick($id, Request $request, ObjectManager $manager)
    {
        $repo = $this->getDoctrine()->getRepository(Trick::class);
        $trick = $repo->find($id);

        $comment = new Comment();

        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setDate(new \DateTime())
                    ->setTrick($trick);

            $manager->persist($comment);
            $manager->flush();

            return $this->redirectToRoute('view_trick', ['id' => $trick->getId()]);
        }

        return $this->render('community/viewTrick.html.twig', [
            'trick' => $trick,
            'formComment' => $form->createView()
        ]);
    }
}
