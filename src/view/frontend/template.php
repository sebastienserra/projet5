<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="fr" xml:lang="fr" xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
      <link rel="stylesheet" href="./public/css/style.css" />
      <script src="https://cdn.tiny.cloud/1/1h6q1zw7gu49iz626k87hrtqz797ot0daftt3rodji6oznhw/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
      <script> tinymce.init({selector: '#article'}); </script>
      <title><?= $title ?></title>
      <script src="https://kit.fontawesome.com/ab102256a4.js" crossorigin="anonymous"></script>

</head>

<body>
  <div id='#top'></div>
  <div id="nav_bar">
          <div id="query">
            <form action="index.php?action=query" method="post" name="search_form" id="search_form">
              <input type="text" name="search_query" id="search_query" placeholder="...">
              <button type="submit" name="submit_search" id="submit_search" value="Search"><i class="fas fa-search"></i></button>
            </form>
          </div>
          <div id="registration">
          <div id="signup">
            <button type="submit" name="signup" id="signup" value="Search"><a href="index.php?action=signup">Inscription</a></button>
          </div>
          <div id="signin">
          <button type="submit" name="signin" id="signin" value="Search"><a href="index.php?action=login">Connection</a></button>
          </div>
          </div>

    <div class="navigation">


      <label for="hamburger"><span class="fas fa-bars"></span></label>
      <input type="checkbox" id="hamburger">
      <nav>
        <ul>
          <li><a href="index.php">Accueil</a></li>
          <li><a href="index.php?action=all_maine_coons">Les Chats</a></li>
          <li><a href="index.php?action=blog">Le Blog</a></li>
          <li><a href="index.php?action=contact">Contact</a></li>
        </ul>
        </nav>
      </div>
    </div>
        <?= $content ?>

 		  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
          <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
          <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
          <script src="./public/js/slide.js"></script>
          <script src="./public/js/main.js"></script>
          <script src="./public/js/request.js"></script>
          
         
<footer>
	<div><a href="index.php">Accueil</a></div>
	<div><a href="index.php?action=blog">Blog</a></div>
	<div><a href="index.php?action=contact">Contact</a></div>	
  <div><a href="index.php?action=admin">Admin</a></div>
	<div><a href="index.php?action=login">Interface d'administration</a></div>
	<div></div>
	<div>Tous droits réservés - Auteur: Jean Forteroche</div>
</footer>
</body>
</html>