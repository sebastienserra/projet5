<?php

namespace Projet5\Controller;

use Projet5\Model\PostManager;
use Projet5\Model\CommentManager;
use Projet5\Model\CatManager;
use Projet5\Model\UserManager;
use Projet5\Service\AuthenticationService;
use Projet5\Service\CatService;

class BackendController
{

    private $twig;
    private $postManager;
    private $commentManager;
    private $catManager;
    private $authenticationService;
    private $catService;

    public function __construct($twig)
    {
        /** @var \Twig\Environment $twig */
        $this->twig = $twig;
        $this->postManager = new PostManager();
        $this->commentManager = new CommentManager();
        $this->catManager = new CatManager();
        $this->authenticationService = new AuthenticationService();
        $this->catService = new CatService();
    }

    function addPost($article, $title, $author, $category)
    {
        if(!$this->authenticationService->isConnected()){
            header('Location: index.php?action=login');
        }
        $affectedLinesPost = $this->postManager->saveRecords($article, $title, $author, $category);

        if ($affectedLinesPost === false) {
            //header("location:".  $_SERVER['HTTP_REFERER']);
            echo 'error';
            //var_dump($affectedLinesPost);
        } else {
            echo 'success';
            //header('Location: index.php?action=admin&success=true');
        }
    }

    function editPost($id)
    {
        if(!$this->authenticationService->isConnected()){
            header('Location: index.php?action=login');
        }
        $result = $this->postManager->editOnePost($id);
        echo $this->twig->render('backend/edit.html.twig', [
            'result' => $result,
        ]);
    }

    function updatePost($category, $article, $title, $author, $id)
    {
        if(!$this->authenticationService->isConnected()){
            header('Location: index.php?action=login');
        }
        $request = $this->postManager->update($category, $article, $title, $author, $id);
        if ($request === false) {
            //throw new Exception('Impossible de supprimer le commentaire !');
            echo 'error';
        } else {
            //header('Location: index.php?action=moderate');
            echo 'success';
        }
    }

    function updateCat($catData, $image)
    {
        if (!$this->authenticationService->isConnected()) {
            header('Location: index.php?action=login');
        }

        $this->catService->editCat($catData, $image);
        header('Location: index.php?action=edit_cat&id=' . $catData['id']);
    }

    function deletePost($id)
    {
        if(!$this->authenticationService->isConnected()){
            header('Location: index.php?action=login');
        }
        $erase = $this->postManager->destroy($id);
        if ($erase === false) {
            //header("location:".  $_SERVER['HTTP_REFERER']);
            echo 'error';
            //var_dump($affectedLinesPost);
        } else {
            echo 'success';
            //header('Location: index.php?action=admin&success=true');
        }
    }

    function listReportedComments()
    {
        if(!$this->authenticationService->isConnected()){
            header('Location: index.php?action=login');
        }
        $reports = $this->commentManager->getReportedComments();
        echo $this->twig->render('backend/reported_comments.html.twig', [
            'reports' => $reports,
        ]);
    }

    function destroyReportedComment($id)
    {
        if (!$this->authenticationService->isConnected()) {
            header('Location: index.php?action=login');
        }
        $eraseReported = $this->commentManager->eraseReportedComment($id);
        if ($eraseReported === false) {
            //throw new Exception('Impossible de supprimer le commentaire !');
            echo 'error';
        } else {
            //header('Location: index.php?action=moderate');
            echo 'success';
        }
    }

    function listPostsAdmin()
    {
        if (!$this->authenticationService->isConnected()) {
            header('Location: index.php?action=login');
        }
        $nbComments = $this->commentManager->countReportedComments();
        $posts = $this->postManager->getAllPostsAdmin();
        echo $this->twig->render('backend/backend.html.twig', [
            'posts' => $posts,
            'nbComments' => $nbComments
        ]);
    }

    function listComments()
    {
        if (!$this->authenticationService->isConnected()) {
            header('Location: index.php?action=login');
        }
        $commentsBack = $this->commentManager->getAllComments();
        echo $this->twig->render('backend/comments.html.twig', [
            'commentsBack' => $commentsBack,
        ]);
    }

    function addCat($catData, $image)
    {
        if (!$this->authenticationService->isConnected()) {
            header('Location: index.php?action=login');
        }

        $this->catService->addCat($catData, $image);
        header('Location: index.php?action=admin_cats');
    }

    function editCat($id)
    {
        if (!$this->authenticationService->isConnected()) {
            header('Location: index.php?action=login');
        }
        $result = $this->catManager->editOneCat($id);
        echo $this->twig->render('backend/edit_cat.html.twig', [
            'results' => $result,
        ]);
    }

    function eraseTheCat($id)
    {
        if (!$this->authenticationService->isConnected()) {
            header('Location: index.php?action=login');
        }
        $result = $this->catManager->eraseCat($id);
        echo $this->twig->render('backend/admin_cats.html.twig', [

        ]);
    }

    function admin_cats()
    {
        if (!$this->authenticationService->isConnected()) {
            header('Location: index.php?action=login');
        }
        echo $this->twig->render('backend/admin_cats.html.twig', [

        ]);
    }

    function displayAllCatsBack()
    {
        if (!$this->authenticationService->isConnected()) {
            header('Location: index.php?action=login');
        }
        $allCats = $this->catManager->getAllCats();
        echo $this->twig->render('backend/display_cats.html.twig', [
            'allCats' => $allCats,
        ]);
    }

}