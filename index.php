<?php

require('./controller/controller.php');

try { // On essaie de faire des choses
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'home_view') {
            home();
        }
        elseif ($_GET['action'] == 'postandcomments') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                post();
            }
            else {
                // Erreur ! On arrête tout, on envoie une exception, donc au saute directement au catch
                throw new Exception('Aucun identifiant de billet envoyé');
                }
        }
        elseif ($_GET['action'] == 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                addComment($_POST['comment'], $_GET['id']);
            }
            else {
                // Erreur ! On arrête tout, on envoie une exception, donc au saute directement au catch
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
        elseif ($_GET['action'] == 'blog') {
                    blog();
                }
        elseif ($_GET['action'] == 'contact') {
                    contact();
                }
        elseif ($_GET['action'] == 'query') {
                    query();
                }                
        elseif ($_GET['action'] == 'all_maine_coons') {
                   displayAllMaineCoons();
                }
        elseif ($_GET['action'] == 'search_by_coat') {
                   displayCatsByCoat();
                }                
        elseif ($_GET['action'] == 'maine_coon_boys') {
                   displayAllBoys();
                }
        elseif ($_GET['action'] == 'maine_coon_girls') {
                   displayAllGirls();
                }
        elseif ($_GET['action'] == 'maine_coon_kittens') {
                    displayAllKittens();
                }
        elseif ($_GET['action'] == 'maine_coon_youngsters') {
                    displayAllYoungsters();
                }                
        elseif ($_GET['action'] == 'login') {
                    login();
                 }
        elseif ($_GET['action'] == 'signup') {
                    signup();
                }  
        elseif ($_GET['action'] == 'register') {
                    register();
                }                
        elseif ($_GET['action'] == 'connect') {
                     connect(); 
        } 
        elseif ($_GET['action'] == 'update_cat') {
                updateCat($_POST['id'],$_POST['name'],$_POST['breeder'],$_POST['gender'],$_POST['dob'],$_POST['coat_color'],$_POST['hair_type'],$_POST['tabby_marking'],$_POST['eye_coloration'],$_POST['pattern_of_coat'],$_POST['breed'],$_POST['status'],$_POST['cat_shows'],$_POST['location'],$_POST['identification'],$_FILES['monfichier']['name'],$_POST['description']);
        }
        elseif ($_GET['action'] == 'update') {
                updatePost($_POST['category'],$_POST['article'],$_POST['title'],$_POST['author'],$_POST['id']);
                
            }  
        elseif ($_GET['action'] == 'moderate') {
                listReportedComments();
                
            }
        elseif ($_GET['action'] == 'login_error') {
                loginError();  
            }
        elseif ($_GET['action'] == 'reportComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                getReportedComment($_GET['id']);
                }
            }
        elseif ($_GET['action'] == 'edit') {
             if (isset($_GET['id']) && $_GET['id'] > 0) {
                    editPost($_GET['id']);
                }
            }
        elseif ($_GET['action'] == 'comments') {
                    listComments();
                }
        elseif ($_GET['action'] == 'articles') {
                    titlesList();
                }
        elseif ($_GET['action'] == 'admin') {
                    listPostsAdmin();
                }
        elseif ($_GET['action'] == 'admin_cats') {
                    admin_cats();
                }
        elseif ($_GET['action'] == 'display_cats') {
                    displayAllCatsBack();
                }
        elseif ($_GET['action'] == 'save_cat_data') {
                    addCat();
                }
        elseif ($_GET['action'] == 'edit_cat') {
             if (isset($_GET['id']) && $_GET['id'] > 0) {
                    editCat($_GET['id']);
                }
            }
        elseif ($_GET['action'] == 'addPost') {
                if (!empty($_POST['article'])) {
                    addPost($_POST['article'], $_POST['title'], $_POST['author'], $_POST['category']);
                }
            }
        elseif ($_GET['action'] == 'deletePost') {
                    deletePost($_GET['id']);   
                }
        elseif ($_GET['action'] == 'erase_cat') {
                    eraseTheCat($_GET['id']);   
                }
        elseif ($_GET['action'] == 'moderateComment') {
                    destroyReportedComment($_GET['id']);   
                }
            }    
            
    else {
        home();
    }
}
catch(Exception $e) { // S'il y a eu une erreur, alors...
    echo 'Erreur : ' . $e->getMessage();
}
