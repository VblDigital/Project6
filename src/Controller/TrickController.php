<?php


namespace App\Controller;

use App\DataFixtures\CategoryFixtures;
use App\DataFixtures\UserFixtures;
use App\Entity\Trick;
use App\Form\TrickType;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use function PHPSTORM_META\type;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TrickController
 * @package App\Controller
 */
class TrickController extends CommunityController implements DependentFixtureInterface
{
    /**
     * @return array
     */
    public function getDependencies ()
    {
        return array(
            UserFixtures::class,
            CategoryFixtures::class);
    }

    /**
     * @Route("/newtrick", name="new_trick")
     */

    public function trickForm(Request $request, ObjectManager $manager)
    {
        $trick = new Trick();

        $form = $this->createForm(TrickType::class, $trick);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $manager->persist($trick);
            $manager->flush();

            return $this->redirectToRoute('view_trick', ['id' => $trick->getId()]);
        }

        return $this->render('community/newTrick.html.twig', [
            'formTrick' => $form->createView()
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
