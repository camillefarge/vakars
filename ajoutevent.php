<?php

require('model/model.php');

/*

Controleur qui permet d'ajouter des event avec l'hidden create et modifier un event avec l'hidden udpdate.



*/
if(isset($_POST['create'])){
    
    
    
    // script d'import des photos (src : OpenclassRooms)
    if (isset($_FILES['photo']) AND $_FILES['photo']['error'] == 0)
        {
            if ($_FILES['photo']['size'] <= 10000000000000) {
                move_uploaded_file($_FILES['photo']['tmp_name'], 'uploads/' . basename($_FILES['photo']['name']));
                $url_photo = basename($_FILES['photo']['name']);
                }
            
 
        }else{
            $url_photo='2.png';
        }

        $retour = creerEvent(htmlspecialchars($_POST['nom']),$_POST['type'],$_POST['date'],$_POST['heure'],htmlspecialchars($_POST['adresse']),htmlspecialchars($_POST['description']),$url_photo,$_POST['valeur_droit_entree']);
        participerEvent(getidevent($_POST['nom']),getIdbymail($_SESSION['mail']),2);
        
         if($retour==1){
    header('location:event.php?id='.getidevent($_POST['nom']));}
    else{
        $erreur = "Problème lors de la création l'évenement";
    }
                                           
}



if(isset($_POST['update'])){
    
    if (isset($_FILES['photo']) AND $_FILES['photo']['error'] == 0)
            {
                if ($_FILES['photo']['size'] <= 10000000000000) {
                        move_uploaded_file($_FILES['photo']['tmp_name'], 'uploads/' . basename($_FILES['photo']['name']));
                        $url_photo = basename($_FILES['photo']['name']);
                }
             }
    
   $retour = updateEvent($_GET['update'],htmlspecialchars($_POST['nom']),$_POST['type'],$_POST['date'],$_POST['heure'],$_POST['adresse'],htmlspecialchars($_POST['description']),$url_photo,$_POST['valeur_droit_entree']);
    
    if($retour==1){
    header('location:event.php?id='.getidevent($_POST['nom']));}
    else{
        $erreur = "Problème dans la modification de l'évenement";
    }
}







if(isset($_GET['update'])){
    $eventsolo = afficherEventSolo($_GET['update']);
    $mode = "update";
}
else{
    $mode="";
}




require('vue/Ajoutevent.php');
