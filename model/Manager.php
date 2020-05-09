<?php
namespace Sebastien\Blog\Model;

class Manager{
	protected function dbConnect(){
	    try
	    {	 
	        //$db = new \PDO('mysql:host=db5000325587.hosting-data.io;dbname=dbs317714;charset=utf8', 'dbu592945', '!Ch_at#22-n20');
	        $db = new \PDO('mysql:host=localhost;dbname=pompons;charset=utf8', 'root', '');
	        return $db;
	        
	        
	    }
	    catch(Exception $e)
	    {
	        die('Erreur : '.$e->getMessage());
	    }
	}
}
