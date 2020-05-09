<?php $title = 'Login'; ?>

<?php ob_start(); ?>
<div id="login_image"></div>

	<form action="index.php?action=connect" method="post" id="login_form">
		<h2>Connectez vous</h2> 
  		<input type="text" name="email" id="email" size="17" maxlength="30" placeholder="identifiant">
		<input type="password" name="password" id="password" size="17" maxlength="30" placeholder="mot de passe">
		<button type="submit" name="login-submit" value="valider">valider</button>
    </form>    
    
</div>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>