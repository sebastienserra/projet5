<?php


namespace Projet5\Service;


use Projet5\Model\CatManager;

class CatService
{
    private $catManager;

    public function __construct()
    {
        $this->catManager = new CatManager();
    }


    public function uploadPhoto($file)
    {
        if (isset($file['size']) > 1000000) {
            return false;
        }
        $infosfichier = pathinfo($file['name']);
        $extension_upload = $infosfichier['extension'];
        $extensionsautorisees = array('jpg', 'jpeg', 'gif', 'png');
        if (in_array($extension_upload, $extensionsautorisees)) {
            //on peut valider le fichier et le stocker dans fichier uploads
            $destination = 'uploads/' . basename($file['name']);
            move_uploaded_file($file['tmp_name'], $destination);
            return $file['name'];
        }
        return false;

    }

    public function addCat($catData, $image)
    {
        $destination = $this->uploadPhoto($image);
        if ($destination) {
            $catData['image'] = $destination;
            $nbResults = $this->catManager->create($catData);
            return $nbResults > 0;
        }
        return false;
    }

    public function editCat($catData, $image)
    {
        $destination = $catData['previous_image'];
        if(!empty($image['tmp_name'])) {
            unlink('uploads/' . $catData['previous_image']);
            $destination = $this->uploadPhoto($image);
        }
        if ($destination) {
            $catData['image'] = $destination;
            $nbResults = $this->catManager->update($catData);
            return $nbResults > 0;
        }
        return false;
    }

}