<?php $title = 'Recherche par couleur de robe'; ?>

<?php ob_start(); ?>
<div class="content_size">
	<div id="top"></div>
 	<div id="filter">Trouver un Maine Coon avec la robe qui vous plaît:
		<div id="wrapper">
		<form method="post" class="display">
			 <select id="coats" name="coats">
				<?php 
				while($coat_color= $req->fetch(PDO::FETCH_ASSOC)) {

					echo'<option id="'.$coat_color['id'].'"" value="'.$coat_color['coat_color'].'"">'.$coat_color['coat_color'].'</option>';
				}
				?>
			</select>
		</form>
		</div>
	</div> 
<div id="present_results">Les résultats seront présentés ici.</div>
</div>
	</div>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>