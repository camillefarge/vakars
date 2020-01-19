<?php
require('model/model.php');

/* 
    Controleur qui affiche UN profil
*/

if(isset($_GET['id'])){
    $profil = afficherProfil($_GET['id']);
    $event = afficherEvent($_GET['id']);
}
else{
$linkupdate = 'inscription.php?update='.getIdbymail($_SESSION['mail']);
$linkdelete = 'inscription.php?delete='.getIdbymail($_SESSION['mail']);
$profil = afficherProfil(getIdbymail($_SESSION['mail']));
$event = afficherEvent(getIdbymail($_SESSION['mail']));}
    
require('vue/Profil.php');
