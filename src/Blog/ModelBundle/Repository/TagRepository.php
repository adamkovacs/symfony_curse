<?php

namespace Blog\ModelBundle\Repository;
use Blog\ModelBundle\Entity\Post;
use Blog\ModelBundle\Entity\Tag;
use Doctrine\ORM\Query\ResultSetMapping;

/**
 * TagRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TagRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * Find the first tag
     *
     * @return Tag
     */
    public function findFirst()
    {
        $qb = $this->getQueryBuilder()
            ->orderBy('t.id', 'asc')
            ->setMaxResults(1);

        return $qb->getQuery()->getSingleResult();
    }

    /**
     * Find usage tags
     *
     * @return Tag
     */
    public function findUsageTags()
    {
        $qb = $this->getQueryBuilder();
        $qb ->select('t')
            ->innerJoin('t.posts', 'p')
            ->groupBy('t.id');

        return $qb->getQuery()->getResult();
    }

    private function getQueryBuilder()
    {
        $em = $this->getEntityManager();

        $qb = $em->getRepository('ModelBundle:Tag')
            ->createQueryBuilder('t');

        return $qb;
    }
}
