<?php
/**
 * Created by IntelliJ IDEA.
 * User: Folow
 * Date: 04/06/2017
 * Time: 18:22
 */

namespace UTT\CursusBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use UTT\CursusBundle\Entity\Resultat;

class LoadResultat implements FixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $names = array(
            'A',
            'B',
            'C',
            'D',
            'E',
            'F',
            'ABS',
            'RES',
            'ADM    '
        );

        foreach ($names as $name) {
            $resultat = new Resultat();
            $resultat->setNom($name);

            // On la persiste
            $manager->persist($resultat);
        }
        $manager->flush();
    }
}