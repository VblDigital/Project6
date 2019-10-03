<?php


namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UserController
 * @package App\Controller
 */
class UserController extends CommunityController
{
    /**
     * @Route("/newuser", name="new_user")
     * @Route("/user/{id}/edit", name="edit_user")
     */
    public function userForm(User $user = null, Request $request, ObjectManager $manager)
    {
        if(!$user){
            $user = new User();
        }

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            if(!$user->getId()){
                $user->setNewPass('0')
                     ->setType('Author');
            }

            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('view_user', ['id' => $user->getId()]);
        }

        return $this->render('community/newUser.html.twig', [
            'formUser' => $form->createView(),
            'editMode' => $user->getId() !== null
        ]);
    }

    /**
     * @Route("/user/{id}", name="view_user")
     */
    public function viewUser($id)
    {
        $repo = $this->getDoctrine()->getRepository(User::class);
        $user = $repo->find($id);

        return $this->render('community/viewUser.html.twig', [
            'user' => $user
        ]);
    }
}
