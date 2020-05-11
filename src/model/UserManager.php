<?php

namespace Projet5\Model;

require_once('./model/Manager.php');

class UserManager extends Manager{
	public function getUser(){//pb avec cette fonction meme si tout ok m envois sur page d erreur

    	if(isset($_POST['login-submit'])){
			$email= ($_POST['email']);
			$_POST['password'] = ($_POST['password']);
			$req = $this->db->query('SELECT id, email, password FROM users');
			$data = $req->fetch();

			$isPasswordCorrect = password_verify($_POST['password'], $data['password']);

				if(empty($_POST['email']) OR empty($_POST['email']) OR $_POST['email']!=$data['email']){
					header('Location: index.php?action=login_error');
				}elseif($isPasswordCorrect AND $_POST['email']==$data['email']){
					$_SESSION['email'] = $data['email'];
					require('./view/frontend/blog.php');
				}else{
					echo'what happened?';
					//header('Location: index.php?action=login_error');
			}
		}
	}
	public function checkEmailExists(){
		if(isset($_POST['login-submit'])){
		$email = $_POST['email'];
		$password = $_POST['password'];
	
		if(!preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['email'])){
			echo'Vous devez remplir les champs correctement.';
			
		}

		if(preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['email']) AND empty($_POST['password'])){
			echo'Vous devez remplir les champs correctement.';
		}
		if(preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['email']) AND !empty($_POST['password'])){
		$email = $_POST['email'];
		
		$req = $this->db->query('SELECT * FROM users WHERE email="'.$email.'"');
		$req->execute(['email'=>$email]);
		$row = $req->fetch();
		
		if($row>0){
			$row = 1;
			echo'Vous êtes déjà inscrits.';
		}
		if($row===false){
		
		$row = 0;
		$email = $_POST['email'];
		$password = $_POST['password'];
		$hashedpassword = password_hash($password, PASSWORD_DEFAULT);
		
		$req = $this->db->prepare("INSERT INTO users(email, password) values(?,?)");
		$req->execute(array(($_POST['email']), $hashedpassword));
		echo'Vous êtes bien inscrits!';
		header('Location: index.php');


		}
		
	}
	}
	}

}
