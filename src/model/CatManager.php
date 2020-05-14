<?php

namespace Projet5\Model;

use PDO;

class CatManager extends Manager
{

    public function getAllCats()
    {
        $allCats = $this->db->query("SELECT * FROM cat_data ORDER BY id DESC");
        return $allCats;
    }

    public function getAllBoys()
    {
        $boys = $this->db->query("SELECT * FROM cat_data WHERE age_category ='adultem' ORDER BY id DESC");
        return $boys;
    }

    public function getAllGirls()
    {
        $girls = $this->db->query("SELECT * FROM cat_data WHERE age_category ='adultef' ORDER BY id DESC");
        return $girls;
    }

    public function getAllYoungsters()
    {
        $youngsters = $this->db->query("SELECT * FROM cat_data WHERE age_category ='youngster' ORDER BY id DESC");
        return $youngsters;
    }

    public function getAllKittens()
    {
        $kittens = $this->db->query("SELECT * FROM cat_data WHERE age_category ='kitten' ORDER BY id DESC");
        return $kittens;
    }

    public function editOneCat($id)
    {
        $result = $this->db->prepare("SELECT * FROM cat_data WHERE id=?");
        $result->execute(array($id));
        return $result;
    }

    public function eraseCat($id)
    {
        $erase = $this->db->prepare("DELETE FROM cat_data WHERE id=?");
        $erase->execute(array($id));
        return $erase;
    }

    public function loadCoat()
    {
        $coats = $this->db->query("SELECT DISTINCT coat_color FROM cat_data"); //DISTINCT evite de repeter black 2 fois par exemple
        $coats->execute();
        return $coats;
    }

    public function getCatByCoat($coat)
    {
        $req = $this->db->prepare("
            SELECT DISTINCT id,name,gender, coat_color,dob,description,image 
            FROM cat_data 
            WHERE coat_color=:coat_color");
        $req->execute(['coat_color' => $coat]);
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($cat)
    {
        $req = $this->db->prepare("UPDATE cat_data SET id=:id,name=:name,breeder=:breeder,gender=:gender,dob=:dob,coat_color=:coat_color,hair_type=:hair_type,tabby_marking=:tabby_marking,eye_coloration=:eye_coloration,pattern_of_coat=:pattern_of_coat,breed=:breed,status=:status,cat_shows=:cat_shows,location=:location,identification=:identification,description=:description,image=:image,age_category=:age_category WHERE id=:id");
        $nbResults = $req->execute([
            'id' => $cat['id'],
            'name' => $cat['name'],
            'breeder' => $cat['breeder'],
            'gender' => $cat['gender'],
            'dob' => $cat['dob'],
            'coat_color' => $cat['coat'],
            'hair_type' => $cat['hair_type'],
            'tabby_marking' => $cat['tabby_marking'],
            'eye_coloration' => $cat['eye_coloration'],
            'pattern_of_coat' => $cat['pattern'],
            'breed' => $cat['breed'],
            'status' => $cat['status'],
            'cat_shows' => $cat['cat_shows'],
            'location' => $cat['pays'],
            'identification' => $cat['identification'],
            'image' => $cat['image'],
            'description' => $cat['description'],
            'age_category' => $cat['age_category'],
        ]);
        return $nbResults;
    }


    public function create($cat)
    {
        $req = $this->db->prepare("
            INSERT INTO cat_data(name,breeder,gender,dob,coat_color,hair_type,tabby_marking,eye_coloration,pattern_of_coat,breed,status,cat_shows,location,identification,image,description, age_category)
            values(:name, :breeder, :gender, :dob, :coat_color,:hair_type,:tabby_marking,:eye_coloration,:pattern_of_coat,:breed,:status,:cat_shows,:location,:identification,:image,:description,:age_category)");
        $nbResults = $req->execute([
            'name' => $cat['name'],
            'breeder' => $cat['breeder'],
            'gender' => $cat['gender'],
            'dob' => $cat['dob'],
            'coat_color' => $cat['coat'],
            'hair_type' => $cat['hair_type'],
            'tabby_marking' => $cat['tabby_marking'],
            'eye_coloration' => $cat['eye_coloration'],
            'pattern_of_coat' => $cat['pattern'],
            'breed' => $cat['breed'],
            'status' => $cat['status'],
            'cat_shows' => $cat['cat_shows'],
            'location' => $cat['pays'],
            'identification' => $cat['identification'],
            'image' => $cat['image'],
            'description' => $cat['description'],
            'age_category' => $cat['age_category'],
        ]);
        return $nbResults;
    }

}

