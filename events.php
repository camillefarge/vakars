<?php

require('model/model.php');

/* 
    Controleur qui affiche DES events, avec une recherche ou sans
*/

$prenom = getPrenom($_SESSION['mail']);


if(isset($_POST['event'])){
    
    $event = rechercherevent($_POST['event']);
    $nomsection = "Resulats des évenements : ".$_POST['event'];
    $mode = "search";
}

else{
    
$event = afficherEvent(getIdbymail($_SESSION['mail']));
$nomsection = "Mes évenements";
$mode = "";
    
}

require('vue/Events.php');
