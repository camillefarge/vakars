<?php 
require('header.php');

?>

<div class="ecran_inscription">
    <a href="index.php"><img src="assets/img/logo-vk.svg" alt="logo" id="logo"></a>

    <?php if($mode=="update"){
                foreach ($profil as $row){         
                    
    ?>


    <form method="post" action="inscription.php" enctype="multipart/form-data">
        <h1>Modification</h1>
        <?php if(isset($erreur)){echo '<p>'.$erreur.'</p>';}?>
        <input type="hidden" name="update" value="<?php echo $row['id_user'];?>">
        <p><input type="email" name="mail" placeholder="Adresse e-mail" value="<?php echo $row['mail'];?>"></p>
        <p><input type="text" name="nom" placeholder="Nom ..." value="<?php echo $row['nom_user'];?>"></p>
        <p><input type="text" name="prenom" placeholder="Prénom ..." value="<?php echo $row['prenom_user'];?>"></p>
        <p><textarea name="description" placeholder="Description..."><?php echo $row['description_user'];?></textarea></p>
        <p><label for="date">Date de naissance</label><input type="date" name="date" value="<?php echo $row['date_de_naissance'];?>"></p>
        <p><input type="password" name="password" placeholder="Mot de passe..."></p>
        <p><label for="photo">Photo de profil</label><input type="file" name="photo"></p>
        <p>
            <button type="submit">Modifier le compte</button>
        </p>
    </form>
    <?php }}else{ ?>
    <form method="post" action="inscription.php" enctype="multipart/form-data">
        <h1>Inscription</h1>
        <?php if(isset($erreur)){echo '<p>'.$erreur.'</p>';}?>
        <input type="hidden" name="create">
        <p><input type="email" name="mail" placeholder="Adresse e-mail"></p>
        <p><input type="text" name="nom" placeholder="Nom ..."></p>
        <p><input type="text" name="prenom" placeholder="Prénom ..."></p>
        <p><textarea name="description" placeholder="Description..."></textarea></p>
        <p><label for="date">Date de naissance</label><input type="date" name="date"></p>
        <p><input type="password" name="password" placeholder="Mot de passe..."></p>
        <p><label for="photo">Photo de profil</label><input type="file" name="photo"></p>
        <p>
            <button type="submit">S'inscrire</button>
        </p>
    </form>
    <?php } ?>
</div>
<?php require('footer.php'); ?>
