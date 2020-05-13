<?php



class CatManager 
{

	public function dbConnect(){
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
	public function catsByCoat(){
    	$q=$_GET['coat_color'];
    	
     	if($q!==""){
     		$coat_color= $q;
     		$db = $this->dbConnect();
     		$req = $db->prepare("SELECT  DISTINCT id,name,gender, coat_color,dob,description,image FROM cat_data WHERE coat_color='".$q."'");
		 	$req->execute(['coat_color'=>$coat_color]);
		 	while($data= $req->fetch(PDO::FETCH_ASSOC)){
		 	  ?>
		 	<div>	
			<div id="cat_presentation">
			<div id="cat_picture"><img src="./uploads/<?php echo $data['image'];?>">
			</div>
			<div id="cat_info">
				<p><span class="info_title">Prénom:</span><?php echo $data['name'];?></p>
				<p><span class="info_title">Sexe:</span><?php echo $data['gender'];?></p>
				<p><span class="info_title">Robe:</span><?php echo $data['coat_color'];?></p>
				<p><span class="info_title">Date de naissance:</span><?php echo $data['dob'];?></p>
				<p><span class="info_title">Description:</span><?php echo $data['description'];?></p>
			</div>
			</div>
			<?php
		
		 	}
		}


	}
}
// ma requete sql presentant les chats en fonctions de leur couleur

$present = new CatManager;
echo $present->catsByCoat();