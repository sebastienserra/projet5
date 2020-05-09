<?php

namespace Projet5\Controller;

class BackendController
{

    private $twig;

    public function __construct($twig)
    {
        $this->twig = $twig;
    }

}