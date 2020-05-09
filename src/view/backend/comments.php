<?php $title = 'Commentaires'; ?>

<?php ob_start(); ?>

<div class="content_size">
	<div id="top"></div>
	<div class="present_titles">
		<?php
	while ($donnees = $commentsBack->fetch(PDO::FETCH_ASSOC))
		{
		?>
		<div class="present">
   			 <div><?php echo htmlspecialchars($donnees['comment']); ?></div>
		</div>
		<?php
		}
		?>
</div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('template_backend.php'); ?>