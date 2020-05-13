<?php

namespace Projet5\Controller;

use Projet5\Model\PostManager;
use Projet5\Model\CommentManager;
use Projet5\Model\CatManager;
use Projet5\Model\UserManager;

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

    function addPost($article,$title,$author,$category)
    {
    $affectedLinesPost = $this->postManager->saveRecords($article,$title,$author,$category);
    
    if ($affectedLinesPost === false) {
        //header("location:".  $_SERVER['HTTP_REFERER']); 
        echo 'error';
        //var_dump($affectedLinesPost);   
    }
    else{
        echo'success';
            //header('Location: index.php?action=admin&success=true');
    }
    }
    function editPost($id)
    {
        $result = $this->postManager->editOnePost($id);
        echo $this->twig->render('backend/edit.html.twig', [
            'result' => $result,
        ]);
    }

    function updatePost($category, $article, $title, $author, $id)
    {
        $request = $this->postManager->update($category, $article, $title, $author, $id);
        if ($request === false) {
        //throw new Exception('Impossible de supprimer le commentaire !');
        echo'error';
    }
    else {
        //header('Location: index.php?action=moderate');
        echo'success';
    }
    }
    function updateCat($id,$name,$breeder,$gender,$dob,$coat_color,$hair_type,$tabby_marking,$eye_coloration,$pattern_of_coat,$breed,$status,$cat_shows,$location,$identification,$description,$image,$age_category)
    {
    $request= $this->catManager->updateCat($id,$name,$breeder,$gender,$dob,$coat_color,$hair_type,$tabby_marking,$eye_coloration,$pattern_of_coat,$breed,$status,$cat_shows,$location,$identification,$description,$image,$age_category);
    if ($request === false) {
        //throw new Exception('Impossible de supprimer le commentaire !');
        echo'error';
    }
    else {
        //header('Location: index.php?action=moderate');
        echo'success';
    }
}
    function deletePost($id){
    $erase = $this->postManager->destroy($id);
    if ($erase === false) {
        //header("location:".  $_SERVER['HTTP_REFERER']); 
        echo 'error';
        //var_dump($affectedLinesPost);   
    }
    else{
        echo'success';
            //header('Location: index.php?action=admin&success=true');
    }
    }
    function listReportedComments()
    {
        $reports = $this->commentManager->getReportedComments();
        echo $this->twig->render('backend/reported_comments.html.twig', [
            'reports' => $reports,
        ]);
    }
    function destroyReportedComment($id)
    {
  
    $eraseReported = $this->commentManager->eraseReportedComment($id);
    if ($eraseReported === false) {
        //throw new Exception('Impossible de supprimer le commentaire !');
        echo'error';
    }
    else {
        //header('Location: index.php?action=moderate');
        echo'success';
    }
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

    function listComments()
    {
        $commentsBack = $this->commentManager->getAllComments();
        echo $this->twig->render('backend/comments.html.twig', [
            'commentsBack' => $commentsBack,
        ]);
    }

    function addCat($name,$breeder,$gender,$dob,$coat_color,$hair_type,$tabby_marking,$eye_coloration,$pattern_of_coat,$breed,$status,$cat_shows,$location,$identification,$image,$description,$age_category)
    {
        $req = $this->catManager->insertCatPictureAndData($name,$breeder,$gender,$dob,$coat_color,$hair_type,$tabby_marking,$eye_coloration,$pattern_of_coat,$breed,$status,$cat_shows,$location,$identification,$image,$description,$age_category);
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

}