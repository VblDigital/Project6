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
            ->setMainImageLink("c21f969b5f03d33d43e04f8f136e7682.png")
            ->setChapo("Grab avec saisie de la carre frontside de la planche entre les deux pieds avec la main avant.")
            ->setAuthor($this->getReference('bobama'))
            ->setContributor($this->getReference('bobama'))
            ->setCategory($this->getReference('cat1'))
            ->setSlug('le-mute');
        $manager->persist($trick);
        $this->addReference("mute", $trick);

        $trick = new Trick();
        $trick
            ->setName("Le Style Week")
            ->setDescription("Grab avec saisie de la carre backside de la planche, entre les deux pieds, avec la main avant.")
            ->setMainImageLink("c21f969b5f03d33d43e04f8f136e7682.png")
            ->setChapo("Grab avec saisie de la carre backside de la planche, entre les deux pieds, avec la main avant.")
            ->setAuthor($this->getReference('emacron'))
            ->setContributor($this->getReference('emacron'))
            ->setCategory($this->getReference("cat1"))
            ->setSlug('le-style-week');
        $manager->persist($trick);
        $this->addReference("sw", $trick);

        $trick = new Trick();
        $trick
            ->setName("L'Indy ")
            ->setDescription("Grab avec saisie de la carre frontside de la planche, entre les deux pieds, avec la main arrière.")
            ->setMainImageLink("c21f969b5f03d33d43e04f8f136e7682.png")
            ->setChapo("Grab avec saisie de la carre frontside de la planche, entre les deux pieds, avec la main arrière.")
            ->setAuthor($this->getReference('bobama'))
            ->setContributor($this->getReference('bobama'))
            ->setCategory($this->getReference("cat1"))
            ->setSlug('l-indy');
        $manager->persist($trick);
        $this->addReference("indy", $trick);

        $trick = new Trick();
        $trick
            ->setName("Le Stalefish ")
            ->setDescription("Grab avec saisie de la carre backside de la planche entre les deux pieds avec la main arrière.")
            ->setMainImageLink("c21f969b5f03d33d43e04f8f136e7682.png")
            ->setChapo("Grab avec saisie de la carre backside de la planche entre les deux pieds avec la main arrière.")
            ->setCategory($this->getReference("cat1"))
            ->setAuthor($this->getReference('amerkel'))
            ->setContributor($this->getReference('amerkel'))
            ->setSlug('le-stalefish');
        $manager->persist($trick);
        $this->addReference("stalefish", $trick);

        $trick = new Trick();
        $trick
            ->setName("Le Tail Grab")
            ->setDescription("Grab avec saisie de la partie arrière de la planche, avec la main arrière.")
            ->setMainImageLink("c21f969b5f03d33d43e04f8f136e7682.png")
            ->setChapo("Grab avec saisie de la partie arrière de la planche, avec la main arrière.")
            ->setCategory($this->getReference("cat1"))
            ->setAuthor($this->getReference('amerkel'))
            ->setContributor($this->getReference('amerkel'))
            ->setSlug('le-tail-grab');
        $manager->persist($trick);
        $this->addReference("tg", $trick);

        $trick = new Trick();
        $trick
            ->setName("Le Nose Grab")
            ->setDescription("Grab avec saisie de la partie avant de la planche, avec la main avant.")
            ->setMainImageLink("c21f969b5f03d33d43e04f8f136e7682.png")
            ->setChapo("Grab avec saisie de la partie avant de la planche, avec la main avant.")
            ->setCategory($this->getReference("cat1"))
            ->setAuthor($this->getReference('bobama'))
            ->setContributor($this->getReference('bobama'))
            ->setSlug('le-nose-grab');
        $manager->persist($trick);
        $this->addReference("ng", $trick);

        $trick = new Trick();
        $trick
            ->setName("Le Japan Air")
            ->setDescription("Grab avec saisie de l'avant de la planche, avec la main avant, du côté de la carre frontside.")
            ->setMainImageLink("c21f969b5f03d33d43e04f8f136e7682.png")
            ->setChapo("Grab avec saisie de l'avant de la planche, avec la main avant, du côté de la carre frontside.")
            ->setCategory($this->getReference("cat1"))
            ->setAuthor($this->getReference('amerkel'))
            ->setContributor($this->getReference('amerkel'))
            ->setSlug('le-japan-air');
        $manager->persist($trick);
        $this->addReference("ja", $trick);

        $trick = new Trick();
        $trick
            ->setName("Le Seat Belt")
            ->setDescription("Grab avec saisie de la carre backside de la planche, entre les deux pieds, avec la main avant.")
            ->setMainImageLink("c21f969b5f03d33d43e04f8f136e7682.png")
            ->setChapo("Grab avec saisie de la carre backside de la planche, entre les deux pieds, avec la main avant.")
            ->setCategory($this->getReference("cat1"))
            ->setAuthor($this->getReference('emacron'))
            ->setContributor($this->getReference('emacron'))
            ->setSlug('le-seat-belt');
        $manager->persist($trick);
        $this->addReference("sb", $trick);

        $trick = new Trick();
        $trick
            ->setName("Le Truck Driver")
            ->setDescription("Grab avec saisie du carre avant et carre arrière avec chaque main (comme tenir un volant de voiture).")
            ->setMainImageLink("c21f969b5f03d33d43e04f8f136e7682.png")
            ->setChapo("Grab avec saisie du carre avant et carre arrière avec chaque main (comme tenir un volant de voiture).")
            ->setCategory($this->getReference("cat1"))
            ->setAuthor($this->getReference('amerkel'))
            ->setSlug('le-truck-driver');
        $manager->persist($trick);
        $this->addReference("td", $trick);

        $trick = new Trick();
        $trick
            ->setName("La rotation 180")
            ->setDescription("Une rotation » horizontale executée pendant le saut, avec atterrissage en position switch ou normal et d'une rotation de 180 degrés d'angle.")
            ->setMainImageLink("c21f969b5f03d33d43e04f8f136e7682.png")
            ->setChapo("Une rotation » horizontale executée pendant le saut, avec atterrissage en position switch ou normal et d'une rotation de 180 degrés d'angle.")
            ->setCategory($this->getReference("cat2"))
            ->setAuthor($this->getReference('amerkel'))
            ->setCategory($this->getReference('amerkel'))
            ->setSlug('la-rotation-180');
        $manager->persist($trick);
        $this->addReference("r180", $trick);

        $trick = new Trick();
        $trick
            ->setName("La rotation trois six")
            ->setDescription("Une rotation horizontale executée pendant le saut, avec atterrissage en position switch ou normal et d'une rotation de 360 degrés d'angle, soit un tour complet.")
            ->setMainImageLink("http://c21f969b5f03d33d43e04f8f136e7682.png")
            ->setChapo("Une rotation horizontale executée pendant le saut, avec atterrissage en position switch ou normal et d'une rotation de 360 degrés d'angle, soit un tour complet.")
        ->setCategory($this->getReference("cat2"))
            ->setAuthor($this->getReference('emacron'))
            ->setContributor($this->getReference('emacron'))
            ->setSlug('la-rotation-troix-six');
        $manager->persist($trick);
        $this->addReference("r36", $trick);

        $trick = new Trick();
        $trick
            ->setName("La rotation cinq quatre")
            ->setDescription("Une rotation horizontale executée pendant le saut, avec atterrissage en position switch ou normal et d'une rotation de 540 degrés d'angle, soit un tour et demi.")
            ->setMainImageLink("c21f969b5f03d33d43e04f8f136e7682.png")
            ->setChapo("Une rotation horizontale executée pendant le saut, avec atterrissage en position switch ou normal et d'une rotation de 540 degrés d'angle, soit un tour et demi.")
            ->setCategory($this->getReference("cat2"))
            ->setAuthor($this->getReference('bobama'))
            ->setContributor($this->getReference('bobama'))
            ->setSlug('la-rotation-cinq-quatre');
        $manager->persist($trick);
        $this->addReference("r54", $trick);

        $trick = new Trick();
        $trick
            ->setName("La rotation sept deux")
            ->setDescription("Une rotation horizontale executée pendant le saut, avec atterrissage en position switch ou normal et d'une rotation de 720 degrés d'angle, soit deux tours complets.")
            ->setMainImageLink("c21f969b5f03d33d43e04f8f136e7682.png")
            ->setChapo("Une rotation horizontale executée pendant le saut, avec atterrissage en position switch ou normal et d'une rotation de 720 degrés d'angle, soit deux tours complets.")
            ->setCategory($this->getReference("cat2"))
            ->setAuthor($this->getReference('amerkel'))
            ->setContributor($this->getReference('amerkel'))
            ->setSlug('la-rotation-sept-deux');
        $manager->persist($trick);
        $this->addReference("r72", $trick);

        $trick = new Trick();
        $trick
            ->setName("La rotation 900")
            ->setDescription("Une rotation horizontale executée pendant le saut, avec atterrissage en position switch ou normal et d'une rotation de 900 degrés d'angle, soit deux tours et demi.")
            ->setMainImageLink("c21f969b5f03d33d43e04f8f136e7682.png")
            ->setChapo("Une rotation horizontale executée pendant le saut, avec atterrissage en position switch ou normal et d'une rotation de 900 degrés d'angle, soit deux tours et demi.")
            ->setCategory($this->getReference("cat2"))
            ->setAuthor($this->getReference('amerkel'))
            ->setContributor($this->getReference('amerkel'))
            ->setSlug('la-rotation-900');
        $manager->persist($trick);
        $this->addReference("r900", $trick);

        $trick = new Trick();
        $trick
            ->setName("La rotation Big Foot")
            ->setDescription("Une rotation horizontale executée pendant le saut, avec atterrissage en position switch ou normal et d'une rotation de 720 degrés d'angle, soit trois tours complets.")
            ->setMainImageLink("c21f969b5f03d33d43e04f8f136e7682.png")
            ->setChapo("Une rotation horizontale executée pendant le saut, avec atterrissage en position switch ou normal et d'une rotation de 720 degrés d'angle, soit trois tours complets.")
            ->setCategory($this->getReference("cat2"))
            ->setAuthor($this->getReference('bobama'))
            ->setContributor($this->getReference('bobama'))
            ->setSlug('la-rotation-big-foot');
        $manager->persist($trick);
        $this->addReference("rbf", $trick);

        $manager->flush();
    }
}
