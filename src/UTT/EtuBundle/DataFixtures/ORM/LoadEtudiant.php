<?php
/**
 * Created by IntelliJ IDEA.
 * User: Folow
 * Date: 07/06/2017
 * Time: 20:27
 */

namespace UTT\EtuBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use UTT\EtuBundle\Entity\Etudiant;


class LoadEtudiant extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $idetu = array(
            '1',
            '2',
            '3',
            '4',
            '5',
            '6',
            '7',
            '8',
            '9',
            '10'
        );
        $noms = array(
            'Galante',
            'Benkhemila',
            'Pernot',
            'Cerbonne',
            'Noga',
            'Genin',
            'De Smedt',
            'Lavast',
            'Mines',
            'Dieu'
        );
        $prenoms = array(
            'David',
            'Walid',
            'Antoine',
            'Hélia',
            'Lucas',
            'Adrian',
            'Tom',
            'Maxime',
            'Sébastien',
            'Arnaud'
        );

        for($i=0;$i<count($noms);$i++){
            $etudiant = new Etudiant();
            $etudiant->setIdEtudiant($idetu[$i]);
            $etudiant->setNom($noms[$i]);
            $etudiant->setPrenom($prenoms[$i]);
            if($i%2==0)
            {
                $etudiant->setAdmission($this->getReference('TC'));
                $etudiant->setFilliere($this->getReference('?'));
            }
            else
            {
                $etudiant->setAdmission($this->getReference('BR'));
                $etudiant->setFilliere($this->getReference('MPL'));
            }
            // On la persiste
            $manager->persist($etudiant);
        }
        $manager->flush();
    }

    public function getOrder()
    {
        return 3;
    }

}