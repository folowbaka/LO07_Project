<?php

namespace UTT\ReglementBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use UTT\CursusBundle\Entity\Agregat;
/**
 * Created by IntelliJ IDEA.
 * User: Folow
 * Date: 13/06/2017
 * Time: 19:57
 */
class LoadAgregat implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $names = array(
            'SUM',
            'EXIST'
        );

        foreach ($names as $name) {
            $agregat = new Agregat();
            $agregat->setNom($name);

            // On la persiste
            $manager->persist($agregat);
        }
        $manager->flush();
    }
}