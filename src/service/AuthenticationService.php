<?php


namespace Projet5\service;


use Projet5\Model\UserManager;

class AuthenticationService extends Manager
{
    private $userManager;

    public function __construct()
    {
        $this->userManager = new UserManager();
    }

    public function register()
    {
        $row = $this->userManager->checkEmailExists();
    }

    public function connect()
    {
        $data = $this->userManager->getUser();
    }

}