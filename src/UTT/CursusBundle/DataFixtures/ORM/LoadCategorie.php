<?php

namespace UTT\CursusBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use UTT\CursusBundle\Entity\Categorie;

/**
 * Created by IntelliJ IDEA.
 * User: Folow
 * Date: 15/05/2017
 * Time: 20:41
 */
class LoadCategorie implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $names = array(
            'CS',
            'TM',
            'EC',
            'HT',
            'ME',
            'ST',
            'SE',
            'HP',
            'NPML',
            'CT',
        );

        foreach ($names as $name) {
            $categorie = new Categorie();
            $categorie->setNom($name);

            // On la persiste
            $manager->persist($categorie);
        }
        $manager->flush();
    }
}