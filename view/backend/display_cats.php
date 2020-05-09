<?php $title = 'Presnetation des chats'; ?>

<?php ob_start(); ?>
<div class="content_size">
	<div id="top"></div>
	    <table>  
	    <tr>
        <th>Update</th>
        <th>Erase</th>
        <th>Picture</th>
        <th>Name</th>
        <th>Breeder</th>
        <th>D.O.B</th>
        <th>Gender</th>
        <th>Coat color</th>
        <th>Hair type</th>
        <th>Tabby marking</th>
        <th>Eye coloration</th>
        <th>Pattern of coat</th>
        <th>Breed</th>
        <th>Status</th>
        <th>Cat shows</th>
        <th>Location</th>
        <th>Identification</th>
        <th>Description</th>
        <th>Age category</th>
      </tr>
      <?php
			while($data= $req->fetch(PDO::FETCH_ASSOC)) {
		?>
	

      <tr>
        <td>
          <a href="index.php?action=edit_cat&amp;id=<?php echo $data['id'];?>" id="control_four">
            <span class="fas fa-edit"></span>
            <span id="tooltip_four">Modifier</span>
          </a>
        </td>
        <td>
          <a href="index.php?action=erase_cat&amp;id=<?php echo $data['id'];?>" id="confirmation">
            <span class="fas fa-trash-alt"></span>
            <span id="tooltip_three">Supprimer</span>
          </a>
        </td>
        <td>
          <img src="./uploads/<?php echo $data['image'];?>" class="mini_picture_of_cat" />
        </td>
        <td><?php echo $data['name'];?></td>
        <td><?php echo $data['breeder'];?></td>
        <td><?php echo $data['dob'];?></td>
        <td><?php echo $data['gender'];?></td>
        <td><?php echo $data['coat_color'];?></td>
        <td><?php echo $data['hair_type'];?></td>
        <td><?php echo $data['tabby_marking'];?></td>
        <td><?php echo $data['eye_coloration'];?></td>
        <td><?php echo $data['pattern_of_coat'];?></td>
        <td><?php echo $data['breed'];?></td>
        <td><?php echo $data['status'];?></td>
        <td><?php echo $data['cat_shows'];?></td>
        <td><?php echo $data['location'];?></td>
        <td><?php echo $data['identification'];?></td>
        <td><?php echo $data['description'];?></td>
        <td><?php echo $data['age_category'];?></td>

		<?php
		}
		?>
		      </tr>
    </table>
</div>
</div>
    
<?php $content = ob_get_clean(); ?>

<?php require('template_backend.php'); ?>