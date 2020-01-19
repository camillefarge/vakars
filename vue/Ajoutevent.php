<?php 
require('header.php');

if($mode=="update"){
        foreach($eventsolo as $row){
    ?>

<div class="ecran_inscription">
    <a href="index.php"><img src="assets/img/logo-vk.svg" alt="logo" id="logo"></a>


    <form method="post" action="" enctype="multipart/form-data">
        <h1>Modifier un évenement</h1>
        <input type="hidden" name="update">
        <p><input type="text" name="nom" value="<?php echo $row['nom_event'];?>" placeholder="Nom de l'évenement"></p>
        <p><select name="type">

                <?php if($row['type_event']=='1'){ echo'
                    <option value="1" selected>Publique</option>
                    <option value="2">Privée</option>';}
                    else{
                       echo '
                        <option value="1">Publique</option>
                    <option value="2" selected>Privée</option>
                        
                        ';
                    } ?>
            </select></p>
        <p><input type="date" name="date" value="<?php $date = date_create($row['date_event']);                      
                echo date_format($date,'yy-m-d"');?>"></p>
        <p><input type="time" name="heure" value="<?php $date = date_create($row['heure_event']);                      
                echo date_format($date,'H:i');?>"></p>
        <p><input type="text" name="adresse" placeholder="Adresse de l'évenement" value="<?php echo $row['adresse'];?>"></p>
        <p><textarea placeholder="Description" name="description"><?php echo $row['description_event'];?></textarea></p>
        <p><label for="date">Image de couverte</label><input type="file" name="photo"></p>
        <p><input type="number" name="valeur_droit_entree" placeholder="Droit d'entre (ex: 5€)" value="<?php echo $row['valeur_droit_entree'];?>"></p>
        <button type="submit">Modifier</button>
    </form>
</div>
<?php
 
}}
else{
    
    ?>
<div class="ecran_inscription">
    <a href="index.php"><img src="assets/img/logo-vk.svg" alt="logo" id="logo"></a>

    <form method="post" action="" enctype="multipart/form-data">
        <h1>Ajouter un évenement</h1>
        <input type="hidden" name="create">
        <p><input type="text" name="nom" placeholder="Nom de l'évenement"></p>
        <p><select name="type">
                <option value="1">Publique</option>
                <option value="2">Privée</option>
            </select></p>
        <p><input type="date" name="date"></p>
        <p><input type="time" name="heure"></p>
        <p><input type="text" name="adresse" placeholder="Adresse de l'évenement"></p>
        <p><textarea placeholder="Description" name="description"></textarea></p>
        <p><label for="date">Image de couverte</label><input type="file" name="photo"></p>
        <p><input type="number" name="valeur_droit_entree" placeholder="Droit d'entre (ex: 5€)"></p>
        <button type="submit">Ajouter</button>
    </form>
</div>

<?php } 

require('footer.php');
?>
