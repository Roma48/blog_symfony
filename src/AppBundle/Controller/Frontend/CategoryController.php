<?php

namespace AppBundle\Controller\Frontend;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CategoryController extends Controller
{

    /**
     * @Route("/categories/{page}", name="categories")
     */
    public function indexAction(Request $request, $page = 1)
    {
        $categories = $this->getDoctrine()->getRepository('AppBundle:Category')->getPage($page);

        return $this->render('category/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'class' => 'homepage',
            'title' => 'Categories',
            'categories' => $categories,
            'pages' => (int) count($categories)/9,
            'current' => 1
        ));
    }


    /**
     * @Route("/category/{slug}/{page}", name="category")
     */
    public function categoryPageAction(Request $request, $slug, $page = 1)
    {
        $articles = $this->getDoctrine()->getRepository('AppBundle:Article')->findByCategory($slug, $page);

        $category = $this->getDoctrine()->getRepository('AppBundle:Category')->findOneBy(["slug" => $slug]);

        return $this->render('category/category.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'class' => 'homepage',
            'title' => $category->getName(),
            'articles' => $articles,
            'pages' => (int) count($articles)/9,
            'current' => 1
        ));
    }
}
