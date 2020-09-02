<?php

namespace Projet5\Controller;

use Projet5\Model\PostManager;
use Projet5\Model\CommentManager;
use Projet5\Model\CatManager;
use Projet5\Model\UserManager;
use Projet5\Service\AuthenticationService;
use Projet5\Service\CatService;
use Projet5\Service\PostService;

class BackendController
{

    private $twig;
    private $postManager;
    private $commentManager;
    private $catManager;
    private $authenticationService;
    private $catService;
    private $postService;

    public function __construct($twig)
    {
        /** @var \Twig\Environment $twig */
        $this->twig = $twig;
        $this->postManager = new PostManager();
        $this->commentManager = new CommentManager();
        $this->catManager = new CatManager();
        $this->authenticationService = new AuthenticationService();
        $this->catService = new CatService();
        $this->postService = new PostService();
    }


    function addPost($postData, $image)
    {
        if (!$this->authenticationService->isConnected()) {
            header('Location: index.php?action=login');
        }

        $this->postService->addPost($postData, $image);
        header('Location: index.php?action=admin');
    }

    function editPost($id)
    {
        if (!$this->authenticationService->isConnected()){
            header('Location: index.php?action=login');
        }
        $results = $this->postManager->editOnePost($id);
        echo $this->twig->render('backend/edit.html.twig', [
            'results' => $results,
        ]);
    }

    function editCat($id)
    {
        if (!$this->authenticationService->isConnected()) {
            header('Location: index.php?action=login');
        }
        $results = $this->catManager->editOneCat($id);
        echo $this->twig->render('backend/edit_cat.html.twig', [
            'results' => $results,
        ]);
    }

    function updatePost($postData, $image)
    {
        if (!$this->authenticationService->isConnected()) {
            header('Location: index.php?action=login');
        }

        $this->postService->editPost($postData, $image);
        header('Location: index.php?action=admin');
    }

    function updateCat($catData, $image)
    {
        if (!$this->authenticationService->isConnected()) {
            header('Location: index.php?action=login');
        }

        $this->catService->editCat($catData, $image);
        header('Location: index.php?action=edit_cat&id=' . $catData['id']);
    }

    function deletePost($id)
    {
        if (!$this->authenticationService->isConnected()) {
            header('Location: index.php?action=login');
        }
        $erase = $this->postManager->destroy($id);
        $posts = $this->postManager->getAllPostsAdmin();
        echo $this->twig->render('backend/backend.html.twig', [
            'posts' => $posts,
            'erase' => $erase,
        ]);

    }

    function listReportedComments()
    {
        if (!$this->authenticationService->isConnected()) {
            header('Location: index.php?action=login');
        }
        $reports = $this->commentManager->getReportedComments();
        echo $this->twig->render('backend/reported_comments.html.twig', [
            'reports' => $reports,
        ]);
    }

    function destroyReportedComment($id)
    {
        if (!$this->authenticationService->isConnected()) {
            header('Location: index.php?action=login');
        }
        $eraseReported = $this->commentManager->eraseReportedComment($id);
        if ($eraseReported === false) {
            //throw new Exception('Impossible de supprimer le commentaire !');
            echo 'error';
        } else {
            //header('Location: index.php?action=moderate');
            echo 'success';
        }
    }

    function listPostsAdmin()
    {
        if (!$this->authenticationService->isConnected()) {
            header('Location: index.php?action=login');
        }

        $nbComments = $this->commentManager->countReportedComments();
        $posts = $this->postManager->getAllPostsAdmin();
        
        echo $this->twig->render('backend/backend.html.twig', [
            'posts' => $posts,
            'nbComments' => $nbComments,
            
        ]);

    }

    function listComments()
    {
        if (!$this->authenticationService->isConnected()) {
            header('Location: index.php?action=login');
        }
        $commentsBack = $this->commentManager->getAllComments();
        echo $this->twig->render('backend/comments.html.twig', [
            'commentsBack' => $commentsBack,
        ]);
    }

    function addCat($catData, $image)
    {
        if (!$this->authenticationService->isConnected()) {
            header('Location: index.php?action=login');
        }

        $this->catService->addCat($catData, $image);
        header('Location: index.php?action=cat_register');
    }

    function eraseTheCat($id)
    {
        if (!$this->authenticationService->isConnected()) {
            header('Location: index.php?action=login');
        }
        $result = $this->catManager->eraseCat($id);
        echo $this->twig->render('backend/admin_cats.html.twig', [

        ]);
    }

    function admin_cats()
    {
        if (!$this->authenticationService->isConnected()) {
            header('Location: index.php?action=login');
        }
        echo $this->twig->render('backend/admin_cats.html.twig', [

        ]);
    }

    function formCat()
    {
        if (!$this->authenticationService->isConnected()) {
            header('Location: index.php?action=login');
        }
        echo $this->twig->render('backend/cat_form.html.twig', [

        ]);
    }

    function displayAllCatsBack()
    {
        if (!$this->authenticationService->isConnected()) {
            header('Location: index.php?action=login');
        }
        $allCats = $this->catManager->getAllCats();
        echo $this->twig->render('backend/display_cats.html.twig', [
            'allCats' => $allCats,
        ]);
    }

    function registerCats()
    {
        if (!$this->authenticationService->isConnected()) {
            header('Location: index.php?action=login');
        }
        $registerCats = $this->catManager->getAllCats();
        echo $this->twig->render('backend/cat_register.html.twig', [
            'registerCats' => $registerCats,
        ]);
    }

    function veterinarian()
    {
        if (!$this->authenticationService->isConnected()) {
            header('Location: index.php?action=login');
        }

        echo $this->twig->render('backend/veterinarian.html.twig', []);
    }

    function addVisit($date_visit, $cat_name, $gender, $age_category, $vet_name, $diagnostic, $treatment, $cost, $intervention)
    {
        if (!$this->authenticationService->isConnected()) {
            header('Location: index.php?action=login');
       }

        $visit = $this->catManager->visit($date_visit,$cat_name,$gender,$age_category,$vet_name,$diagnostic,$treatment,$cost,$intervention);
         header('Location: index.php?action=edit_veterinarian');
    }

    function editVisits()
    {
        if (!$this->authenticationService->isConnected()) {
            header('Location: index.php?action=login');
        }
        $allVisits = $this->catManager->getAllVisits();
        echo $this->twig->render('backend/list_visit_vet.html.twig', [
            'allVisits' => $allVisits,
        ]);
    }

    function addlitter()
        {
        if (!$this->authenticationService->isConnected()) {
            header('Location: index.php?action=login');
        }
        echo $this->twig->render('backend/litter.html.twig', []);
    }

    function litter($father, $mother, $litter_number, $mating_date, $parturition_date, $females_number, $males_number, $total_kittens, $general_observation, $parturition_observation, $gestation_observation)
    {
        if (!$this->authenticationService->isConnected()) {
            header('Location: index.php?action=login');
       }
        $litter= $this->catManager->litters($father,$mother,$litter_number, $mating_date,$parturition_date,$females_number,$males_number,$total_kittens,$general_observation,$parturition_observation,$gestation_observation);
        echo $this->twig->render('backend/admin_cats.html.twig', [
            'litter' => $litter,
        ]);
    }

    function editLitters()
    {
        if (!$this->authenticationService->isConnected()) {
            header('Location: index.php?action=login');
        }
        $allLitters = $this->catManager->getAllLitters();
        echo $this->twig->render('backend/list_litters.html.twig', [
            'allLitters' => $allLitters,
        ]);
    }

    function kittenDaily()
    {
        if (!$this->authenticationService->isConnected()) {
            header('Location: index.php?action=login');
        }

        echo $this->twig->render('backend/kittens.html.twig', []);
    }

    function addDailyObservation($cat_name, $weight, $daily_observation)
    {
        if (!$this->authenticationService->isConnected()) {
            header('Location: index.php?action=login');
       }

        $kittenDaily= $this->catManager->kittensDaily($cat_name,$weight,$daily_observation);
        header('Location: index.php?action=edit_observations');

        /* echo $this->twig->render('backend/admin_cats.html.twig', [
             'kittenDaily' => $kittenDaily,
         ]);*/
    }

    function editObservations()
    {
        if (!$this->authenticationService->isConnected()) {
            header('Location: index.php?action=login');
        }
        $allObservations = $this->catManager->getAllDailyObservations();
        echo $this->twig->render('backend/daily_observations.html.twig', [
            'allObservations' => $allObservations,
        ]);
    }

    function creditForm()
    {
        if (!$this->authenticationService->isConnected()) {
            header('Location: index.php?action=login');
        }

        echo $this->twig->render('backend/credit.html.twig', []);
    }

    function addCredit($date_credit, $item_credit, $cat_name, $amount_credit, $observation_credit)
    {
        if (!$this->authenticationService->isConnected()) {
            header('Location: index.php?action=login');
       }

        $credit= $this->catManager->addNewCredit($date_credit,$item_credit,$cat_name,$amount_credit,$observation_credit);
        header('Location: index.php?action=edit_credit');
    }

    function editCredit()
    {
        if (!$this->authenticationService->isConnected()) {
            header('Location: index.php?action=login');
        }
        $allCredits = $this->catManager->getAllCredits();
        $data = $this->catManager->totalCredits();
        $dataDebit = $this->catManager->totalDebits();
        echo $this->twig->render('backend/list_credit.html.twig', [
            'allCredits' => $allCredits,
            'data' => $data,
            'dataDebit' => $dataDebit,
        ]);
    }

    function debitForm()
    {
        if (!$this->authenticationService->isConnected()) {
            header('Location: index.php?action=login');
        }

        echo $this->twig->render('backend/debit.html.twig', []);
    }

    function addDebit($date_debit, $item_debit, $cat_name, $amount_debit, $observation_debit)
    {
        if (!$this->authenticationService->isConnected()) {
            header('Location: index.php?action=login');
       }

        $debit= $this->catManager->addNewDebit($date_debit,$item_debit,$cat_name,$amount_debit,$observation_debit);
        header('Location: index.php?action=edit_debit');
    }

    function editDebit()
    {
        if (!$this->authenticationService->isConnected()) {
            header('Location: index.php?action=login');
        }
        $allDebits = $this->catManager->getAllDebits();
        $data = $this->catManager->totalCredits();
        $dataDebit = $this->catManager->totalDebits();
        echo $this->twig->render('backend/list_debit.html.twig', [
            'allDebits' => $allDebits,
            'data' => $data,
            'dataDebit' => $dataDebit,
        ]);
    }

}    
