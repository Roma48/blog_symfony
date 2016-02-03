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
            ->leftJoin('t.categories', 'category')
            ->leftJoin('t.users', 'user')
            ->leftJoin('t.likes', 'likes')
            ->leftJoin('t.comments', 'comments')
            ->groupBy('t.id')
            ->setMaxResults($limit)
            ->setFirstResult($page * $limit - $limit)
        ;

        return $query;
    }
    /**
     * @return array
     */
    public function getSlides()
    {
        $query = $this->createQueryBuilder('a')
            ->select('a, image, category, user, comments')
            ->leftJoin('a.image', 'image')
            ->leftJoin('a.categories', 'category')
            ->leftJoin('a.users', 'user')
            ->leftJoin('a.comments', 'comments')
            ->join('a.likes', 'likes')
            ->groupBy('a.id')
            ->setMaxResults(3)
//            ->orderBy('cnt', 'DESC')
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
            ->leftJoin('t.categories', 'category')
            ->leftJoin('t.users', 'user')
            ->leftJoin('t.likes', 'likes')
            ->leftJoin('t.comments', 'comments')
            ->where('category.slug = ?1')
            ->setParameter(1, $slug)
            ->groupBy('t.id')
            ->setMaxResults($limit)
            ->setFirstResult($page * $limit - $limit)
        ;

        return $query;
    }
}