<?php
/**
 * Created by IntelliJ IDEA.
 * User: Folow
 * Date: 11/05/2017
 * Time: 22:25
 */

namespace UTT\EtuBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use UTT\EtuBundle\Entity\Filliere;

class LoadFilliere extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $names = array(
            '?',
            'MPL',
            'MSI',
            'MRI',
            'LIB'
        );

        foreach ($names as $nom) {
            $filliere = new Filliere();
            $filliere->setNom($nom);

            // On la persiste
            $manager->persist($filliere);
            $this->addReference($filliere->getNom(), $filliere);
        }
        $manager->flush();
    }
    public function getOrder()
    {
        return 1;
    }
}