<?php $title = 'Contact'; ?>

<?php ob_start(); ?>
<div class="content_size">
	<div id="top"></div>
	<div class="present_titles">
	<h4>Contacter moi:</h4>
	<div>
		<div>Jean Forteroche</div>
		<div><a href="#"> j.forteroche@gmail.com</a></div>
	</div>

	

</div>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>