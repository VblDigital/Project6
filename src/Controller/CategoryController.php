<?php


namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * Class CategoryController
 * @package App\Controller
 */
class CategoryController extends AbstractController
{
    /**
     * @Route("/newcategory", name="new_category")
     * @Route("/category/{id}/edit", name="edit_category")
     * @Security("is_granted('ROLE_USER')")
     */
    public function categoryForm(Category $category = null, Request $request, ObjectManager $manager)
    {
        if(!$category){
            $category = new Category();
        }

        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $manager->persist($category);
            $manager->flush();

            return $this->redirectToRoute('view_categories', ['id' => $category->getId()]);
        }

        return $this->render('community/newCategory.html.twig', [
            'formCategory' => $form->createView(),
            'editMode' => $category->getId() !== null
        ]);
    }

    /**
     * @Route("/categories", name="view_categories")
     * @Security("is_granted('ROLE_USER')")
     */
    public function viewCategories()
    {
        $repo = $this->getDoctrine()->getRepository(Category::class);
        $category = $repo->findAll();

        return $this->render('community/viewCategories.html.twig', [
            'category' => $category
        ]);
    }
}
