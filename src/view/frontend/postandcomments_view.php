<?php $title = 'Post et commentaires'; ?>

<?php ob_start(); ?>
<div class="present_art_and_comments">
	<h2>Article</h2>
<div class="present"><?php
	while ($donnees = $post->fetch(PDO::FETCH_ASSOC))
		{
			?>
   		 <p><h4><?php echo $donnees['title']; ?></h4></p>
   		 <p><?php echo $donnees['article']; ?></p>
        <p>
        <?php 
   		  $timestamp = strtotime($donnees['creation_date']); 
   		  $my_date = date('d/m/Y', $timestamp);
   		  echo $donnees['author'].' le '. $my_date;
   		  ?>
          
        </p>
   		  <?php
   		  }
   		  ?>

   		  
   		</div>
   <h3>Votre commentaire: </h3>  

   <?php
   $fullUrl= "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; 
   if (strpos($fullUrl,"action=posterror") == true) {
     echo'<div class="error">Laisser un commentaire!</div>';
   }
   elseif(strpos($fullUrl,"action=postsuccess")==true){
    echo '<div class="success">Commentaire ajouté avec succès!</div>';
   }

   ?>
  <form action="index.php?action=addComment&amp;id=<?php echo $_GET['id'] ?>" method="post" id="form_comments">

    <div class="form-group">
    <p>
      <textarea name="comment" id="comment" class="form-control" rows="3" cols="40" maxlength="250" placeholder="Laisser un commentaire.">
      </textarea>
    </p>
    </div>
    <p>
      <input class="btn btn-primary" name="button_comment" id="button_comment" type="submit" value="Envoi">
    </p>
  </form>

   	<h2 id="commentaires">Commentaires associés</h2>
<?php
   		while ($donnees = $comments->fetch(PDO::FETCH_ASSOC))
		{
		?>
		<div class="present">
   			 <div><?php echo htmlspecialchars($donnees['comment']); ?></div>
   			 <div class="together">
			 	<div class="button_five_front">
    		 		<a href="index.php?action=reportComment&amp;id=<?php echo $donnees['id']; ?>&comment=<?php echo $donnees['id_post']; ?>" name="report", id="report">
    		 			<span class="fas fa-comment-slash"></span>
    		 			<span id="tooltip_six">Signaler</span>
    		 		</a>
				</div>
			</div>
		</div>
		<?php
		}

?>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>