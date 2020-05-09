<?php $title = 'Modifications'; ?>

<?php ob_start(); ?>
<div class="content_size">
<div id="top"></div>
<?php
	while ($donnees = $result->fetch(PDO::FETCH_ASSOC))
		{
			?>
<form action="index.php?action=update" method="post" id="edit_form">
	<p>
		<input type="hidden" name="id" id="id" value="<?php echo $_GET['id']; ?>">
	</p>
	<p> 
		<input type="text" name="title" id="title" rows="1" cols="50" maxlength="250" value="<?php echo $donnees['title'];?>"/>
		<input type="text" name="category" id="category" rows="1" cols="50" maxlength="250" value="<?php echo $donnees['category'];?>"/>

		<textarea name="article" id="article"  rows="10" cols="50" maxlength="250">
			<?php echo $donnees['article'];?>			
		</textarea>
		<input type="text" name="author" id="author" rows="1" cols="50" maxlength="250" value="<?php echo $donnees['author'];?>"/>
		<input class="btn btn-primary" type="submit" name="update" value="Update"/>
	</p>
</form>
<?php 
}
?>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('template_backend.php'); ?>