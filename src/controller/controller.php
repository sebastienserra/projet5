<?php
require_once('./model/Manager.php');
require_once('./model/PostManager.php');
require_once('./model/CommentManager.php');
require_once('./model/UserManager.php');
require_once('./model/CatManager.php');

function register(){
$user = new \Sebastien\Blog\Model\UserManager();
$row = $user->checkEmailExists();
}
function connect(){
    $user = new \Sebastien\Blog\Model\UserManager();
    $data = $user->getUser();
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
        //throw new Exception('Impossible d\'ajouter le post !');
        header('Location: index.php?action=admin&success=false');
    }
    else {
        header('Location: index.php?action=admin');
    }
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