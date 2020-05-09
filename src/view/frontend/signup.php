<?php $title = 'S inscire'; ?>

<?php ob_start(); ?>
<div id="login_image"></div>

	<form action="index.php?action=register" method="post" id="login_form">
		<h2>Inscrivez vous</h2> 
  		<input type="text" name="email" id="email" size="17" maxlength="30" placeholder="email">
		<input type="password" name="password" id="password" size="17" maxlength="30" placeholder="mot de passe">
		<button type="submit" name="login-submit" value="valider">valider</button>
    </form>    
    
</div>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>