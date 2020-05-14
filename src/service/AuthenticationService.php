<?php

namespace Projet5\Service;

use Projet5\Model\UserManager;

class AuthenticationService
{
    private $userManager;

    public function __construct()
    {
        $this->userManager = new UserManager();
    }

    public function signin($email, $password)
    {
        $user = $this->userManager->getUser($email);
        if (!$user) {
            return false;
        }
        return password_verify($password, $user['password']);
    }

    public function signup($email, $password)
    {
        $emailExists = $this->userManager->emailExists($email);
        if ($emailExists) {
            return false;
        }
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $nbResults = $this->userManager->createUser($email, $passwordHash);
        return $nbResults > 0;

    }

    public function isConnected()
    {
        return isset($_SESSION['admin']) && $_SESSION['admin'];
    }

}