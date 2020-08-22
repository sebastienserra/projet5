<?php

namespace Projet5\Model;

class Manager
{

    protected $db;

    public function __construct()
    {
        $env = parse_ini_file(__DIR__ . '/../../env');

        try {
            $this->db = new \PDO('mysql:host=' . $env['db_host'] . ';dbname=' . $env['db_name'] . ';charset=utf8', $env['db_user'], $env['db_password']);
            //$this->db = new \PDO('mysql:host=' . $env['db_host'] . ';port=' . $env['port:'] . ';dbname=' . $env['db_name'] . ';charset=utf8', $env['db_user'], $env['db_password']);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
}