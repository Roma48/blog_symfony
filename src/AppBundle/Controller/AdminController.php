<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use AppBundle\Entity\Image;
use AppBundle\Form\ArticleType;
use AppBundle\Form\ImageType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
{
    /**
     * @Route("/admin", name="admin")
     */
    public function indexAction(Request $request)
    {
        $articles = $this->getDoctrine()->getRepository('AppBundle:Article')->getPage();

        return $this->render('admin/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'title' => 'All Articles',
            'articles' => $articles,
            'pages' => (int) count($articles)/9,
            'current' => 1
        ));
    }

    /**
     * @Route("/admin/articles/{page}", name="admin_articles")
     */
    public function articlesPageAction(Request $request, $page)
    {
        $articles = $this->getDoctrine()->getRepository('AppBundle:Article')->getPage($page);

        return $this->render('admin/all_articles.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'title' => 'All Articles',
            'articles' => $articles,
            'pages' => (int) count($articles)/9,
            'current' => $page
        ));
    }

    /**
     * @Route("/admin/article/new", name="new_article")
     */
    public function newArticleAction(Request $request)
    {
        $article = new Article();

        $form = $this->createForm(ArticleType::class, $article);

        $buttonName = 'Add Article';

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($article);
                $em->flush();
                return $this->redirectToRoute('admin_articles');
            }
        }

        return $this->render('admin/new_article.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'title' => 'New Article',
            'form' => $form->createView(),
            'button' => $buttonName
        ));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/admin/image/new", name="new_image")
     */
    public function newImageAction(Request $request)
    {
        $image = new Image();

        $form = $this->createForm(ImageType::class, $image);

        $buttonName = 'Add Image';

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($image);
                $em->flush();
                return $this->redirectToRoute('admin_images');
            }
        }

        return $this->render('admin/new_article.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'title' => 'New Image',
            'form' => $form->createView(),
            'button' => $buttonName
        ));
    }

    /**
     * @Route("/admin/images", name="admin_images")
     */
    public function imagesPageAction(Request $request)
    {
        $images = $this->getDoctrine()->getRepository('AppBundle:Image')->findAll();

        return $this->render('admin/all_images.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'title' => 'All Images',
            'images' => $images,
            'pages' => (int) count($images)/9,
//            'current' => $page
        ));
    }
}
