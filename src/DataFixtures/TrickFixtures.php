<?php

namespace App\DataFixtures;

use App\Entity\Trick;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class TrickFixtures
 * @package App\DataFixtures
 */
class TrickFixtures extends Fixture implements DependentFixtureInterface
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
     * @param ObjectManager $manager
     */
    public function load( ObjectManager $manager)
    {
        $trick = new Trick();
        $trick
            ->setName("Le Mute")
            ->setDescription("Grab avec saisie de la carre frontside de la planche entre les deux pieds avec la main avant.")
            ->setImageLink("http://placehold.it/350X150")
            ->setChapo("Grab avec saisie de la carre frontside de la planche entre les deux pieds avec la main avant.");
        $trick->setUser($this->getReference('bobama'));
        $trick->setCategory($this->getReference('cat1'));
        $manager->persist($trick);
        $this->addReference("mute", $trick);

        $trick = new Trick();
        $trick
            ->setName("Le Style Week")
            ->setDescription("Grab avec saisie de la carre backside de la planche, entre les deux pieds, avec la main avant.")
            ->setImageLink("http://placehold.it/350X150")
            ->setUser($this->getReference('emacron'));
        $trick->setChapo("Grab avec saisie de la carre backside de la planche, entre les deux pieds, avec la main avant.");
        $trick->setCategory($this->getReference("cat1"));
        $manager->persist($trick);
        $this->addReference("sw", $trick);

        $trick = new Trick();
        $trick
            ->setName("L'Indy ")
            ->setDescription("Grab avec saisie de la carre frontside de la planche, entre les deux pieds, avec la main arrière.")
            ->setImageLink("http://placehold.it/350X150")
            ->setUser($this->getReference('bobama'));
        $trick->setChapo("Grab avec saisie de la carre frontside de la planche, entre les deux pieds, avec la main arrière.");
        $trick->setCategory($this->getReference("cat1"));
        $manager->persist($trick);
        $this->addReference("indy", $trick);

        $trick = new Trick();
        $trick
            ->setName("Le Stalefish ")
            ->setDescription("Grab avec saisie de la carre backside de la planche entre les deux pieds avec la main arrière.")->setImageLink("http://placehold.it/350X150")
            ->setChapo("Grab avec saisie de la carre backside de la planche entre les deux pieds avec la main arrière.");
        $trick->setUser($this->getReference('amerkel'));
        $trick->setCategory($this->getReference("cat1"));
        $manager->persist($trick);
        $this->addReference("stalefish", $trick);

        $trick = new Trick();
        $trick
            ->setName("Le Tail Grab")
            ->setDescription("Grab avec saisie de la partie arrière de la planche, avec la main arrière.")
            ->setImageLink("http://placehold.it/350X150")
            ->setChapo("Grab avec saisie de la partie arrière de la planche, avec la main arrière.");
        $trick->setUser($this->getReference('amerkel'));
        $trick->setCategory($this->getReference("cat1"));
        $manager->persist($trick);
        $this->addReference("tg", $trick);

        $trick = new Trick();
        $trick
            ->setName("Le Nose Grab")
            ->setDescription("Grab avec saisie de la partie avant de la planche, avec la main avant.")
            ->setImageLink("http://placehold.it/350X150")
            ->setChapo("Grab avec saisie de la partie avant de la planche, avec la main avant.");
        $trick->setUser($this->getReference('bobama'));
        $trick->setCategory($this->getReference("cat1"));
        $manager->persist($trick);
        $this->addReference("ng", $trick);

        $trick = new Trick();
        $trick
            ->setName("Le Japan Air")
            ->setDescription("Grab avec saisie de l'avant de la planche, avec la main avant, du côté de la carre frontside.")
            ->setImageLink("http://placehold.it/350X150")
            ->setChapo("Grab avec saisie de l'avant de la planche, avec la main avant, du côté de la carre frontside.");
        $trick->setUser($this->getReference('amerkel'));
        $trick->setCategory($this->getReference("cat1"));
        $manager->persist($trick);
        $this->addReference("ja", $trick);

        $trick = new Trick();
        $trick
            ->setName("Le Seat Belt")
            ->setDescription("Grab avec saisie de la carre backside de la planche, entre les deux pieds, avec la main avant.")
            ->setImageLink("http://placehold.it/350X150")
            ->setChapo("Grab avec saisie de la carre backside de la planche, entre les deux pieds, avec la main avant.");
        $trick->setUser($this->getReference('emacron'));
        $trick->setCategory($this->getReference("cat1"));
        $manager->persist($trick);
        $this->addReference("sb", $trick);

        $trick = new Trick();
        $trick
            ->setName("Le Truck Driver")
            ->setDescription("Grab avec saisie du carre avant et carre arrière avec chaque main (comme tenir un volant de voiture).")
            ->setImageLink("http://placehold.it/350X150")
            ->setChapo("Grab avec saisie du carre avant et carre arrière avec chaque main (comme tenir un volant de voiture).");
        $trick->setUser($this->getReference('amerkel'));
        $trick->setCategory($this->getReference("cat1"));
        $manager->persist($trick);
        $this->addReference("td", $trick);

        $trick = new Trick();
        $trick
            ->setName("La rotation 180")
            ->setDescription("Une rotation » horizontale executée pendant le saut, avec atterrissage en position switch ou normal et d'une rotation de 180 degrés d'angle.")
            ->setImageLink("http://placehold.it/350X150")
            ->setChapo("Une rotation » horizontale executée pendant le saut, avec atterrissage en position switch ou normal et d'une rotation de 180 degrés d'angle.");
        $trick->setUser($this->getReference('amerkel'));
        $trick->setCategory($this->getReference("cat2"));
        $manager->persist($trick);
        $this->addReference("r180", $trick);

        $trick = new Trick();
        $trick
            ->setName("La rotation trois six")
            ->setDescription("Une rotation horizontale executée pendant le saut, avec atterrissage en position switch ou normal et d'une rotation de 360 degrés d'angle, soit un tour complet.")
            ->setImageLink("http://placehold.it/350X150")
            ->setChapo("Une rotation horizontale executée pendant le saut, avec atterrissage en position switch ou normal et d'une rotation de 360 degrés d'angle, soit un tour complet.");
        $trick->setUser($this->getReference('emacron'));
        $trick->setCategory($this->getReference("cat2"));
        $manager->persist($trick);
        $this->addReference("r36", $trick);

        $trick = new Trick();
        $trick
            ->setName("La rotation cinq quatre")
            ->setDescription("Une rotation horizontale executée pendant le saut, avec atterrissage en position switch ou normal et d'une rotation de 540 degrés d'angle, soit un tour et demi.")
            ->setImageLink("http://placehold.it/350X150")
            ->setChapo("Une rotation horizontale executée pendant le saut, avec atterrissage en position switch ou normal et d'une rotation de 540 degrés d'angle, soit un tour et demi.");
        $trick->setUser($this->getReference('bobama'));
        $trick->setCategory($this->getReference("cat2"));
        $manager->persist($trick);
        $this->addReference("r54", $trick);

        $trick = new Trick();
        $trick
            ->setName("La rotation sept deux")
            ->setDescription("Une rotation horizontale executée pendant le saut, avec atterrissage en position switch ou normal et d'une rotation de 720 degrés d'angle, soit deux tours complets.")
            ->setImageLink("http://placehold.it/350X150")
            ->setChapo("Une rotation horizontale executée pendant le saut, avec atterrissage en position switch ou normal et d'une rotation de 720 degrés d'angle, soit deux tours complets.");
        $trick->setUser($this->getReference('amerkel'));
        $trick->setCategory($this->getReference("cat2"));
        $manager->persist($trick);
        $this->addReference("r72", $trick);

        $trick = new Trick();
        $trick
            ->setName("La rotation 900")
            ->setDescription("Une rotation horizontale executée pendant le saut, avec atterrissage en position switch ou normal et d'une rotation de 900 degrés d'angle, soit deux tours et demi.")
            ->setImageLink("http://placehold.it/350X150")
            ->setChapo("Une rotation horizontale executée pendant le saut, avec atterrissage en position switch ou normal et d'une rotation de 900 degrés d'angle, soit deux tours et demi.");
        $trick->setUser($this->getReference('amerkel'));
        $trick->setCategory($this->getReference("cat2"));
        $manager->persist($trick);
        $this->addReference("r900", $trick);

        $trick = new Trick();
        $trick
            ->setName("La rotation Big Foot")
            ->setDescription("Une rotation horizontale executée pendant le saut, avec atterrissage en position switch ou normal et d'une rotation de 720 degrés d'angle, soit trois tours complets.")
            ->setImageLink("http://placehold.it/350X150")
            ->setChapo("Une rotation horizontale executée pendant le saut, avec atterrissage en position switch ou normal et d'une rotation de 720 degrés d'angle, soit trois tours complets.");
        $trick->setUser($this->getReference('bobama'));
        $trick->setCategory($this->getReference("cat2"));
        $manager->persist($trick);
        $this->addReference("rbf", $trick);

        $manager->flush();
    }
}
