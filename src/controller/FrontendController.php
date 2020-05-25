<?php

namespace Projet5\Controller;

use Projet5\Model\PostManager;
use Projet5\Model\CommentManager;
use Projet5\Model\CatManager;
use Projet5\Model\UserManager;
use Projet5\Service\AuthenticationService;

class FrontendController
{
    private $twig;
    private $postManager;
    private $commentManager;
    private $catManager;
    private $userManager;
    private $authenticationService;

    public function __construct($twig)
    {
        /** @var \Twig\Environment $twig */

        $this->twig = $twig;
        $this->postManager = new PostManager();
        $this->commentManager = new CommentManager();
        $this->catManager = new CatManager();
        $this->userManager = new UserManager();
        $this->authenticationService = new AuthenticationService();
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
            'error' => $_GET['success'] == 'false'
        ]);
    }

    function blog()
    {
        echo $this->twig->render('frontend/blog.html.twig', []);
    }

    function login()
    {
        echo $this->twig->render('frontend/login.html.twig', [
            //'error' => $_GET['success'] == 'false'
        ]);
    }

    function loginError()
    {
        echo $this->twig->render('frontend/login_error.html.twig', []);
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

    public function register($email, $password)
    {
        $result = $this->authenticationService->signup($email, $password);
        if($result){
            $_SESSION['admin'] = true;
            header('Location: index.php?action=admin');
        } else {
            $_SESSION['admin'] = false;
            header('Location: index.php?action=signup&success=false');
        }
    }

    public function connect($email, $password)
    {
        $result = $this->authenticationService->signin($email, $password);
        if($result){
            $_SESSION['admin'] = true;
            header('Location: index.php?action=admin');
        } else {
            $_SESSION['admin'] = false;
            header('Location: index.php?action=login&success=false');
        }
    }

}