<?php

namespace AppBundle\Controller\Frontend;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CategoryController extends Controller
{
    /**
     * @Route("/category/{slug}/{page}", name="category")
     */
    public function indexAction(Request $request, $slug, $page = 1)
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
