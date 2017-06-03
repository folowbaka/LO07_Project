<?php
/**
 * Created by IntelliJ IDEA.
 * User: Folow
 * Date: 03/06/2017
 * Time: 20:04
 */

namespace UTT\CursusBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use UTT\CursusBundle\Entity\SemLabel;


class LoadSemLabel implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $names = array();
        for($i=1;$i<=6;$i++)
        {
            $names[]='TC'.$i;
        }
        for($i=1;$i<=8;$i++)
        {
            $names[]='ISI'.$i;
            $names[]='SRT'.$i;
            $names[]='MTE'.$i;

        }

        foreach ($names as $name) {
            $affectation = new SemLabel();
            $affectation->setNom($name);

            // On la persiste
            $manager->persist($affectation);
        }
        $manager->flush();
    }
}