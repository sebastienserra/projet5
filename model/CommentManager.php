<?php
namespace Sebastien\Blog\Model;

require_once('./model/Manager.php');

class CommentManager extends Manager{

	public function getComments($postId){
			$db = $this->dbConnect();
			$comments = $db->prepare("SELECT * FROM comments WHERE id_post = ? ORDER BY date_of_comment DESC");
			$comments->execute(array($postId));
			return $comments;
			
		}
	public function getAllComments(){
			$db = $this->dbConnect();
			$commentsBack = $db->query("SELECT * FROM comments ORDER BY date_of_comment DESC LIMIT 0,30");
			return $commentsBack;
		}
	public function postComment($comment,$postId){
		$db = $this->dbConnect();
		 if(isset($_POST['button_comment'])){
		 	if(trim($_POST['comment'])=="" ){
			// do nothing
		 	}
			elseif (isset($_POST['comment']) AND isset($_POST['button_comment']))
		 	{
				$comments = $db->prepare('INSERT INTO comments(comment, id_post) VALUES(?,?)');
				$affectedLines = $comments->execute(array($comment,$postId));
				return $affectedLines;
			}
		}
	}
	public function reportComment($id){
			$db = $this->dbConnect();
			$reportComment = $db->prepare("INSERT INTO reported_comments(id_comment) VALUES(?)");
			$getReportedComment = $reportComment->execute(array($id));
			return $getReportedComment;
	}
	public function countReportedComments(){
			$db = $this->dbConnect();
			$reponse =  $db->query("SELECT COUNT(*) AS nb_comments FROM reported_comments");
			$donnees = $reponse->fetch();
			$nb_comments = $donnees['nb_comments'];
			return $nb_comments;
	}

	public function displayReportedComments(){
			$db = $this->dbConnect();
			$report = $db->query('SELECT comments.id, comments.comment, comments.id_post, reported_comments.id_comment
			FROM comments 
			JOIN reported_comments
			ON comments.id = reported_comments.id_comment
			ORDER BY reported_comments.id_comment DESC
			');
			return $report;
	}
	public function eraseReportedComment($id){
			$db = $this->dbConnect();
			$eraseReported = $db->prepare('DELETE comments, reported_comments
			FROM comments
			INNER JOIN reported_comments
			ON comments.id=reported_comments.id_comment
			WHERE comments.id=:id
			');
			$eraseReported->execute(array('id'=>$id));
	}

}
