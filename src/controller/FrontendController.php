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
    private $postPerPage = 5;

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
        $nber_of_pages = $this->postManager->paginate();
        //var_dump($nbPosts);
        echo $this->twig->render('frontend/home.html.twig', [
            'articles' => $articles,
            'nber_of_pages' => $nber_of_pages,
        ]);
    }

    function contact()
    {
        echo $this->twig->render('frontend/contact.html.twig', [

        ]);
    }

    function message($object_message, $first_name, $last_name, $email, $message_text)
    {
        $message = $this->userManager->message($object_message, $first_name, $last_name, $email, $message_text);
        echo $this->twig->render('frontend/contact.html.twig', [
            'message' => $message,

        ]);
    }


    public function blog()
    {
        $getLastArticles = $this->postManager->getLastArticle();
        $byTitles = $this->postManager->newPosts();
        $popularity = $this->postManager->popularPosts();
        $subOnes = $this->postManager->subArticleOne();
        $subTwos = $this->postManager->subArticleTwo();
        $subThrees = $this->postManager->subArticleThree();
        $subFours = $this->postManager->subArticleFour();

        echo $this->twig->render('frontend/blog.html.twig', [
            'getLastArticles' => $getLastArticles,
            'byTitles' => $byTitles,
            'popularity' => $popularity,
            'subOnes' => $subOnes,
            'subTwos' => $subTwos,
            'subThrees' => $subThrees,
            'subFours' => $subFours,
        ]);
    }

    public function editOnePost($id)
    {
        $db = $this->dbConnect();
        $result = $db->prepare("SELECT article, title, author, id FROM posts WHERE id=?");
        $result->execute(array($id));
        return $result;
    }

    function postsByCategory($actionCategory)
    {
        $mapCategory = [
            'health' => ['category' => 'Soins', 'template' => 'maine_coon_health.html.twig'],
            'daily' => ['category' => 'Quotidien', 'template' => 'daily.html.twig'],
            'education' => ['category' => 'Education', 'template' => 'maine_coon_education.html.twig'],
            'my_first_maine_coon' => ['category' => 'Mon premier Maine Coon', 'template' => 'my_first_maine_coon.html.twig'],
        ];
        $categoryName = $mapCategory[$actionCategory]['category'];
        $template = $mapCategory[$actionCategory]['template'];

        $page = $_GET['page'] ?? 1;
        $offset = (intval($page) - 1) * $this->postPerPage;
        $categories = $this->postManager->getPostsByCategory($categoryName, $this->postPerPage, $offset);
        $categoriesCount = $this->postManager->countPostsByCategory($categoryName);
        $nbPages = ceil(intval($categoriesCount['nb']) / $this->postPerPage);
        echo $this->twig->render("frontend/{$template}",
            [
                'total' => $nbPages,
                'categories' => $categories,
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
            header('Location:' . $_SERVER['HTTP_REFERER'] . '&success=false');
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

    public function login()
    {
        if ($_GET['action'] === 'login') {
            echo $this->twig->render('frontend/login.html.twig', [
                'error' => $_GET['success'] == 'false'
            ]);
        }
    }

    public function signup()
    {
        if ($_GET['action'] === 'signup') {
            echo $this->twig->render('frontend/signup.html.twig', [

            ]);
        }
        echo $this->twig->render('frontend/signup.html.twig', [
            'error' => $_GET['success'] == 'false'
        ]);
    }

    public function register($email, $password)
    {
        $result = $this->authenticationService->signup($email, $password);
        if ($result) {
            $_SESSION['admin'] = true;
            header('Location: index.php?action=admin');
        } else {
            $_SESSION['admin'] === false;
            header('Location: index.php?action=signup&success=false');
        }
    }

    public function connect($email, $password)
    {
        $result = $this->authenticationService->signinAdmin($email, $password);
        if ($result) {

            $_SESSION['admin'] = true;
            $_SESSION['email'] = $result['email'];

            header('Location: index.php?action=admin&success=true');
        } else {
            header('Location: index.php?action=login');
        }


    }


}
