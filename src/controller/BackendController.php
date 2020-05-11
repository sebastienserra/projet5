<?php

namespace Projet5\Controller;

use Projet5\Model\PostManager;
use Projet5\Model\CommentManager;
use Projet5\Model\CatManager;

class BackendController
{

    private $twig;

    public function __construct($twig)
    {
        $this->twig = $twig;
    }

}