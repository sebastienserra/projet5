<?php

namespace Projet5\Controller;

use Projet5\Model\PostManager;
use Projet5\Model\CommentManager;
use Projet5\Model\CatManager;
use Projet5\Model\UserManager;
use Projet5\service\AuthenticationService;

class FrontendController
{
    private $twig;
    private $postManager;
    private $commentManager;
    private $catManager;
    private $userManager;
   // private $authentificationService;

    public function __construct($twig)
    {
        /** @var \Twig\Environment $twig */

        $this->twig = $twig;
        $this->postManager = new PostManager();
        $this->commentManager = new CommentManager();
        $this->catManager = new CatManager();
        $this->userManager = new UserManager();
       // $this->authentificationService = new AuthentificationService();
    }

    public function home()
    {
        
        $articles = $this->postManager->lastPosts();
        $nbPosts = $this->postManager->paginate();
        echo $this->twig->render('frontend/home.html.twig', [
            'articles' => $articles,
            'nbPosts' => $nbPosts,
        ]);
    }

    function contact()
    {
        echo $this->twig->render('frontend/contact.html.twig', [

        ]);
    }

    function signup()
    {
        echo $this->twig->render('frontend/signup.html.twig', [

        ]);
    }

    function blog()
    {
        echo $this->twig->render('frontend/blog.html.twig', [

        ]);
    }

    function login()
    {
        echo $this->twig->render('frontend/login.html.twig', [

        ]);
    }

    function loginError()
    {
        echo $this->twig->render('frontend/login_error.html.twig', [

        ]);
    }
    function query()
    {
        $results = $this->postManager->searchQuery();
        echo $this->twig->render('frontend/query_results.html.twig', [
            'results' => $results,
        ]);
    }
    function post()
    {
        $commentManager = new CommentManager();
        $post = $this->postManager->getPost($_GET['id']);
        $comments = $this->commentManager->getComments($_GET['id']);
        $byTitles = $this->postManager->newPosts();
        $popularity = $this->postManager->popularPosts();
        echo $this->twig->render('frontend/post_page.html.twig', [
            'post' => $post,
            'comments' => $comments,
            'byTitles' => $byTitles,
            'popularity' => $popularity,
        ]);
    }

    function displayAllMaineCoons()
    {
        $allCats = $this->catManager->getAllCats();
        echo $this->twig->render('frontend/all_maine_coons.html.twig', [
            'allCats' => $allCats,
        ]);
    }

    function displayCatsByCoat()
    {
        $coats = $this->catManager->loadCoat();
        echo $this->twig->render('frontend/filtre.html.twig', [
            'coats' => $coats,
        ]);
    }

    function displayAllBoys()
    {
        $boys = $this->catManager->getAllBoys();
        echo $this->twig->render('frontend/maine_coon_boys.html.twig', [
            'boys' => $boys,
        ]);
    }

    function displayAllGirls()
    {
        $girls = $this->catManager->getAllGirls();
        echo $this->twig->render('frontend/maine_coon_girls.html.twig', [
            'girls' => $girls,
        ]);
    }

    function displayAllYoungsters()
    {
        $youngsters = $this->catManager->getAllYoungsters();
        echo $this->twig->render('frontend/maine_coon_youngsters.html.twig', [
            'youngsters' => $youngsters,
        ]);
    }

    function displayAllKittens()
    {
        $catManager = new CatManager();
        $kittens = $catManager->getAllKittens();
        echo $this->twig->render('frontend/maine_coon_kittens.html.twig', [
            'kittens' => $kittens,
        ]);
    }

    function addComment($comment, $postId)
    {
        $affectedLines = $this->commentManager->postComment($comment, $postId);
        if ($affectedLines === false) {
            header('Location: index.php?action=postandcomments&id=' . $postId . '&success=false');
        } else {
            header('Location: index.php?action=postandcomments&id=' . $postId);
        }
    }

    public function reportComment($id)
    {
        $affectedLines = $this->commentManager->reportComment($id);
        if ($affectedLines === false) {
            header('Location:' . $_SERVER['HTTP_REFERER']. '&success=false');
        } else {
            header('Location:' . $_SERVER['HTTP_REFERER']);
        }
    }

    public function getCatByCoat($coat)
    {
        header('Content-Type: application/json');
        $cats = $this->catManager->getCatByCoat($coat);
        echo json_encode($cats);
    }

}