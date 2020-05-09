<?php $title = 'Interface d administration'; ?>
<?php ob_start(); ?>
<div class="content_size">
  <div id="top"></div>
  <div><a href="index.php?action=display_cats"> voir tous les chats</a></div>


<form action="index.php?action=save_cat_data" method="post" enctype="multipart/form-data" id="cat_form">
<h2>Formulaire insertion chat en base de donnees:</h2>
			<fieldset> 
		   <legend>Données concernant le chat</legend>
		   
		    <div class="contain">
		   		<div>
		   			<label>First Name</label>
		   		</div>
		   		<div>
		   			<input type="text" name="name" id="name" size="13" maxlength="13" placeholder="Name" autofocus/>
				</div>
			</div>

			<div class="contain">
		   		<div>
		   			<label>Breeder</label>
		   		</div>
		   		<div>
		   			<input type="text" name="breeder" id="breeder" size="13" maxlength="13" placeholder="Breeder" autofocus/>
				</div>
			</div>

			<div class="contain">
		   		<div>
		   			<label for="gender">Gender
		   			</label>
		   		</div>
       			<div>
       				<select name="gender" id="gender">
           				<option value="male">Male</option>
           				<option value="female">Female</option>
        			</select>
    			</div>
        	</div>

        	<div class="contain">
        		<div>
        			<label> D.O.B</label>
        		</div>
        		<div>
        			<input type="date" name="dob" id="dob" size="13" maxlength="13" placeholder="YYYY/MM/DD">
        		</div>
        	</div>

          <div class="contain"> 
            <div> 
              <label for="age_category">Age category
              </label>
            </div>
            <div>
              <select name="age_category" id="age_category">
                  <option value="adultef">Adultef</option>
                  <option value="adultem">Adultem</option>
                  <option value="youngster">Youngster</option>
                  <option value="kitten">Kitten</option>
              </select>
          </div>
        </div>

        	<div class="contain">	
        		<div>	
        			<label for="coat">Coat color
        			</label>
        		</div>
        		<div>
        			<select name="coat" id="coat">
           				<option value="black">Black</option>
           				<option value="silver">Silver</option>
           				<option value="red">Red</option>
           				<option value="white">White</option>
           				<option value="blue">Blue</option>
           				<option value="brown">Brown</option>
           				<option value="blue">Smoke</option>
           				<option value="fawn">Fawn</option>
           				<option value="cinnamon">Cinnamon</option>
           				<option value="lilac">Lilac</option>
           				<option value="cream">Cream</option>
        			</select>
    			</div>
    		</div>
        	<div class="contain">
    			<div>
		   			<label for="hair_type">Hair type
		   			</label>
		   		</div>
       			<div>
       				<select name="hair_type" id="hair_type">
           				<option value="long">Long-haired</option>
           				<option value="short">Short-haired</option>
           				<option value="hairless">Hairless</option>
           			</select>
    			</div>
        	</div>
        	<div class="contain">
    			<div>
		   			<label for="tabby_marking">Tabby coat marking
		   			</label>
		   		</div>
       			<div>
       				<select name="tabby_marking" id="tabby_marking">
           				<option value="mackeral">Mackeral</option>
           				<option value="classic">Classic</option>
           				<option value="spotted">Spotted</option>
           				<option value="ticked">Ticked</option>
           				<option value="no_tabby">none</option>
           			</select>
    			</div>
        	</div>
        	<div class="contain">
    			<div>
		   			<label for="eye_coloration">Eye coloration
		   			</label>
		   		</div>
       			<div>
       				<select name="eye_coloration" id="eye_coloration">
           				<option value="brown">Brown</option>
           				<option value="gold">Gold</option>
           				<option value="hazel">Hazel</option>
           				<option value="green">Green</option>
           				<option value="blue">Blue</option>

           			</select>
    			</div>
        	</div>

    		<div class="contain">
    			<div>
		   			<label for="pattern">Pattern of coat
		   			</label>
		   		</div>
       			<div>
       				<select name="pattern" id="pattern">
           				<option value="solid">Solid</option>
           				<option value="tabby">Tabby</option>
           				<option value="colourpoint">Colour point</option>
           				<option value="bicolor">Bicolor</option>
           				<option value="tortoise">Tortoise</option>
        			</select>
    			</div>
        	</div>

        	<div class="contain">
        		<div>
    				<label for="breed">Breed
        			</label>
        		</div>
        		<div>
        			<select name="breed" id="breed">
           				<option value="maine_coon">Maine Coon</option>
           				<option value="siamese">Siamese</option>
           				<option value="persian">Persian</option>
           				<option value="ragdoll">Ragdoll</option>
           				<option value="bengal">Bengal</option>
           				<option value="birman">Birman</option>
           				<option value="sphynx">Sphynx</option>
           				<option value="chartreux">Chartreux</option>
           				<option value="british_shorthair">British Shorthair</option>
        			</select>
    			</div>
    		</div>

    		<div class="contain">
    			<div>
    				<label for="status">Status
        			</label>
        		</div>
        		<div>
        			<select name="status" id="status">
           				<option value="breeder">Breeder</option>
           				<option value="sterelized">Sterelized</option>
        			</select>
    			</div>
    		</div>

    		<div class="contain">
    			<div>
    				<label for="cat_shows">Cat shows
        			</label>
        		</div>
        		<div>
        			<select name="cat_shows" id="cat_shows">
           				<option value="yes">Yes</option>
           				<option value="no">No</option>
        			</select>
    			</div>
    		</div>

    		<div class="contain">
    			<div>
    		    	<label for="show">Location
        			</label>
        		</div>
        		<div>
    				<select name="pays" id="pays">
			           <option value="france">France</option>
			           <option value="espagne">Espagne</option>
			           <option value="allemagne">Allemagne</option>
			           <option value="italie">Italie</option>
			           <option value="irlande">Irlande</option>
			           <option value="suede">Suede</option>
			           <option value="autriche">Autriche</option>
			           <option value="pays_bas">Pays Bas</option>
			           <option value="bulgarie">Bulgarie</option>
			           <option value="danemark">Estonie</option>
			           <option value="lettonie">Lettonie</option>
			           <option value="littuanie">Lituanie</option>
			           <option value="pologne">Pologne</option>
			           <option value="slovaquie">Slovaquie</option>
			           <option value="roumanie">Roumanie</option>
			           <option value="chypre">Chypre</option>
			           <option value="malte">Malte</option>
			           <option value="grece">Grece</option>
			           <option value="luxembourg">Luxembourg</option>
			           <option value="slovenie">Slovenie</option>
			           <option value="croatie">Croatie</option>
			           <option value="hongrie">Hongrie</option>
			           <option value="norvege">Norvege</option>
			           <option value="royaume-uni">Royaume-Uni</option>
			           <option value="portugal">Portugal</option>
			           <option value="belgique">Belgique</option>
			           <option value="canada">Canada</option>
			           <option value="etats-unis">États-Unis</option>
			           <option value="chine">Chine</option>
			           <option value="japon">Japon</option>
			       </select>
    			</div>
    		</div>

    		<div class="contain">
    			<div>
    				<label for="identificaiton">Identification number
        			</label>
        		</div>
        		<div>
        			<input type="text" name="identification" id="identification" size="13" maxlength="13" placeholder="Identification" autofocus/>
    			</div>
    		</div>

    		<div class="contain_description">
				<div>
  	 				<label for="description">Photo du chat:</label>
  	 			</div>
  	 			<div>
					<p><input type="file" name="monfichier"></p>
				</div>
			</div>

    		
    		
    			<div class="contain_description">
    				<div>
      	 				<label for="description">Short description</label>
      	 			</div>
      	 			<div>
       					<textarea name="description" id="description" rows="10" cols="53" maxlength="200">
       					</textarea>
   					</div>
   				</div>




		   </fieldset>
		   <div class="validate">
		      <button type="submit" name="submit" value="Insert" id="insertion">Insert</button>
		  </div>
		</form>
<?php $content = ob_get_clean(); ?>

<?php require('template_backend.php'); ?>