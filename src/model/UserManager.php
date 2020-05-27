<?php

namespace Projet5\Model;

class UserManager extends Manager
{

    public function getUser($email)
    {
        $req = $this->db->prepare('SELECT * FROM users WHERE email=:email');
        $req->execute(['email' => $email]);
        return $req->fetch();
    }
    public function getAdmin($email)
    {
        $req = $this->db->prepare('SELECT * FROM users WHERE email="seb@cats.com"');
        $req->execute(['email' => $email]);
        return $req->fetch();
    }

    public function emailExists($email)
    {
        $req = $this->db->prepare('SELECT count(*) as nb_user FROM users WHERE email=:email');
        $req->execute(['email' => $email]);
        $row = $req->fetch();

        return $row['nb_user'] > 0;
    }
    
    public function createUser($email, $password)
    {
        $req = $this->db->prepare("INSERT INTO users(email, password) values(?,?)");
        $nbResults = $req->execute([$email, $password]);
        return $nbResults;
    }
    public function message($object_message,$first_name,$last_name,$email, $message_text)
    {
        $req = $this->db->prepare("INSERT INTO messages(object_message, first_name, last_name,email, message_text) values(?,?,?,?,?)");
        $message = $req->execute([$object_message,$first_name,$last_name,$email, $message_text]);
        return $message;
    }


}
