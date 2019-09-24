<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $category = new Category();
        $category->setId("1")->setName("Les Grabs");
        $manager->persist($category);

        $category = new Category();
        $category->setId("2")->setName("Les rotations");
        $manager->persist($category);

        $manager->flush();
    }
}
