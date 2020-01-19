<?php 
require('header.php');

foreach($eventsolo as $row){ ?>

<div class="event">

    <div class="event_header" style="background-image:url('uploads/<?php echo $row['url_photo_couv_event'];?>')">

        <!-- <img src="assets/img/party-big.jpg" alt=""> -->
        <!-- <div class=""> -->
        <!-- event_header_text-wrapper -->
        <h1><?php echo $row['nom_event'];?></h1>
        <p><?php echo $row['adresse'];?></p>
        <a href="index.php">Retour à l'accueil</a>
        <!-- </div> -->
    </div>



    <main>
        <h2><?php 
                $date = date_create($row['date_event']);                      
                            echo date_format($date,'l d F Y');?><br /><?php 
                $date = date_create($row['heure_event']);                      
                echo date_format($date,'H:i');?></h2>



        <!-- Cet h3 correspond au style du h1 dans index  -->


        <section class="event_participants">

            <h3>Participants</h3>

            <?php foreach($participants as $row2){ ?>

            <div class="participant">
                <a href="profil.php?id=<?php echo $row2['id_user'];?>"><img class="round-img" src="uploads/<?php echo $row2['url_photo_profil'];?>" alt="<?php echo $row2['prenom_user'];?> <?php echo $row2['nom_user'];?>"></a>
                <?php if($role==2){?><a href="?id=<?php echo $row['id_event'];?>&kick=<?php echo $row2['id_participation'];?>"><img src="assets/img/cancel.png" class="croix"></a><?php }?>
            </div>
            <?php } ?>


            <!-- <img src="assets/img/add-event.svg" alt=""> -->

            <div id="add_member">
                <form method="post" action="">
                    <input type="email" name="mail" placeholder="Ajouter un participant">
                    <button class="event_add-member_button" type="submit"><img src="assets/img/icon_add.png" alt="add-member"></button>
                </form>
            </div>
        </section>


        <section class="event_course">
            <h3>Liste de courses</h3>
            <div class="event_course_searchbar">

                <form method="post" action="">
                    <input type="text" name="produit" placeholder="Produit">
                    <button class="event_course_add" type="submit"><img src="assets/img/icon_add.png" alt="add-member"></button>
                </form>
            </div>



            <ul class="event_course_list">
                <?php foreach($courses as $row3){ ?>



                <li>
                    <img class="round-img" src="uploads/<?php echo $row3['url_photo_profil'];?>" alt="<?php echo $row3['prenom_user'];?>">
                    <p class="event_course_list_item checked"><?php echo $row3['nom_produit'];?></p>
                    <?php if($row3['id_user']==getIdbyMail($_SESSION['mail'])||$role=='2'){?><p><a href="?supprproduit=<?php echo $row3['id_apports'];?>&id=<?php echo $_GET['id'];?>"><img src="assets/img/delete.png" alt="delete"></a></p><?php } ?>
                </li>

                <?php } ?>

            </ul>
        </section>



        <section class="event_edit">

            <?php if($role=='2'){

echo '<a href="?delete='.$_GET['id'].'"><img src="assets/img/delete.png" alt=""></a>';
echo '<a href="ajoutevent.php?update='.$_GET['id'].'"><img src="assets/img/update.png" alt=""></a>';
}?>
        </section>

    </main>
</div>

<?php } 
require('footer.php');?>
