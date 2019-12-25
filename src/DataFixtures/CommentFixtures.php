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
            ->setDate(new \DateTime())
            ->setTrick($this->getReference('td'))
            ->setUser($this->getReference('bobama'));
        $manager->persist($comment);

        $comment = new Comment();
        $comment
            ->setText("Ceci est le deuxième commentaire de test de ce site communautaire.")
            ->setDate(new \DateTime())
            ->setTrick($this->getReference('r36'))
            ->setUser($this->getReference('amerkel'));
        $manager->persist($comment);

        $comment = new Comment();
        $comment
            ->setText("Ceci est le troisième commentaire de test de ce site communautaire.")
            ->setDate(new \DateTime())
            ->setTrick($this->getReference('td'))
            ->setUser($this->getReference('bobama'));
        $manager->persist($comment);

        $comment = new Comment();
        $comment
            ->setText("Ceci est le quatrième commentaire de test de ce site communautaire.")
            ->setDate(new \DateTime())
            ->setTrick($this->getReference('td'))
            ->setUser($this->getReference('emacron'));
        $manager->persist($comment);

        $comment = new Comment();
        $comment
            ->setText("Ceci est le cinquième commentaire de test de ce site communautaire.")
            ->setDate(new \DateTime())
            ->setTrick($this->getReference('r900'))
            ->setUser($this->getReference('bobama'));
        $manager->persist($comment);

        $comment = new Comment();
        $comment
            ->setText("Ceci est le sixième commentaire de test de ce site communautaire.")
            ->setDate(new \DateTime())
            ->setTrick($this->getReference('td'))
            ->setUser($this->getReference('amerkel'));
        $manager->persist($comment);

        $comment = new Comment();
        $comment
            ->setText("Ceci est le septième commentaire de test de ce site communautaire.")
            ->setDate(new \DateTime())
            ->setTrick($this->getReference('td'))
            ->setUser($this->getReference('bobama'));
        $manager->persist($comment);

        $comment = new Comment();
        $comment
            ->setText("Ceci est le huitième commentaire de test de ce site communautaire.")
            ->setDate(new \DateTime())
            ->setTrick($this->getReference('td'))
            ->setUser($this->getReference('emacron'));
        $manager->persist($comment);

        $comment = new Comment();
        $comment
            ->setText("Ceci est le neuvième commentaire de test de ce site communautaire.")
            ->setDate(new \DateTime())
            ->setTrick($this->getReference('r900'))
            ->setUser($this->getReference('bobama'));
        $manager->persist($comment);

        $comment = new Comment();
        $comment
            ->setText("Ceci est le dizième commentaire de test de ce site communautaire.")
            ->setDate(new \DateTime())
            ->setTrick($this->getReference('td'))
            ->setUser($this->getReference('bobama'));
        $manager->persist($comment);

        $comment = new Comment();
        $comment
            ->setText("Ceci est le onzième commentaire de test de ce site communautaire.")
            ->setDate(new \DateTime())
            ->setTrick($this->getReference('td'))
            ->setUser($this->getReference('bobama'));
        $manager->persist($comment);

        $comment = new Comment();
        $comment
            ->setText("Ceci est le douzième commentaire de test de ce site communautaire.")
            ->setDate(new \DateTime())
            ->setTrick($this->getReference('td'))
            ->setUser($this->getReference('bobama'));
        $manager->persist($comment);

        $comment = new Comment();
        $comment
            ->setText("Ceci est le treizième commentaire de test de ce site communautaire.")
            ->setDate(new \DateTime())
            ->setTrick($this->getReference('td'))
            ->setUser($this->getReference('emacron'));
        $manager->persist($comment);

        $comment = new Comment();
        $comment
            ->setText("Ceci est le quatorzième commentaire de test de ce site communautaire.")
            ->setDate(new \DateTime())
            ->setTrick($this->getReference('td'))
            ->setUser($this->getReference('amerkel'));
        $manager->persist($comment);

        $comment = new Comment();
        $comment
            ->setText("Ceci est le quinzième commentaire de test de ce site communautaire.")
            ->setDate(new \DateTime())
            ->setTrick($this->getReference('r900'))
            ->setUser($this->getReference('bobama'));
        $manager->persist($comment);

        $comment = new Comment();
        $comment
            ->setText("Ceci est le seizième commentaire de test de ce site communautaire.")
            ->setDate(new \DateTime())
            ->setTrick($this->getReference('td'))
            ->setUser($this->getReference('bobama'));
        $manager->persist($comment);

        $manager->flush();
    }
}
