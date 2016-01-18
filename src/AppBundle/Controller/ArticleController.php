<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ArticleController extends Controller
{
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

    /**
     * @Route("/category/{slug}/{page}", name="category")
     */
    public function categoryAction(Request $request, $slug, $page = 1)
    {
        $slides = $this->getDoctrine()->getRepository('AppBundle:Article')->getSlides();

        $articles = $this->getDoctrine()->getRepository('AppBundle:Article')->findByCategory($slug, $page);

        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'class' => 'homepage',
            'title' => 'Home page',
            'articles' => $articles,
            'slides' => $slides,
            'pages' => (int) count($articles)/9,
            'current' => 1
        ));
    }
}
