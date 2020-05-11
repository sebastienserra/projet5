<?php

namespace Projet5\Model;

class CatManager extends Manager
{

	public function getAllCats(){
	$allCats = $this->db->query("SELECT * FROM cat_data ORDER BY id DESC"); 
	return $allCats;
	}
	public function getAllBoys(){
	$boys = $this->db->query("SELECT * FROM cat_data WHERE age_category ='adultem' ORDER BY id DESC"); 
	return $boys;
	}
	public function getAllGirls(){
	$girls = $this->db->query("SELECT * FROM cat_data WHERE age_category ='adultef' ORDER BY id DESC"); 
	return $girls;
	}
	public function getAllYoungsters(){
	$youngsters = $this->db->query("SELECT * FROM cat_data WHERE age_category ='youngster' ORDER BY id DESC"); 
	return $youngsters;
	}
	public function getAllKittens(){
	$kittens = $this->db->query("SELECT * FROM cat_data WHERE age_category ='kitten' ORDER BY id DESC"); 
	return $kittens;
	}
  	public function editOneCat($id){
	$result = $this->db->prepare("SELECT * FROM cat_data WHERE id=?");
    $result->execute(array($id));
    return $result;
    }
    public function eraseCat($id){
        $erase = $this->db->prepare("DELETE FROM cat_data WHERE id=?");
        $erase->execute(array($id));
        return $erase;
  	}
  	public function updateCat($id,$name,$breeder,$gender,$dob,$coat_color,$hair_type,$tabby_marking,$eye_coloration,$pattern_of_coat,$breed,$status,$cat_shows,$location,$identification,$description){
    $update = $this->db->prepare("UPDATE cat_data SET id=:id, name=:name, breeder=:breeder, gender=:gender, dob=:dob, coat_color=:coat_color, hair_type=:hair_type, tabby_marking=:tabby_marking, eye_coloration=:eye_coloration, pattern_of_coat=:pattern_of_coat, breed=:breed, status=:status,cat_shows=:cat_shows, location=:location, identification=:identification, description=:description WHERE id=:id");
    $request= $update->execute(array(":id"=>$id, ":name"=>$name, ":breeder"=>$breeder, ":gender"=>$gender, ":dob"=>$dob, ":coat_color"=>$coat_color, ":hair_type"=>$hair_type, ":tabby_marking"=>$tabby_marking, ":eye_coloration"=>$eye_coloration, ":pattern_of_coat"=>$pattern_of_coat, ":breed"=>$breed, ":status"=>$status, ":cat_shows"=>$cat_shows, ":location"=>$location, ":identification"=>$identification, ":description"=>$description));
    return $request;
  	}
	public function loadCoat(){
	$coats = $this->db->query("SELECT DISTINCT coat_color FROM cat_data"); //DISTINCT evite de repeter black 2 fois par exemple
	$coats->execute();
	return $coats;
	}
	public function insertCatPictureAndData(){
		if(isset($_POST['submit'])){
			// testons si le fichier a bien ete envoye et s'il n'y a pas d'erreur
			if (isset($_FILES['monfichier']) AND $_FILES['monfichier']['error']==0) {
				if (isset($_FILES['monfichier']['size'])<=1000000) {

				$image= $_FILES['monfichier']['name'];
				$req = $this->db->prepare("INSERT INTO cat_data(name,breeder,gender,dob,coat_color,hair_type,tabby_marking,eye_coloration,pattern_of_coat,breed,status,cat_shows,location,identification,image,description, age_category) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
				$req->execute(array(($_POST['name']), ($_POST['breeder']), ($_POST['gender']), ($_POST['dob']), ($_POST['coat']), ($_POST['hair_type']), ($_POST['tabby_marking']), ($_POST['eye_coloration']), ($_POST['pattern']), ($_POST['breed']), ($_POST['status']), ($_POST['cat_shows']), ($_POST['pays']), ($_POST['identification']),($_FILES['monfichier']['name']),($_POST['description']),($_POST['age_category'])));
				//testons si l'extension est autorisee

				$infosfichier = pathinfo($_FILES['monfichier']['name']);
				$extension_upload = $infosfichier['extension'];
				$extensionsautorisees = array('jpg', 'jpeg', 'gif', 'png');
					if (in_array($extension_upload, $extensionsautorisees)) {
				


					//on peut valider le fichier et le stocker dans fichier uploads
					move_uploaded_file($_FILES['monfichier']['tmp_name'], 'uploads/'.basename($_FILES['monfichier']['name']));

					echo'Envoi effectué';
					header("Location: index.php?action=admin_cats");
					}
					else{
						echo 'Une erreur a eu lieu';
					}
				}

			}
		}
	}
    
}

