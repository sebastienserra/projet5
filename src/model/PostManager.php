<?php

namespace Projet5\Model;

class PostManager extends Manager
{
    public function destroy($id)
    {
        $erase = $this->db->prepare("DELETE FROM posts WHERE id=?");
        $erase->execute(array($id));
        return $erase;
    }

    public function getAllPosts()
    {
        $getAllPosts = $this->db->query("SELECT * FROM posts ORDER BY id DESC LIMIT 0,10");
        return $getAllPosts;
    }

    public function getAllPostsAdmin()
    {
        $getAllPostsAdmin = $this->db->query("SELECT * FROM posts ORDER BY id DESC LIMIT 0,20");
        return $getAllPostsAdmin;
    }

    public function getPost($postId)
    {
        $query = $this->db->prepare("SELECT * FROM posts WHERE id = ?");
        $query->execute(array($postId));
        return $query->fetch();
    }

    public function allTitles()
    {
        $titles = $this->db->query("SELECT * FROM posts ORDER BY id");
        return $titles;
    }

    public function newPosts()
    {
        $byTitles = $this->db->query("SELECT * FROM posts ORDER BY id LIMIT 0,4");
        return $byTitles;
    }

    public function popularPosts()
    {
        $popularity = $this->db->query("SELECT * FROM posts ORDER BY id LIMIT 4,10");
        return $popularity;
    }

    public function lastPosts()
    {
        $reponse = $this->db->query("SELECT COUNT(*) AS nb_posts FROM posts");
        $donnees = $reponse->fetch();
        $nb_posts = $donnees['nb_posts'];
        $results_per_page = 3;
        $nber_of_pages = ceil($nb_posts / $results_per_page);
        if (!isset($_GET['page']) || $_GET['page'] <= 0 || $_GET['page'] > $nber_of_pages) {
            $page = 1;
        } else {
            $page = $_GET['page'];
        }
        $this_page_first_result = ($page - 1) * $results_per_page;
        $articles = $this->db->query("SELECT * FROM posts ORDER BY id DESC limit $this_page_first_result, $results_per_page");
        return $articles->fetchAll();
    }

    public function paginate()
    {
        $reponse = $this->db->query("SELECT COUNT(*) AS nb_posts FROM posts");
        $donnees = $reponse->fetch();
        $nb_posts = $donnees['nb_posts'];
        $results_per_page = 3;
        $nber_of_pages = ceil($nb_posts / $results_per_page);


        return $nber_of_pages;
    }

    public function finishOnWord($string, $limit, $stop = " ")
    {
        if (strlen($string) <= $limit) return $string;
        if (false !== ($stoppoint = strpos($string, $stop, $limit))) {
            if ($stoppoint < strlen($string) - 1) {
                $string = substr($string, 0, $stoppoint);
            }
        }
        return $string;
    }

    public function searchQuery()
    {

        if (isset($_POST['submit_search'])) {
            $search = $_POST['search_query'];
            $results = $this->db->prepare("SELECT * FROM posts WHERE article LIKE '%$search%' OR title LIKE '%$search%' ");
            $results->execute();
            return $results;
        }
    }

    public function create($post)
    {
        $req = $this->db->prepare("
            INSERT INTO posts(article,creation_date,title,author,category,image,imgdescription)
            values(:article,:creation_date,:title,:author,:category,:image,:imgdescription)");
        $nbResults = $req->execute([
            'article' => $post['article'],
            'creation_date' => $post['creation_date'],
            'title' => $post['title'],
            'author' => $post['author'],
            'category' => $post['category'],
            'image' => $post['image'],
            'imgdescription' => $post['imgdescription'],
        ]);
        return $nbResults;
    }

    public function update($post)
    {
        $req = $this->db->prepare("UPDATE posts 
        SET id=:id,article=:article,creation_date=:creation_date,title=:title,author=:author,category=:category,image=:image,imgdescription=:imgdescription 
        WHERE id=:id");
        $nbResults = $req->execute([
            'id' => $post['id'],
            'article' => $post['article'],
            'creation_date' => $post['creation_date'],
            'title' => $post['title'],
            'author' => $post['author'],
            'category' => $post['category'],
            'image' => $post['image'],
            'imgdescription' => $post['imgdescription'],
        ]);
        return $nbResults;
    }

    public function getLastArticle()
    {
        $getLastArticles = $this->db->query("SELECT * FROM posts ORDER BY id DESC LIMIT 0,1");
        return $getLastArticles;
    }

    public function subArticleOne()
    {
        $subOnes = $this->db->query("SELECT * FROM posts WHERE id=2");
        return $subOnes;
    }

    public function subArticleTwo()
    {
        $subTwos = $this->db->query("SELECT * FROM posts WHERE id=3");
        return $subTwos;
    }

    public function subArticleThree()
    {
        $subThrees = $this->db->query("SELECT * FROM posts WHERE id=4");
        return $subThrees;
    }

    public function subArticleFour()
    {
        $subFours = $this->db->query("SELECT * FROM posts WHERE id=5");
        return $subFours;
    }

    public function getPostsByCategory($category, $limit, $offset)
    {
        $query = $this->db->prepare("SELECT * FROM posts WHERE category=:category LIMIT {$offset}, {$limit}");
        $query->execute([
            'category' => $category,
        ]);
        return $query->fetchAll();
    }

    public function countPostsByCategory($category)
    {
        $query = $this->db->prepare("SELECT count(*) as nb FROM posts WHERE category=?");
        $query->execute([$category]);
        return $query->fetch();
    }

}
