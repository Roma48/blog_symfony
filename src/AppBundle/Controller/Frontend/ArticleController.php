<?php

namespace AppBundle\Controller\Frontend;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ArticleController extends Controller
{
    /**
     * @Route("/blog/page/{number}", name="blog")
     */
    public function blogAction(Request $request, $number)
    {
        $articles = $this->getDoctrine()->getRepository('AppBundle:Article')->getPage($number);

        return $this->render('article/blog.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'class' => 'homepage',
            'title' => 'Blog',
            'articles' => $articles,
            'pages' => (int) count($articles)/9,
            'current' => $number
        ));
    }

    /**
     * @Route("/article/{slug}", name="article")
     */
    public function indexAction(Request $request, $slug)
    {
        $article = $this->getDoctrine()->getRepository('AppBundle:Article')->findBy(array('slug' => $slug));
        $most_viewed = $this->getDoctrine()->getRepository('AppBundle:Article')->getPage();
        // replace this example code with whatever you need
        return $this->render('article/index.html.twig', array(
                'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
                'class' => $request->attributes->get('_route'),
                'title' => 'Article',
                'article' => $article[0],
                'popular' => $most_viewed
            )
        );
    }
}
