
<?php $title = 'Resultats de recherche'; ?>

<?php ob_start(); ?>
<div class="content_size">
	<div id="top"></div>
	<?php
	while($row= $req->fetch(PDO::FETCH_ASSOC)){
	echo'<div>Titre: '.$row ['title'].'</div>';
    echo'<div>Article: '.$row ['article'].'<div>';
    echo'<hr>';
    } 
    ?>
    </div>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>