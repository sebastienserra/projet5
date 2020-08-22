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
        $req = $this->db->prepare("UPDATE cat_data SET id=:id,father=:father,mother=:mother,name=:name,breeder=:breeder,origin_cat=:origin_cat,
        place_of_origin=:place_of_origin,gender=:gender,dob=:dob,enter_cattery=:enter_cattery,out_cattery=:out_cattery,
        destination_cat=:destination_cat,new_owner=:new_owner,new_owner_address=:new_owner_address,new_owner_phone=:new_owner_phone,
        new_owner_other_contact=:new_owner_other_contact,rip=:rip,rip_description=:rip_description,age_category=:age_category,
        coat_color=:coat_color,hair_type=:hair_type,tabby_marking=:tabby_marking,eye_coloration=:eye_coloration,
        pattern_of_coat=:pattern_of_coat,breed=:breed,status=:status,cat_shows=:cat_shows,location=:location,identification=:identification,
        image=:image,description=:description
        WHERE id=:id");
        $nbResults = $req->execute([
            'id' => $cat['id'],
            'father' => $cat['father'],
            'mother' => $cat['mother'],
            'name' => $cat['name'],
            'breeder' => $cat['breeder'],
            'origin_cat' => $cat['origin_cat'],
            'place_of_origin' => $cat['place_of_origin'],
            'gender' => $cat['gender'],
            'dob' => $cat['dob'],
            'enter_cattery' => $cat['enter_cattery'],
            'out_cattery' => $cat['out_cattery'],
            'destination_cat' => $cat['destination_cat'],
            'new_owner' => $cat['new_owner'],
            'new_owner_address' => $cat['new_owner_address'],
            'new_owner_phone' => $cat['new_owner_phone'],            
            'new_owner_other_contact' => $cat['new_owner_other_contact'],
            'rip' => $cat['rip'],
            'rip_description' => $cat['rip_description'],
            'age_category' => $cat['age_category'],  
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
        ]);
        return $nbResults;
    }


    public function create($cat)
    {
        $req = $this->db->prepare("
            INSERT INTO cat_data(father,mother,name,breeder,origin_cat,place_of_origin,gender,dob,enter_cattery,out_cattery,destination_cat,new_owner,new_owner_address,new_owner_phone,new_owner_other_contact,rip,rip_description,age_category,coat_color,hair_type,
            tabby_marking,eye_coloration,
            pattern_of_coat,breed,status,cat_shows,location,identification,image,description)
            values(:father,:mother,:name,:breeder,:origin_cat,:place_of_origin,:gender,:dob,:enter_cattery,:out_cattery,:destination_cat,:new_owner,:new_owner_address,:new_owner_phone,:new_owner_other_contact,:rip,:rip_description,:age_category,:coat_color,:hair_type,:tabby_marking,:eye_coloration,
            :pattern_of_coat,:breed,:status,:cat_shows,:location,:identification,:image,:description)");
        $nbResults = $req->execute([
            'father' => $cat['father'],
            'mother' => $cat['mother'],
            'name' => $cat['name'],
            'breeder' => $cat['breeder'],
            'origin_cat' => $cat['origin_cat'],
            'place_of_origin' => $cat['place_of_origin'],
            'gender' => $cat['gender'],
            'dob' => $cat['dob'],
            'enter_cattery' => $cat['enter_cattery'],
            'out_cattery' => $cat['out_cattery'],
            'destination_cat' => $cat['destination_cat'],
            'new_owner' => $cat['new_owner'],
            'new_owner_address' => $cat['new_owner_address'],
            'new_owner_phone' => $cat['new_owner_phone'],            
            'new_owner_other_contact' => $cat['new_owner_other_contact'],
            'rip' => $cat['rip'],
            'rip_description' => $cat['rip_description'],
            'age_category' => $cat['age_category'],  
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
        ]);
        return $nbResults;
    }
    public function visit($date_visit,$cat_name,$gender,$age_category,$vet_name,$diagnostic,$treatment,$cost,$intervention)
    {
        $req = $this->db->prepare("INSERT INTO veterinarian(date_visit,cat_name,gender,age_category,vet_name,diagnostic,treatment,cost,intervention) 
        values(?,?,?,?,?,?,?,?,?)");
        $visit = $req->execute([$date_visit,$cat_name,$gender,$age_category,$vet_name,$diagnostic,$treatment,$cost,$intervention]);
        return $visit;
    }
    public function getAllVisits()
    {
    $allVisits = $this->db->query("SELECT * FROM veterinarian ORDER BY id DESC");
        return$allVisits;
    }
    public function litters($father,$mother,$litter_number, $mating_date,$parturition_date,$females_number,$males_number,$total_kittens,$general_observation,$parturition_observation,$gestation_observation)
    {
        $req = $this->db->prepare("INSERT INTO litters(father,mother,litter_number,mating_date,parturition_date,females_number,males_number,total_kittens,general_observation,parturition_observation,gestation_observation) 
        values(?,?,?,?,?,?,?,?,?,?,?)");
        $litter = $req->execute([$father,$mother,$litter_number, $mating_date,$parturition_date,$females_number,$males_number,$total_kittens,$general_observation,$parturition_observation,$gestation_observation]);
        return $litter;
    }
    public function getAllLitters()
    {
    $allLitters = $this->db->query("SELECT * FROM litters ORDER BY id DESC");
        return $allLitters;
    }
    public function kittensDaily($cat_name,$weight,$daily_observation)
    {
        $req = $this->db->prepare("INSERT INTO kittens(cat_name,weight,daily_observation) 
        values(?,?,?)");
        $kittenDaily = $req->execute([$cat_name,$weight,$daily_observation]);
        return $kittenDaily;
    }
    public function getAllDailyObservations()
    {
    $allObservations = $this->db->query("SELECT * FROM kittens ORDER BY cat_name");
        return $allObservations;
    }
    public function addNewCredit($date_credit,$item_credit,$cat_name,$amount_credit,$observation_credit)
    {
        $req = $this->db->prepare("INSERT INTO credit(date_credit, item_credit,cat_name,amount_credit,observation_credit) 
        values(?,?,?,?,?)");
        $credit = $req->execute([$date_credit,$item_credit,$cat_name,$amount_credit,$observation_credit]);
        return $credit;
    }
    public function getAllCredits()
    {
    $allCredits = $this->db->query("SELECT * FROM credit ORDER BY id DESC");
        return $allCredits;
    }
    public function addNewDebit($date_debit,$item_debit,$cat_name,$amount_debit,$observation_debit)
    {
        $req = $this->db->prepare("INSERT INTO debit(date_debit, item_debit,cat_name,amount_debit,observation_debit) 
        values(?,?,?,?,?)");
        $debit = $req->execute([$date_debit,$item_debit,$cat_name,$amount_debit,$observation_debit]);
        return $debit;
    }
    public function getAllDebits()
    {
    $allDebits = $this->db->query("SELECT * FROM debit ORDER BY id DESC");
        return $allDebits;
    }
    public function totalDebits()
    {
    $totalDebit = $this->db->query("SELECT SUM(amount_debit) AS totDebit FROM debit");
    $dataDebit = $totalDebit->fetch(PDO::FETCH_ASSOC);
    
        return $dataDebit;
    }
    public function totalCredits()
    {
    $totalCredit = $this->db->query("SELECT SUM(amount_credit) AS totCredit FROM credit");
    $data = $totalCredit->fetch(PDO::FETCH_ASSOC);
    
        return $data;
    }

}

