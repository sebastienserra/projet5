<?php $title = 'Interface d administration'; ?>
<?php ob_start(); ?>
<div class="content_size">
	<div id="top"></div>
<?php
if(isset($_SESSION['username'])){

  echo '<div id="welcome_message">Bienvenue ' .$_SESSION['username']. '!</div>';

}else{

    echo '<div id="welcome_message">Vous n etes pas connecte</div>';

}
?>

<table border=1>
		<?php
			while($row= $posts->fetch(PDO::FETCH_ASSOC)) {
			?>		
			<div class="present">
				<div class="text_back"><?php echo $row['title'];?></div>
				<div class="text_back"><?php echo $row['category'];?></div>
				<div class="text_back"><?php echo $row['article'];?></div>
				<div class="text_back"><?php echo $row['author'];?></div>
				<div class="together">
					<div class="button_one_back">
						<a href="index.php?action=deletePost&amp;id=<?php echo $row['id'];?>" id="confirmation">
			   				<span class="fas fa-trash-alt"></span>
			   				<span id="tooltip_three">Supprimer</span>
			   			</a>
					</div>
					<div class="button_two_back">
						<a href="index.php?action=edit&amp;id=<?php echo $row['id'];?>" id="control_four">
			   				<span class="fas fa-edit"></span>
			   				<span id="tooltip_four">Modifier</span>
			   			</a>
					</div>
				</div>
			</div>	
			<?php
			}
			?>
<div class="id_comment"> 
	<a href="index.php?action=moderate">Modérer les commentaires (<?php $commentManager = new \Sebastien\Blog\Model\CommentManager();
    echo $nb_comments = $commentManager->countReportedComments(); ?>)</a>
</div>
<form action="index.php?action=addPost" method="post"> 
	<div id="edit_block">

		<input type="text" name="title" id="title" rows="1" cols="50" maxlength="250" placeholder="Titre">
		<input type="text" name="category" id="category" rows="1" cols="50" maxlength="250" placeholder="Category">
		<textarea name="article" id="article"  rows="10" cols="50" maxlength="250" placeholder="Ecrivez vos articles ici.">
			
		</textarea>
		<input type="text" name="author" id="author" rows="1" cols="50" maxlength="250" placeholder="Auteur">
	</div>

	<p>
		<input class="btn btn-primary" name="button_form" id="button_form" type="submit" value="Envoi">
	</p>
</form>

</div>

<?php $content = ob_get_clean(); ?>

<?php require('template_backend.php'); ?>