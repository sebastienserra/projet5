<?php $title = 'Article'; ?>

<?php ob_start(); ?>
<div class="content_size">
  <div id="top"></div>
<div class="page_post">

  <div class="block_post">

    <div class="post">

            <div class="present_post">
              <?php
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
    </div>
    <div class="comment_form">
        <h4>Laisser un commentaire: </h4>  
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

    </div>
    <div>
      
      <div>
        <div>
<?php
      while ($donnees = $comments->fetch(PDO::FETCH_ASSOC))
    {
    ?>
    <div class="comments_display">
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
</div>
    </div>
  </div>
  <div id="listing_post">
    <div id="last_publications_post"><div class="header_title_post">Articles récents</div>
      <div class="title_listing_post">
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
    <div id="popular_publications_post"> <div class="header_title_post">Articles populaires</div>
      <div class="title_listing_post">
        <?php
  while($row= $popularity->fetch(PDO::FETCH_ASSOC)) {
      ?>
      <div> -   
      <a href="index.php?action=postandcomments&amp;id=<?= $row['id'] ?>"><?php echo $row['title'];?></a>
      </div>  
      <?php
      } 
      ?>
      </div>
    </div>
  </div>
</div>

    </div>
</div>
  <?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>