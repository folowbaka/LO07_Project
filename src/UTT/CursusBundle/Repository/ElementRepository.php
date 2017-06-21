<?php

namespace UTT\CursusBundle\Repository;

/**
 * ElementRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ElementRepository extends \Doctrine\ORM\EntityRepository
{
    public function findSemesterCursus($id)
    {
        $query = $this->_em->createQuery('SELECT Distinct s.nom FROM UTTCursusBundle:Element e JOIN e.semLabel s WHERE e.cursus=:id ');
        $query->setParameter('id', $id);
        $results = $query->getResult();

        return $results;

    }
    public function SumElementCursus($id,$categ,$affect,$utt)
    {

        $qb = $this->createQueryBuilder('e');
        $qb->where('e.cursus = :id')
            ->setParameter('id', $id)
            ->andWhere('e.categorie=:categorie')
            ->setParameter('categorie', $categ)
            ->select('SUM(e.credit)');
            if($affect->getNom()!="BR")
            {
                $qb->andWhere('e.affectation=:affectation')
                    ->setParameter('affectation', $affect);
            }
            else
            {
                $qb->leftJoin('e.affectation', 'affect')
                    ->andWhere('affect.nom=:br OR affect.nom=:tcbr OR affect.nom=:fcbr')
                    ->setParameter('br', "BR")
                    ->setParameter('tcbr', "TCBR")
                    ->setParameter('fcbr', "FCBR");
            }
            if(!empty($utt))
            {
                $qb->andWhere('e.utt=:utt')
                    ->setParameter('utt',$utt);

            }


        return $qb->getQuery()->getSingleScalarResult();

    }
    public function existElementCursus($id,$categ,$affect)
    {

        $qb = $this->createQueryBuilder('e');
        $qb->where('e.cursus = :id')
            ->setParameter('id', $id)
            ->andWhere('e.categorie=:categorie')
            ->setParameter('categorie', $categ);
        if($affect->getNom()!="BR")
        {
            $qb->andWhere('e.affectation=:affectation')
                ->setParameter('affectation', $affect);
        }
        else
        {
            $qb->leftJoin('e.affectation', 'affect')
                ->andWhere('affect.nom=:br OR affect.nom=:tcbr OR affect.nom=:fcbr')
                ->setParameter('br', "BR")
                ->setParameter('tcbr', "TCBR")
                ->setParameter('fcbr', "FCBR");
        }
        return $qb->getQuery()->getResult();

    }
    public function SumCreditCursus($id)
    {
        $query = $this->_em->createQuery('SELECT SUM(e.credit) FROM UTTCursusBundle:Element e WHERE e.cursus=:id ');
        $query->setParameter('id', $id);
        $results = $query->getSingleScalarResult();

        return $results;

    }

}
