<?php

namespace Projet5\Model;

class PostManager extends Manager
{

  public function saveRecords($article,$title,$author,$category){
        $savePost = $this->db->prepare("INSERT INTO posts(article, title, author, category) values(?,?,?,?)");
        $affectedLinesPost = $savePost->execute(array($article,$title,$author,$category));
        return $affectedLinesPost;
  }
  public function destroy($id){
        $erase = $this->db->prepare("DELETE FROM posts WHERE id=?");
        $erase->execute(array($id));
        return $erase;
  }
  public function editOnePost($id){
        $result = $this->db->prepare("SELECT article, title, author,category, id FROM posts WHERE id=?");
        $result->execute(array($id));
        return $result;
  }
  public function update($category,$article,$title,$author,$id){
        $update = $this->db->prepare("UPDATE posts SET category=:category, article=:article, title=:title, author=:author, id=:id WHERE id=:id");
        $request= $update->execute(array(":category"=>$category,":article"=>$article, ":title"=>$title, ":author"=>$author, ":id"=>$id));
        return $request;
  }
  public function getAllPosts(){
        $getAllPosts = $this->db->query("SELECT * FROM posts ORDER BY id DESC LIMIT 0,10");       
        return $getAllPosts;
  }
  public function getAllPostsAdmin(){
         $getAllPostsAdmin = $this->db->query("SELECT * FROM posts ORDER BY id DESC LIMIT 0,5");       
         return $getAllPostsAdmin;
  }
  public function getPost($postId){	
    		$posts = $this->db->prepare("SELECT id, article, author, title, creation_date FROM posts WHERE id = ?");
    		$posts->execute(array($postId));
    		return $posts;	
  }
  public function allTitles(){
         $titles = $this->db->query("SELECT * FROM posts ORDER BY id");
         return $titles;
  }
  public function newPosts(){
         $byTitles = $this->db->query("SELECT * FROM posts ORDER BY id LIMIT 0,4");
         return $byTitles;
  }
    public function popularPosts(){
         $popularity = $this->db->query("SELECT * FROM posts ORDER BY id LIMIT 4,10");
         return $popularity;
  }
  public function lastPosts(){
        $reponse =  $this->db->query("SELECT COUNT(*) AS nb_posts FROM posts");
        $donnees = $reponse->fetch();
        $nb_posts=$donnees['nb_posts'];
        $results_per_page=3;
        $nber_of_pages=ceil($nb_posts/$results_per_page);
        if(!isset($_GET['page']) || $_GET['page'] <=0 || $_GET['page']>$nber_of_pages){
        $page=1;
        }else{
          $page= $_GET['page'];
        }
        $this_page_first_result=($page-1)*$results_per_page;
        $articles = $this->db->query("SELECT * FROM posts ORDER BY id DESC limit $this_page_first_result, $results_per_page");
        return $articles->fetchAll();
  }
  public function paginate(){
        $reponse =  $this->db->query("SELECT COUNT(*) AS nb_posts FROM posts");
        $donnees = $reponse->fetch();
        $nb_posts=$donnees['nb_posts'];
        $results_per_page=3;
        $nber_of_pages=ceil($nb_posts/$results_per_page);
        return $nber_of_pages;
  }
  public function searchQuery(){

    if(isset($_POST['submit_search'])){
      $search = $_POST['search_query'];
      $results =  $this->db->prepare("SELECT * FROM posts WHERE article LIKE '%$search%' OR title LIKE '%$search%' ");
      $results->execute();
      return $results;
    }
   }

}
