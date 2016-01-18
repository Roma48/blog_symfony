<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * Class ArticleRepository
 * @package AppBundle\Repository
 */
class ArticleRepository extends EntityRepository
{

    /**
     * @param int $page
     * @return Paginator
     */
    public function getPage($page = 1)
    {
        $limit = 9;
        $query = $this->createQueryBuilder('article')
            ->select('article, image, category, user, comments, likes')
            ->leftJoin('article.image', 'image')
            ->leftJoin('article.category', 'category')
            ->leftJoin('article.user', 'user')
            ->leftJoin('article.likes', 'likes')
            ->leftJoin('article.comments', 'comments')
            ->groupBy('article.id')
            ->setMaxResults($limit)
            ->setFirstResult($page * $limit - $limit);

        $paginator = new Paginator($query, $fetchJoinCollection = false);
        $paginator->setUseOutputWalkers(false);

        return $paginator;
    }

    /**
     * @return array
     */
    public function getSlides()
    {
        $query = $this->createQueryBuilder('article')
            ->select('article, image, comments, user, category, COUNT(likes.id) AS HIDDEN cnt')
            ->leftJoin('article.image', 'image')
            ->leftJoin('article.category', 'category')
            ->leftJoin('article.user', 'user')
            ->leftJoin('article.comments', 'comments')
            ->join('article.likes', 'likes')
            ->orderBy('cnt', 'DESC')
            ->groupBy('article.id')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult();

        return $query;
    }
}