<?php

namespace Projet5\Controller;

use Projet5\Model\PostManager;
use Projet5\Model\CommentManager;
use Projet5\Model\CatManager;

class BackendController
{

    private $twig;
    private $postManager;
    private $commentManager;
    private $catManager;

    public function __construct($twig)
    {
        /** @var \Twig\Environment $twig */
        $this->twig = $twig;
        $this->postManager = new PostManager();
        $this->commentManager = new CommentManager();
        $this->catManager = new CatManager();
    }

    function listPostsAdmin()
    {
        $nbComments = $this->commentManager->countReportedComments();
        $posts = $this->postManager->getAllPostsAdmin();
        echo $this->twig->render('backend/backend.html.twig', [
            'posts' => $posts,
            'nbComments' => $nbComments
        ]);
    }

    function editPost($id)
    {
        $result = $this->postManager->editOnePost($id);
        echo $this->twig->render('backend/edit.html.twig', [
            'result' => $result,
        ]);
    }

    function listComments()
    {
        $commentsBack = $this->commentManager->getAllComments();
        echo $this->twig->render('backend/comments.html.twig', [
            'commentsBack' => $commentsBack,
        ]);
    }

    function admin_cats()
    {
        echo $this->twig->render('backend/admin_cats.html.twig', [

        ]);
    }

    function displayAllCatsBack()
    {
        $allCats = $this->catManager->getAllCats();
        echo $this->twig->render('backend/display_cats.html.twig', [
            'allCats' => $allCats,
        ]);
    }

    function editCat($id)
    {
        $result = $this->catManager->editOneCat($id);
        echo $this->twig->render('backend/edit_cat.html.twig', [
            'results' => $result,
        ]);
    }

    function eraseTheCat($id)
    {
        $result = $this->catManager->eraseCat($id);
        echo $this->twig->render('backend/admin_cats.html.twig', [

        ]);
    }

    function listReportedComments()
    {
        $reports = $this->commentManager->getReportedComments();
        echo $this->twig->render('backend/reported_comments.html.twig', [
            'reports' => $reports,
        ]);
    }

    function updatePost($category, $article, $title, $author, $id)
    {
        $request = $this->postManager->update($category, $article, $title, $author, $id);
        if ($request === false) {
            throw new Exception('Impossible de mettre le post a jour !');
        } else {

            header('Location: index.php?action=admin');
        }
    }

}