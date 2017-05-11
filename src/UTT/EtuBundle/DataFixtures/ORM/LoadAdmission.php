<?php
namespace UTT\EtuBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use UTT\EtuBundle\Entity\Admission;

class LoadAdmission implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $names = array(
            'TC',
            'BR'
        );

        foreach ($names as $name) {
            $admission = new Admission();
            $admission->setNom($name);

            // On la persiste
            $manager->persist($admission);
        }
        $manager->flush();
    }

}