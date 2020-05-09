
<?php $title = 'Articles'; ?>

<?php ob_start(); ?>
<div class="content_size">
	<div id="top"></div>
	<div class="present_titles">
	<h4>Titres des articles:</h4>
	<?php
	while($row= $byTitle->fetch(PDO::FETCH_ASSOC)) {
			?>
			<div> - 	
			<a href="index.php?action=postandcomments&amp;id=<?= $row['id'] ?>"><?php echo $row['title'];?></a>
			</div>	
			<?php
			}	
			?>
</div>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>