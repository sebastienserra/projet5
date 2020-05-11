<?php

namespace Projet5\Controller;

use Projet5\Model\PostManager;
use Projet5\Model\CommentManager;
use Projet5\Model\CatManager;

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
    function contact()
    {
    echo $this->twig->render('frontend/contact.html.twig', [
            
        ]);
    }
    function signup(){
    echo $this->twig->render('frontend/signup.html.twig', [
            
        ]);
    }
    function blog(){
        echo $this->twig->render('frontend/blog.html.twig', [
            
        ]);
    }
    function login(){
        echo $this->twig->render('frontend/login.html.twig', [
            
        ]);
    }
    function loginError(){
     echo $this->twig->render('frontend/login_error.html.twig', [
            
        ]);
    }
    function query(){
    $postManager = new PostManager();
    $results = $postManager->searchQuery();
        echo $this->twig->render('frontend/query_results.html.twig', [
            'results' => $results,
        ]);
    }
    function post(){
    $postManager = new PostManager();
    $commentManager = new CommentManager(); 
	$posts = $postManager->getPost($_GET['id']);
	$comments = $commentManager->getComments($_GET['id']);
    $byTitles = $postManager->newPosts();
    $popularity = $postManager->popularPosts();
    echo $this->twig->render('frontend/post_page.html.twig', [
            'posts' => $posts,
            'comments' => $comments,
            'byTitles' => $byTitles,
            'popularity' => $popularity,
        ]);
}
    function displayAllMaineCoons(){
    $catManager = new CatManager();
    $allCats = $catManager->getAllCats();
        echo $this->twig->render('frontend/all_maine_coons.html.twig', [
            'allCats' => $allCats,
        ]);
    }
    function displayCatsByCoat(){
    $catManager = new \Sebastien\Blog\Model\CatManager();
    $req = $catManager->loadCoat();
    require('./view/frontend/filtre.php');
}
function displayAllBoys(){
    $catManager = new \Sebastien\Blog\Model\CatManager();
    $req = $catManager->getAllBoys();
    require('./view/frontend/maine_coon_boys_view.php');
}
function displayAllGirls(){
    $catManager = new \Sebastien\Blog\Model\CatManager();
    $req = $catManager->getAllGirls();
    require('./view/frontend/maine_coon_girls_view.php');
}
function displayAllYoungsters(){
    $catManager = new \Sebastien\Blog\Model\CatManager();
    $req = $catManager->getAllYoungsters();
    require('./view/frontend/maine_coon_youngsters_view.php');
}
function displayAllKittens(){
    $catManager = new \Sebastien\Blog\Model\CatManager();
    $req = $catManager->getAllKittens();
    require('./view/frontend/maine_coon_kittens_view.php');
}

}