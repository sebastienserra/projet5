<?php

namespace Projet5\Controller;

use Projet5\Model\PostManager;

class FrontendController
{
    private $twig;

    public function __construct($twig)
    {
        /** @var \Twig\Environment $twig */
        $this->twig = $twig;
    }

    public function home()
    {
        $postManager = new PostManager();
        $articles = $postManager->lastPosts();
        $nbPosts = $postManager->paginate();
        echo $this->twig->render('frontend/home.html.twig', [
            'articles' => $articles,
            'nbPosts' => $nbPosts,
        ]);
    }

}