<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $most_viewed = $this->getDoctrine()->getRepository('AppBundle:Article')->findBy([], ['like' => 'DESC'], 5);

        $articles = $this->getDoctrine()->getRepository('AppBundle:Article')->getPage();
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'class' => 'homepage',
            'title' => 'Home page',
            'articles' => $articles,
            'slides' => $most_viewed,
            'pages' => (int) count($articles)/9,
            'current' => 1
        ));
    }

    /**
     * @Route("/page/{number}", name="pagination")
     * @Template()
     */
    public function pageAction(Request $request, $number)
    {
        $most_viewed = $this->getDoctrine()->getRepository('AppBundle:Article')->findBy([], ['like' => 'DESC'], 5);

        $articles = $this->getDoctrine()->getRepository('AppBundle:Article')->getPage($number);
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'class' => 'homepage',
            'title' => 'Home page',
            'articles' => $articles,
            'slides' => $most_viewed,
            'pages' => (int) count($articles)/9,
            'current' => $number
        ));
    }
}
