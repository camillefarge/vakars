<?php

require('model/model.php');

/* 
    Controleur qui affiche l'ecran de connexion si on est pas connecté, sinon il redirige sur la page des events
*/

if(isset($_POST['mail'])&&isset($_POST['password'])){
    $retour = connexion($_POST['mail'],$_POST['password']);
    if($retour==1){
        header('Location:events.php');
    }else{
        $erreur = "Adresse Mail ou mot de passe érroné";
    }
}

if(isset($_SESSION['mail'])){
    header('Location:events.php');
}else{
   
require('vue/Connexion.php');
    
}
