<?php $title = 'Accueil'; ?>

<?php ob_start(); ?>
<div class="group">
<div id="container">

    <div class="semicircle">
      <div class="semicircleleft">
        <div class="leftarrow">
        </div> 
      </div>
    </div>
  
  <div>
        <img id="diapo" src="./public/images/kitten_img1.jpg" alt="diaporama">
  </div>

  <div class="semicircle">
    <div class="semicircleright">
      <div class="rightarrow">
      </div>
    </div>
  </div>


<div id="pause_inside">
  <div class="push" id="btn_pause">
  </div>
</div>

<div id="play_inside">
  <div class="push" id="btn_play">
  </div>
  </div>

<div id="texte_diaporama">
</div>
</div>

    
<div class="cards">
  <div>
  <h1>Elevage des Pompons</h1>
</div>
   <div id="image_index_cards">
      <div>
      <h3 id="subtitle_index">Posts récents</h3>
      <div class="button_blog">
            <a href="index.php?action=blog">
            Blog
            </a>
        </div>
    </div>
      <div id="joint">
    <?php
    
 while($row= $articles->fetch(PDO::FETCH_ASSOC)) {
            $result=$row['article'];
            $string=strip_tags($result);
            $limit=120;     
                    ?>  
            <div class="joint">
                <div class="my_container">
                    <div class="my_text"><?php $postManager = new \Sebastien\Blog\Model\PostManager(); echo $string = $postManager->finishOnWord($string, $limit, $stop=" "); ?> ...</div>
                    <div class="my_buttons">
                        <div class="button_three">
                            <a href="index.php?action=postandcomments&amp;id=<?php echo $row['id'];?>">
                            Lire
                            </a>
                        </div>
                    </div>  
                </div>
                <div class="bellow"></div>
            </div>
            <?php
            }
            ?>
        </div>
            <div class="link">
                <p>  
                <?php 
                for($page=1;$page<=$nber_of_pages; $page++){
                
                  echo '<div class="pagination_link"><a href="./index.php?page='.$page.'"> ' . $page . '</a></div>';
                }
                ?> 
                </p>
            </div>
            <?php
            //}

    ?>
     </div>

      </div>
        <div id="block_pictures">
         <a href="index.php?action=maine_coon_boys"><div id="picture_one"><div class="describe">Les garçons</div></div></a>
            <div>
             <a href="index.php?action=maine_coon_girls"><div id="picture_two"><div class="describe">Les filles</div></div></a>
              <div id="sub_block_pictures">
                <a href="index.php?action=maine_coon_kittens"><div id="picture_three"><div class="describe">Les chattons</div></div></a>
                <a href="index.php?action=maine_coon_youngsters"><div id="picture_four"><div class="describe">Les ados</div></div></a>
              </div>
            </div>
          </div>


    </div>


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>