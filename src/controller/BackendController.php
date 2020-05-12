<?php

namespace Projet5\Controller;

use Projet5\Model\PostManager;
use Projet5\Model\CommentManager;
use Projet5\Model\CatManager;

class BackendController
{

    private $twig;

    public function __construct($twig)
    {
        /** @var \Twig\Environment $twig */
        $this->twig = $twig;
    }
    function listPostsAdmin(){
    $postManager = new PostManager();
    $posts = $postManager->getAllPostsAdmin();
    echo $this->twig->render('backend/backend.html.twig', [
            'posts' => $posts,
        ]);
    }
    function editPost($id){
    $postManager = new PostManager();
    $result = $postManager->editOnePost($id);
    echo $this->twig->render('backend/edit.html.twig', [
            'result' => $result,
        ]);
    }
    function listComments(){
    $commentManager = new CommentManager();
    $commentsBack = $commentManager->getAllComments();
    echo $this->twig->render('backend/comments.html.twig', [
            'commentsBack' => $commentsBack,
        ]);
    }
    function admin_cats(){
        echo $this->twig->render('backend/admin_cats.html.twig', [
            
        ]);
    }
    function displayAllCatsBack(){
    $catManager = new CatManager();
    $allCats = $catManager->getAllCats();
    echo $this->twig->render('backend/display_cats.html.twig', [
            'allCats' => $allCats,
        ]);
    }
    function editCat($id){
    $catManager = new CatManager();
    $result = $catManager->editOneCat($id);
    echo $this->twig->render('backend/edit_cat.html.twig', [
            'results' => $result,
        ]);
    }
    function eraseTheCat($id){
    $catManager = new CatManager();
    $result = $catManager->eraseCat($id);
    echo $this->twig->render('backend/admin_cats.html.twig', [
            
        ]);
    }
    function listReportedComments(){
    $commentManager = new CommentManager();
    $reports = $commentManager->displayReportedComments();
    echo $this->twig->render('backend/reported_comments.html.twig', [
            'reports' => $reports,
        ]);
}
    function updatePost($category,$article,$title,$author,$id){
    $postManager = new PostManager();
    $request= $postManager->update($category,$article,$title,$author,$id);
    if ($request === false) {
        throw new Exception('Impossible de mettre le post a jour !');
    }
    else {
        
        header('Location: index.php?action=admin');
    }
    }

}