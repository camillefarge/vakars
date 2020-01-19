<?php 
require('header.php');

?>

<div class="ecran_profil">
    <a href="index.php"><img src="assets/img/vk-white.png" id="logo" alt="logo"></a>

    <?php if(isset($linkupdate)){
    
    echo '<a href="'.$linkupdate.'"><img src="assets/img/reglage.png" alt="parametres" id="parametres"></a>';} ?>

    <?php foreach($profil as $row){?>
    <div id="header_profil">
        <img src="uploads/<?php echo $row['url_photo_profil'];?>" alt="photo profil">
        <h1><?php echo $row['prenom_user']?> <?php echo $row['nom_user'];?></h1>
    </div>

    <div class="profil_text-wrapper">
        <h2>Adresse e-mail</h2>
        <p><?php echo $row['mail']?></p>
    </div>

    <div class="profil_text-wrapper">
        <h2>Date de naissance</h2>
        <p><?php $date = date_create($row['date_de_naissance']);                      
                echo date_format($date,'j/m/Y');?></p>
    </div>

    <div class="profil_text-wrapper">
        <h2>Descritpion</h2>
        <p><?php echo $row['description_user'];?></p>
    </div>

    <div class="profil_text-wrapper">
        <h2>Évenements</h2>

    </div>
    <?php foreach($event as $row){ ?>
    <div class="hp_events_card">
        <div class="hp_events_card_text-wrapper">
            <h2><a href="event.php?id=<?php echo $row['id_event'];?>"><?php echo $row['nom_event'];?></a></h2>
            <p><?php 
                $date = date_create($row['date_event']);                      
                echo date_format($date,'d/m');?></p>

            <p class="hp_events_card_icons"><?php if(!isset($_GET['id'])&&$row['fk_id_role']=="2"){
                echo '<a href="event.php?delete='.$row['id_event'].'"><img class ="card-icon" src="assets/img/delete.png" alt="delete"></a><a href="ajoutevent.php?update='.$row['id_event'].'"><img class ="card-icon" src="assets/img/update.png" alt="update"></a>';}?></p>

        </div>
        <img class="hp_events_card_bg-img" src="uploads/<?php echo $row['url_photo_couv_event'];?>" alt="<?php echo $row['nom_event'];?>">
    </div>


    <?php } ?>


    <div class="edit-profil">
        <?php if(!isset($_GET['id'])){?>
        <a href="<?php echo $linkdelete;?>">Supprimer compte</a>
        <a href="inscription.php?deco">Se déconnecter</a>
        <?php }} ?>


    </div>

</div>


<?php 
require('footer.php');

?>
