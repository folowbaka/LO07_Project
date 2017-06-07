<?php
namespace UTT\EtuBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use UTT\EtuBundle\Entity\Admission;

class LoadAdmission extends AbstractFixture implements OrderedFixtureInterface
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
            $this->addReference($admission->getNom(), $admission);
        }
        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}