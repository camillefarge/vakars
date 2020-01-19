<?php 
require('header.php');

?>
<div class="hp">
    <img src="assets/img/logo-vk.svg" alt="">
    <!-- <img src="/assets/img/vk-white.png" alt="" id="logo"> -->
    <a href="profil.php"><img class="hp_profil" src="assets/img/profil.svg" alt=""></a>

    <h1 class="hp_title">Bonjour <?php echo $prenom ?></h1>

    <!-- <div class="hp_notif">
                <img src="assets/img/notif.svg" alt="">
                <div class="hp_notif_text">
                    <p class="hp_notif_text_invite"> <strong>Jacques</strong> vous invite à</p>
                    <p class="hp_notif_text_event">Anniversaire Paul</p>
                </div>

            </div> -->

    <form method="post">
        <input class="hp_input" type="text" name="event" placeholder="Rechercher un évenement">
        <button class="hp_button" type="submit"><img src="assets/img/icon_search.png" alt=""></button>
    </form>

    <h1 class="hp_title"><?php echo $nomsection;?></h1>

    <?php foreach($event as $row){ ?>


    <div class="hp_events_card">
        <div class="hp_events_card_text-wrapper">
            <h2><a href="event.php?id=<?php echo $row['id_event'];?>"><?php echo $row['nom_event'];?></a></h2>
            <p><?php 
                $date = date_create($row['date_event']);                      
                echo date_format($date,'d/m');?></p>

            <p><?php
                $test = testparticipation($row['id_event'],getIdbyMail($_SESSION['mail']));                                 
                if($test==1){
                    echo $row['adresse'];
                }?></p>

            <p class="hp_events_card_icons"><?php if($mode!="search"&&$row['fk_id_role']=="2"){
                echo '<a href="event.php?delete='.$row['id_event'].'"><img class ="card-icon" src="assets/img/delete.png" alt="delete"></a><a href="ajoutevent.php?update='.$row['id_event'].'"><img class ="card-icon" src="assets/img/update.png" alt="update"></a>';}?></p>
            <p><?php    
                    if($mode=="search"&&$test==0){ ?>
                <a href="participer.php?id=<?php echo $row['id_event'].'&id_user='.getIdbyMail($_SESSION['mail']);?>">Participer</a>
                <?php } ?>
            </p>


        </div>
        <img class="hp_events_card_bg-img" src="uploads/<?php echo $row['url_photo_couv_event'];?>" alt="<?php echo $row['nom_event'];?>">

    </div>

    <?php } ?>

    <!-- <div class="d-inline-block"> -->
    <div class="hp_events_card hp_events_card--add">
        <a href="ajoutevent.php"><img src="assets/img/add-event.svg" alt="croix"></a>
    </div>
    <!-- </div> -->


</div>
<?php include('footer.php');?>
