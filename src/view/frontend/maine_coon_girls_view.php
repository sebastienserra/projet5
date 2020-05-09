<?php $title = 'Maine Coons femelles'; ?>

<?php ob_start(); ?>
<div class="content_size">
	<div id="top"></div>
<?php
while($data= $req->fetch(PDO::FETCH_ASSOC)) {


			?>
		<div>	
			<div id="cat_presentation">
			<div id="cat_picture"><img src="./uploads/<?php echo $data['image'];?>"></div>
			<div id="cat_info">
				<p><span class="info_title">Prénom:</span><?php echo $data['name'];?></p>
				<p><span class="info_title">Sexe:</span><?php echo $data['gender'];?></p>
				<p><span class="info_title">Robe:</span><?php echo $data['coat_color'];?></p>
				<p><span class="info_title">Date de naissance:</span><?php echo $data['dob'];?></p>
				<p><span class="info_title">Description:</span><?php echo $data['description'];?></p>
			</div>
		</div>
		<?php
		}
		?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>