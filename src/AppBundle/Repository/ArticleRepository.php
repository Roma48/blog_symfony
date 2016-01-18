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
        $query = $this->createQueryBuilder('t')
            ->select('t, image, category, user, comments, likes')
            ->leftJoin('t.image', 'image')
            ->leftJoin('t.category', 'category')
            ->leftJoin('t.user', 'user')
            ->leftJoin('t.likes', 'likes')
            ->leftJoin('t.comments', 'comments')
            ->groupBy('t.id')
            ->setMaxResults($limit)
            ->setFirstResult($page * $limit - $limit)
        ;
        $paginator = new Paginator($query, $fetchJoinCollection = false);
        $paginator->setUseOutputWalkers(false);
        return $paginator;
    }
    /**
     * @return array
     */
    public function getSlides()
    {
        $query = $this->createQueryBuilder('a')
            ->select('a, image, comments, user, category, COUNT(likes) AS HIDDEN cnt')
            ->leftJoin('a.image', 'image')
            ->leftJoin('a.category', 'category')
            ->leftJoin('a.user', 'user')
            ->leftJoin('a.comments', 'comments')
            ->join('a.likes', 'likes')
            ->groupBy('a.id')
            ->setMaxResults(5)
            ->orderBy('cnt', 'DESC')
            ->getQuery()
            ->getResult();
        return $query;
    }
    /**
     * @param string $slug
     * @param int $page
     * @return Paginator
     */
    public function findByCategory($slug = '', $page = 1)
    {
        $limit = 9;
        $query = $this->createQueryBuilder('t')
            ->select('t, image, category, user, comments, likes')
            ->leftJoin('t.image', 'image')
            ->leftJoin('t.category', 'category')
            ->leftJoin('t.user', 'user')
            ->leftJoin('t.likes', 'likes')
            ->leftJoin('t.comments', 'comments')
            ->where('category.class = ?1')
            ->setParameter(1, $slug)
            ->groupBy('t.id')
            ->setMaxResults($limit)
            ->setFirstResult($page * $limit - $limit)
        ;
        $paginator = new Paginator($query, $fetchJoinCollection = true);
        $paginator->setUseOutputWalkers(false);
        return $paginator;
    }
}