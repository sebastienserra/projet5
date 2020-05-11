<?php
require_once('./model/Manager.php');
require_once('./model/PostManager.php');
require_once('./model/CommentManager.php');
require_once('./model/UserManager.php');
require_once('./model/CatManager.php');


function listPostsAdmin(){
    $postManager = new \Sebastien\Blog\Model\PostManager();
    $posts = $postManager->getAllPostsAdmin();
    require('./view/backend/admin_view.php');
}
function admin_cats(){
    require('./view/backend/admin_cats.php');
}

function register(){
$user = new \Sebastien\Blog\Model\UserManager();
$row = $user->checkEmailExists();
}


function connect(){
    $user = new \Sebastien\Blog\Model\UserManager();
    $data = $user->getUser();
}
function editPost($id){
    $postManager = new \Sebastien\Blog\Model\PostManager();
    $result = $postManager->editOnePost($id);
    require('./view/backend/edit_view.php');
}
function updatePost($category,$article,$title,$author,$id){
    $postManager = new \Sebastien\Blog\Model\PostManager();
    $request= $postManager->update($category,$article,$title,$author,$id);
    if ($request === false) {
        throw new Exception('Impossible de mettre le post a jour !');
    }
    else {
        header('Location: index.php?action=admin');
    }
}



function deletePost($id){
    $postManager = new \Sebastien\Blog\Model\PostManager();
    $erase = $postManager->destroy($id);
    if ($erase === false) {
        throw new Exception('Impossible d\'effacer le post !');
    }
    else {
        header('Location: index.php?action=admin');
    }
}
function addPost($article,$title,$author,$category){
    $postManager = new \Sebastien\Blog\Model\PostManager();
    $affectedLinesPost = $postManager->saveRecords($article,$title,$author,$category);
    if ($affectedLinesPost === false) {
        throw new Exception('Impossible d\'ajouter le post !');
    }
    else {
        header('Location: index.php?action=admin');
    }
}
function addComment($comment,$postId){
    $commentManager = new \Sebastien\Blog\Model\CommentManager();
    $affectedLines = $commentManager->postComment($comment,$postId);
    if ($affectedLines === false) {
        throw new Exception('Impossible d ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=postandcomments&id=' . $postId);
    }
}
function listComments(){
    $commentManager = new \Sebastien\Blog\Model\CommentManager();
    $commentsBack = $commentManager->getAllComments();
    require('./view/backend/comments.php');
}
function listReportedComments(){
    $commentManager = new \Sebastien\Blog\Model\CommentManager();
    $report = $commentManager->displayReportedComments();
    require('./view/backend/reported_comments.php');
}
function destroyReportedComment($id){
    $commentManager = new \Sebastien\Blog\Model\CommentManager();
    $eraseReported = $commentManager->eraseReportedComment($id);
    if ($eraseReported === false) {
        throw new Exception('Impossible de supprimer le commentaire !');
    }
    else {
        header('Location: index.php?action=moderate');
    }
}
function getReportedComment($id){
    $commentManager = new \Sebastien\Blog\Model\CommentManager();
    $getReportedComment = $commentManager->reportComment($id);
    if ($getReportedComment === false) {
        throw new Exception('Impossible de signaler le commentaire !');
    }
    else {
        header("location:".  $_SERVER['HTTP_REFERER']); 
    }
}
function addCat(){
    $catManager = new \Sebastien\Blog\Model\CatManager();
    $req = $catManager->insertCatPictureAndData();
}

function displayAllCatsBack(){
    $catManager = new \Sebastien\Blog\Model\CatManager();
    $req = $catManager->getAllCats();
    require('./view/backend/display_cats.php');
}

function editCat($id){
    $catManager = new \Sebastien\Blog\Model\CatManager();
    $result = $catManager->editOneCat($id);
    require('./view/backend/edit_cat.php');
}
function eraseTheCat($id){
    $catManager = new \Sebastien\Blog\Model\CatManager();
    $result = $catManager->eraseCat($id);
    require('./view/backend/admin_cats.php');
}
function updateCat($id,$name,$breeder,$gender,$dob,$coat_color,$hair_type,$tabby_marking,$eye_coloration,$pattern_of_coat,$breed,$status,$cat_shows,$location,$identification,$image,$description){
      $catManager = new \Sebastien\Blog\Model\CatManager();
    $request= $catManager->updateCat($id,$name,$breeder,$gender,$dob,$coat_color,$hair_type,$tabby_marking,$eye_coloration,$pattern_of_coat,$breed,$status,$cat_shows,$location,$identification,$image,$description);

    if ($request === false) {
        throw new Exception('Impossible de mettre le post a jour !');
    }
    else {
        move_uploaded_file($_FILES['monfichier']['tmp_name'], 'uploads/'.basename($_FILES['monfichier']['name']));
        header('Location: index.php?action=admin_cats');
    }
}