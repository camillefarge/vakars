<?php

require('model/model.php');


/* 
    Controleur qui gère l'inscription, la modification, la supression du compte et la deconnexion
*/


    
if(isset($_POST['create'])&&isset($_POST['mail'])&&isset($_POST['nom'])&&isset($_POST['prenom'])&&isset($_POST['description'])&&isset($_POST['date'])&&isset($_POST['password'])){
    
    
    if (isset($_FILES['photo']) AND $_FILES['photo']['error'] == 0)
    {
        if ($_FILES['photo']['size'] <= 10000000000000) { 
            move_uploaded_file($_FILES['photo']['tmp_name'], 'uploads/' . basename($_FILES['photo']['name']));
            $url_photo = basename($_FILES['photo']['name']);
                    }
    }
    else{
        $url_photo = "1.png";
    }

    
    $retour= inscription($_POST['mail'],$_POST['nom'],$_POST['prenom'],htmlspecialchars($_POST['description']),$_POST['date'],md5($_POST['password']),$url_photo);
    
    if($retour==1){
        header('Location:index.php');
    }
    else{
        $erreur = "Problème lors de l'inscription";
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
    
        if(!empty($_POST['password'])){
            $password = md5($_POST['password']);
        }
       $retour = updatecompte($_POST['update'],$_POST['mail'],$_POST['nom'],$_POST['prenom'],$_POST['description'],$_POST['date'],$password,$url_photo);
    
    echo $retour;
    
    if($retour==1){
        header('Location:profil.php');
    }
    else{
        $erreur = "Problème lors de la modification";
    }
    
    
}



if(isset($_GET['update'])){
    $profil = afficherProfil($_GET['update']);
    $mode="update";
}
else{
    $mode="";
}

if(isset($_GET['delete'])){
    supprimerfichier($_GET['delete'],'photo_profil');
    supprimercompte($_GET['delete']);
    session_destroy();
    header('Location:index.php');
}

if(isset($_GET['deco'])){
    session_destroy();
    header('Location:index.php');
}

require('vue/Inscription.php');
