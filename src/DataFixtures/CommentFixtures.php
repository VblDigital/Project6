<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class CommentFixtures
 * @package App\DataFixtures
 */
class CommentFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @return array
     */
    public function getDependencies ()
    {
        return array(
            TrickFixtures::class,
            UserFixtures::class);
    }

    /**
     * @param ObjectManager $manager
     * @throws \Exception
     */
    public function load( ObjectManager $manager)
    {
        $comment = new Comment();
        $comment
            ->setText("Ceci est le premier commentaire de test de ce site communautaire.")
            ->setDate(new \DateTime());
        $comment->setTrick($this->getReference('td'));
        $comment->setUser($this->getReference('bobama'));
        $manager->persist($comment);

        $comment = new Comment();
        $comment
            ->setText("Ceci est le deuxième commentaire de test de ce site communautaire.")
            ->setDate(new \DateTime());
        $comment->setTrick($this->getReference('r36'));
        $comment->setUser($this->getReference('amerkel'));
        $manager->persist($comment);

        $comment = new Comment();
        $comment
            ->setText("Ceci est le troisième commentaire de test de ce site communautaire.")
            ->setDate(new \DateTime());
        $comment->setTrick($this->getReference('td'));
        $comment->setUser($this->getReference('bobama'));
        $manager->persist($comment);

        $manager->flush();
    }
}
