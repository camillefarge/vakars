<?php

require('model/model.php');

/*
Controleur qui affiche UN event, supprime un evenement, ajoute une participation et ajout un produit
*/


if(isset($_GET['id'])){
    $eventsolo = afficherEventSolo($_GET['id']);
    $participants = afficherParticipants($_GET['id']);
    $courses = afficherCourses($_GET['id']);
    $role = recupererRole($_GET['id'],getIdbyMail($_SESSION['mail']));
    require('vue/Event.php');
}

if(isset($_GET['delete'])){
    supprimerEvent($_GET['delete']);
    header('Location:index.php');
}

if(isset($_POST['mail'])){
    participerEvent($_GET['id'],getIdbyMail($_POST['mail']),'1');
    header('location:event.php?id='.$_GET['id']);
}

if(isset($_POST['produit'])){
    
    ajouterproduit($_POST['produit']);
    $id_produit = getidproduit($_POST['produit']);
    $participation = getparticipation($_GET['id'],getIdbyMail($_SESSION['mail']));
    apporterproduit($id_produit,$participation);
}

    
if(isset($_GET['supprproduit'])){
    supprimerapport($_GET['supprproduit']);
}

if(isset($_GET['kick'])){
    supprimerparticipation($_GET['kick']);
    header('location:event.php?id='.$_GET['id']);
}
