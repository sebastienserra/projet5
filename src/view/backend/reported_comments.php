<?php $title = 'Modération des commentaires'; ?>

<?php ob_start(); ?>
<div class="content_size">
	<div id="top"></div>
	<div class="present_titles">
	<?php
	while ($donnees = $report->fetch()){
		?>
		<div class="present"> 
			<div class="text_back"> <?php echo htmlspecialchars($donnees['comment']);?></div> 
			<div class="together">
			<div class="button_three_back">
				<a href="index.php?action=moderateComment&amp;id=<?php echo $donnees['id'] ?>" id="control_five">
					<span class="fas fa-trash-alt"></span>
					<span id="tooltip_five">Supprimer</span>
				</a>
			</div>
			</div>
		</div>
		<?php
		}

	?>
</div>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('template_backend.php'); ?>