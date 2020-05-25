<?php


namespace Projet5\Service;


use Projet5\Model\PostManager;

class PostService
{
    private $postManager;

    public function __construct()
    {
        $this->postManager = new PostManager();
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

    public function addPost($postData, $image)
    {
        $destination = $this->uploadPhoto($image);
        if ($destination) {
            $postData['image'] = $destination;
            $nbResults = $this->postManager->create($postData);
            return $nbResults > 0;
        }
        return false;
    }
    public function editPost($postData, $image)
    {
        $destination = $postData['previous_image'];
        if(!empty($image['tmp_name'])) { // si le fichier temporaire existe ca signifie qu une image a ete uploader donc on efface l image precedente definie avant le if
            unlink('uploads/' . $postData['previous_image']);
            $destination = $this->uploadPhoto($image);
        }
        if ($destination) {
            $postData['image'] = $destination;
            $nbResults = $this->postManager->update($postData);
            return $nbResults > 0;
        }
        return false;
    }
    
}