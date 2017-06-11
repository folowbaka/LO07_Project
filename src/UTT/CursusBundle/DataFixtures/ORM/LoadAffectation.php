<?php

namespace UTT\CursusBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use UTT\CursusBundle\Entity\Affectation;

/**
 * Created by IntelliJ IDEA.
 * User: Folow
 * Date: 15/05/2017
 * Time: 20:41
 */
class LoadAffectation implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $names = array(
            'TC',
            'TCBR',
            'FCBR',
            'BR',
            'UTT'
        );

        foreach ($names as $name) {
            $affectation = new Affectation();
            $affectation->setNom($name);

            // On la persiste
            $manager->persist($affectation);
        }
        $manager->flush();
    }
}