<?php

require_once __DIR__ . '/vendor/autoload.php';

use Projet5\Controller\BackendController;
use Projet5\Controller\FrontendController;
use Projet5\service\AuthentificationService;
use Twig\Environment;
use Twig\Extra\String\StringExtension;
use Twig\Loader\FilesystemLoader;

/* INIT Twig*/
$loader = new FilesystemLoader(__DIR__ . '/src/view');
$twig = new Environment($loader, ['cache' => false]);
$twig->addExtension(new StringExtension());

/* Controller as class */
$frontendController = new FrontendController($twig);
$backendController = new BackendController($twig);

session_start();

try {
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'home_view') {
            $frontendController->home();
        } elseif ($_GET['action'] == 'postandcomments') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $frontendController->post();
            } else {
                // Erreur ! On arrête tout, on envoie une exception, donc au saute directement au catch
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        } elseif ($_GET['action'] == 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $frontendController->addComment($_POST['comment'], $_GET['id']);
            } else {
                // Erreur ! On arrête tout, on envoie une exception, donc au saute directement au catch
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        } elseif ($_GET['action'] == 'blog') {
            $frontendController->blog();
        } elseif ($_GET['action'] == 'my_first_maine_coon') {
            $frontendController->postsByCategory('my_first_maine_coon');
        } elseif ($_GET['action'] == 'health') {
            $frontendController->postsByCategory('health');
        } elseif ($_GET['action'] == 'daily') {
            $frontendController->postsByCategory('daily');
        } elseif ($_GET['action'] == 'education') {
            $frontendController->postsByCategory('education');
        } elseif ($_GET['action'] == 'contact') {
            $frontendController->contact();
        } elseif ($_GET['action'] == 'message') {
            $frontendController->message($_POST['object_message'], $_POST['first_name'],$_POST['last_name'], $_POST['email'], $_POST['message_text']);
        } elseif ($_GET['action'] == 'query') {
            $frontendController->query();
        } elseif ($_GET['action'] == 'all_maine_coons') {
            $frontendController->displayAllMaineCoons();
        } elseif ($_GET['action'] == 'search_by_coat') {
            $frontendController->displayCatsByCoat();
        } elseif ($_GET['action'] == 'maine_coon_boys') {
            $frontendController->displayAllBoys();
        } elseif ($_GET['action'] == 'maine_coon_girls') {
            $frontendController->displayAllGirls();
        } elseif ($_GET['action'] == 'maine_coon_kittens') {
            $frontendController->displayAllKittens();
        } elseif ($_GET['action'] == 'maine_coon_youngsters') {
            $frontendController->displayAllYoungsters();
        } elseif ($_GET['action'] == 'login') {
            $frontendController->login();
        } elseif ($_GET['action'] == 'signup') {
            $frontendController->signup();
        } elseif ($_GET['action'] == 'getCatByCoat') {
            $frontendController->getCatByCoat($_GET['coat']);
        } elseif ($_GET['action'] == 'register') {
            $frontendController->register($_POST['email'], $_POST['password']);
        } elseif ($_GET['action'] == 'connect') {
            $frontendController->connect($_POST['email'], $_POST['password']);
            //$frontendController->connectUser($_POST['email'], $_POST['password']);
        } elseif ($_GET['action'] == 'update_cat') {
            $backendController->updateCat($_POST, $_FILES['monfichier']);
        } elseif ($_GET['action'] == 'update') {
            $backendController->updatePost($_POST, $_FILES['myfile']);
        } elseif ($_GET['action'] == 'moderate') {
            $backendController->listReportedComments();
        } elseif ($_GET['action'] == 'reportComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $frontendController->reportComment($_GET['id']);
            }
        } elseif ($_GET['action'] == 'edit') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $backendController->editPost($_GET['id']);
            }
        } elseif ($_GET['action'] == 'comments') {
            $backendController->listComments();
        } elseif ($_GET['action'] == 'articles') {
            titlesList();
        } elseif ($_GET['action'] == 'admin') {
            $backendController->listPostsAdmin();
        } elseif ($_GET['action'] == 'admin_cats') {
            $backendController->admin_cats();
        } elseif ($_GET['action'] == 'display_cats') {
            $backendController->displayAllCatsBack();
        } elseif ($_GET['action'] == 'cat_register') {
            $backendController->registerCats();
        } elseif ($_GET['action'] == 'add_veterinarian') {
            $backendController->veterinarian();
        } elseif ($_GET['action'] == 'save_cat_data') {
            $backendController->addCat($_POST, $_FILES['monfichier']);
        } elseif ($_GET['action'] == 'veterinarian') {
            $backendController->addVisit($_POST['date_visit'], $_POST['cat_name'],$_POST['gender'], $_POST['age_category'], $_POST['vet_name'], $_POST['diagnostic'], $_POST['treatment'], $_POST['cost'], $_POST['intervention']);
        } elseif ($_GET['action'] == 'edit_veterinarian') {
            $backendController->editVisits();
        } elseif ($_GET['action'] == 'cat_form') {
            $backendController->formCat();
        } elseif ($_GET['action'] == 'add_litter') {
            $backendController->addLitter(); 
        } elseif ($_GET['action'] == 'litter') {
            $backendController->litter($_POST['father'], $_POST['mother'],$_POST['litter_number'], $_POST['mating_date'], $_POST['parturition_date'], $_POST['females_number'], $_POST['males_number'], $_POST['total_kittens'], $_POST['general_observation'], $_POST['parturition_observation'], $_POST['gestation_observation']);
        } elseif ($_GET['action'] == 'cat_litters') {
            $backendController->editLitters();  
        } elseif ($_GET['action'] == 'kitten_daily') {
            $backendController->kittenDaily(); 
        } elseif ($_GET['action'] == 'edit_observations') {
            $backendController->editObservations();
        } elseif ($_GET['action'] == 'daily_followup') {
            $backendController->addDailyObservation($_POST['cat_name'], $_POST['weight'],$_POST['daily_observation']);
        } elseif ($_GET['action'] == 'edit_cat') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $backendController->editCat($_GET['id']);
            }
        } elseif ($_GET['action'] == 'addPost') {
            $backendController->addPost($_POST, $_FILES['myfile']);
        } elseif ($_GET['action'] == 'deletePost') {
            $backendController->deletePost($_GET['id']);
        } elseif ($_GET['action'] == 'erase_cat') {
            $backendController->eraseTheCat($_GET['id']);
        } elseif ($_GET['action'] == 'moderateComment') {
            $backendController->destroyReportedComment($_GET['id']);
        } elseif ($_GET['action'] == 'add_credit') {
            $backendController->creditForm();
        } elseif ($_GET['action'] == 'add_debit') {
            $backendController->debitForm();
        } elseif ($_GET['action'] == 'new_credit') {
            $backendController->addCredit($_POST['date_credit'], $_POST['item_credit'],$_POST['cat_name'],$_POST['amount_credit'],$_POST['observation_credit']);
                } elseif ($_GET['action'] == 'new_debit') {
            $backendController->addDebit($_POST['date_debit'], $_POST['item_debit'],$_POST['cat_name'],$_POST['amount_debit'],$_POST['observation_debit']);
        } elseif ($_GET['action'] == 'edit_credit') {
            $backendController->editCredit();
        } elseif ($_GET['action'] == 'edit_debit') {
            $backendController->editDebit();
        } elseif ($_GET['action'] == 'edit_total_debit') {
            $backendController->editTotalDebit();
        }      
    } else {
        $frontendController->home();
    }
} catch (Exception $e) { // S'il y a eu une erreur, alors...
    echo 'Erreur : ' . $e->getMessage();
}
