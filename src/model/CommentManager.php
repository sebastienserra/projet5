<?php
namespace Projet5\Model;


class CommentManager extends Manager{

	public function getComments($postId){
			$comments = $this->db->prepare("SELECT * FROM comments WHERE id_post = ? ORDER BY date_of_comment DESC");
			$comments->execute(array($postId));
			return $comments;
			
		}
	public function getAllComments(){
			$commentsBack = $this->db->query("SELECT * FROM comments ORDER BY date_of_comment DESC LIMIT 0,30");
			return $commentsBack;
		}
	public function postComment($comment,$postId){
		 if(isset($_POST['button_comment'])){
		 	if(trim($_POST['comment'])=="" ){
			// do nothing
		 	}
			elseif (isset($_POST['comment']) AND isset($_POST['button_comment']))
		 	{
				$comments = $this->db->prepare('INSERT INTO comments(comment, id_post) VALUES(?,?)');
				$affectedLines = $comments->execute(array($comment,$postId));
				return $affectedLines;
			}
		}
	}
	public function reportComment($id){
			$db = $this->dbConnect();
			$reportComment = $this->db->prepare("INSERT INTO reported_comments(id_comment) VALUES(?)");
			$getReportedComment = $reportComment->execute(array($id));
			return $getReportedComment;
	}
	public function countReportedComments(){
			$reponse =  $db->query("SELECT COUNT(*) AS nb_comments FROM reported_comments");
			$donnees = $reponse->fetch();
			$nb_comments = $donnees['nb_comments'];
			return $nb_comments;
	}

	public function displayReportedComments(){
			$reports = $this->db->query('SELECT comments.id, comments.comment, comments.id_post, reported_comments.id_comment
			FROM comments 
			JOIN reported_comments
			ON comments.id = reported_comments.id_comment
			ORDER BY reported_comments.id_comment DESC
			');
			return $reports;
	}
	public function eraseReportedComment($id){
			$eraseReported = $this->db->prepare('DELETE comments, reported_comments
			FROM comments
			INNER JOIN reported_comments
			ON comments.id=reported_comments.id_comment
			WHERE comments.id=:id
			');
			$eraseReported->execute(array('id'=>$id));
	}

}
