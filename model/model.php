    <?php
session_start();

// connexion à la bdd


function dbConnect(){
    
     try
    {
         
    $dsn = 'mysql:dbname=;host=';
    $user = '';
    $password = '';
    
       $db = new PDO($dsn, $user, $password);
        return $db;
    }
    catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }
    
}

/*

    Fonctionnalités de l'espace membre

*/


// Fonction connexion

function connexion($mail,$password_user){
   
    $db = dbConnect();
    
    $check_account = 'SELECT COUNT(*) FROM user WHERE mail="'.$mail.'" AND password="'.md5($password_user).'"' ;

    
    $req_account = $db->query($check_account);
    $count_account = $req_account->fetch();

    // on test si le compte existe
    $return = $count_account[0];
    
    if($return>0){
    $_SESSION['mail'] = $mail;
    $test = 1;
    }
    else{
    $test = 0;
    }
    
    return $test;
}

// fonction inscription utilisateur
function inscription($mail,$nom,$prenom,$description,$date,$password,$url_photo){
    
    $db = dbConnect();
    
    $req_sql = "INSERT INTO `user` (`id_user`, `nom_user`, `prenom_user`, `date_de_naissance`, `description_user`, `url_photo_profil`, `password`, `mail`) VALUES (NULL, '$nom', '$prenom', '$date', '$description', '$url_photo', '$password', '$mail');";
    $prepare = $db->prepare($req_sql);   
    $res = $prepare ->execute();
    
    return $res;
    
}

// fonction modification du compte
function updatecompte($id,$mail,$nom,$prenom,$description,$date,$password,$url_photo){
    
    $db = dbConnect();
    
     if(!empty($password)&&isset($url_photo)){
    $req_sql = 'UPDATE `user` SET `nom_user` = "'.$nom.'", `prenom_user` = "'.$prenom.'", `date_de_naissance` = "'.$date.'", `description_user` = "'.$description.'", `url_photo_profil` = "'.$url_photo.'", `password` = "'.$password.'", `mail` = "'.$mail.'" WHERE `user`.`id_user` = "'.$id.'"';}
    
    else if(isset($password)){
    $req_sql = 'UPDATE `user` SET `nom_user` = "'.$nom.'", `prenom_user` = "'.$prenom.'", `date_de_naissance` = "'.$date.'", `description_user` = "'.$description.'", `password` = "'.$password.'", `mail` = "'.$mail.'" WHERE `user`.`id_user` = "'.$id.'"';
    }
    
    else if(isset($url_photo)){
    $req_sql = 'UPDATE `user` SET `nom_user` = "'.$nom.'", `prenom_user` = "'.$prenom.'", `date_de_naissance` = "'.$date.'", `description_user` = "'.$description.'", `url_photo_profil` = "'.$url_photo.'", `mail` = "'.$mail.'" WHERE `user`.`id_user` = "'.$id.'"';}
    
    else{
    $req_sql = 'UPDATE `user` SET `nom_user` = "'.$nom.'", `prenom_user` = "'.$prenom.'", `date_de_naissance` = "'.$date.'", `description_user` = "'.$description.'", `mail` = "'.$mail.'" WHERE `user`.`id_user` = "'.$id.'"';}
    
    
    $prepare = $db->prepare($req_sql);   
    $res = $prepare ->execute();
    
    return $res;
    
}

// fonction supression
function supprimercompte($id){
    
        
    $db = dbConnect(); 
    $req_sql = 'DELETE FROM particpation WHERE fk_id_user = '.$id.'; DELETE FROM `user` WHERE `user`.`id_user` = '.$id.'';
    $prepare = $db->prepare($req_sql);   
    $res = $prepare ->execute();
 
}
    




// Suprimme un fichier pour éviter de surcharger les uploads

function supprimerfichier($id,$type){
    
    
    $db = dbConnect();

    if($type=='photo_profil'){
        $req = 'SELECT url_photo_profil FROM user WHERE id_user="'.$id.'" LIMIT 1' ;
    }
    
    if($type=='photo_event'){
        $req = 'SELECT url_photo_couv_event FROM event WHERE id_event="'.$id.'" LIMIT 1' ;
    }
    
    $req_sql = $db->query($req);
        
    $resultat = $req_sql->fetch();
    $url = 'uploads/'.$resultat[0];
    
    
    if(file_exists($url)){
        unlink($url);
    }
    
}





/*



    Fonctionalités des Profils


*/






// fonction pour afficher le profil

function afficherProfil($id){
    
    $db = dbConnect();
        
    $req = 'SELECT * FROM `user` WHERE id_user="'.$id.'"' ;
        
    $req_sql = $db->query($req);
    
    $profil = $req_sql;
        
    return $profil;
    
 
}


// fonction pour afficher le prenom
function getPrenom($mail){
    
    $db = dbConnect();
    
    $req = 'SELECT prenom_user FROM user WHERE mail="'.$mail.'" LIMIT 1' ;
        
    $req_sql = $db->query($req);
    
    $resultat = $req_sql->fetch();
     
    return $resultat['prenom_user'];

}


// fonction pour afficher l'id grâce au mail(qui est stocker en variable de session)

function getIdbyMail($mail){
    
    $db = dbConnect();
    
    $req = 'SELECT id_user FROM user WHERE mail="'.$mail.'" LIMIT 1' ;
        
    $req_sql = $db->query($req);
    
    $resulat = $req_sql->fetch();
    return $resulat['id_user']; 

       
}



 function recupererRole($id_event,$id_membre){
     
    $db = dbConnect();
    
    $req = 'SELECT fk_id_role FROM `particpation` WHERE fk_id_event="'.$id_event.'" AND fk_id_user="'.$id_membre.'"' ;
        
    $req_sql = $db->query($req);
        
    $resultat = $req_sql->fetch();
    return $resultat['fk_id_role']; 
    
 }




/*



    Fonctionalités des evenements


*/






// Création d'un evenement 
function creerEvent($nom_event,$type_event,$date_event,$heure_event,$adresse,$description,$url_couv,$droit_entree){
    
     $db = dbConnect();
    
    $req_sql = 'INSERT INTO `event` (`id_event`, `nom_event`, `type_event`, `date_event`, `heure_event`, `adresse`, `description_event`, `url_photo_couv_event`, `valeur_droit_entree`) VALUES (NULL, "'.$nom_event.'", "'.$type_event.'", "'.$date_event.'", "'.$heure_event.'", "'.$adresse.'", "'.$description.'", "'.$url_couv.'", "'.$droit_entree.'");" ';
    
    
    $prepare = $db->prepare($req_sql);   
    $res = $prepare ->execute();
    
    return $res;

}




// modification d'un eveneneemnt
function updateEvent($id_event,$nom_event,$type_event,$date_event,$heure_event,$adresse,$description,$url_couv,$droit_entree){
    
    $db = dbConnect();
    
    if(isset($url_couv)){
        $req_sql = 'UPDATE `event` SET `nom_event` = "'.$nom_event.'", `type_event` = "'.$type_event.'" , `date_event` = "'.$date_event.'" , `heure_event` = "'.$heure_event.'" , `url_photo_couv_event` = "'.$url_couv.'", `adresse` = "'.$adresse.'", `description_event` = "'.$description.'", `valeur_droit_entree` = "'.$droit_entree.'" WHERE `event`.`id_event` = "'.$id_event.'"';
    }
    else{
        $req_sql = 'UPDATE `event` SET `nom_event` = "'.$nom_event.'", `type_event` = "'.$type_event.'" , `date_event` = "'.$date_event.'" , `heure_event` = "'.$heure_event.'" , `adresse` = "'.$adresse.'", `description_event` = "'.$description.'", `valeur_droit_entree` = "'.$droit_entree.'" WHERE `event`.`id_event` = "'.$id_event.'"';
    }
    

    $prepare = $db->prepare($req_sql);   
    $res = $prepare ->execute(); 
    
    return $res;
}




// Supression d'un event

function supprimerEvent($id){
    
    
    $db = dbConnect();
    
    $req_sql = 'DELETE FROM particpation WHERE fk_id_event = '.$id.'; DELETE FROM `event` WHERE `event`.`id_event` = '.$id.'';
    
    $prepare = $db->prepare($req_sql);   
    $res = $prepare ->execute();
 
 
}


// Affichage de plusieurs event

function afficherEvent($id){
    
    $db = dbConnect();
    
    $req = 'SELECT * FROM particpation LEFT JOIN event ON particpation.fk_id_event = event.id_event RIGHT JOIN user on particpation.fk_id_user = user.id_user WHERE fk_id_user="'.$id.'"' ;
        
    $req_sql = $db->query($req);
    
    $events = $req_sql; 
        
    return $events;
}



// Affichage d'un seul event


function afficherEventSolo($id_event){

    $db = dbConnect();
    
    $req = 'SELECT * FROM event LEFT JOIN particpation ON event.id_event = particpation.fk_id_event LEFT JOIN user ON user.id_user = particpation.fk_id_user WHERE id_event = "'.$id_event.'" LIMIT 1' ;
        
    $req_sql = $db->query($req);
    
    $eventSolo = $req_sql; 
        
    return $eventSolo;
}

// Recherche d'un event
function rechercherEvent($event){
    
    $db = dbConnect();
    
    $req = "SELECT * FROM event WHERE nom_event LIKE '%".$event."%'" ;
        
    $req_sql = $db->query($req);
    
    $events = $req_sql; 
        
    return $events;
}

// Recupérer un id d'event
function getidevent($nom_event){
    $db = dbConnect();
    
    $req = 'SELECT id_event FROM event WHERE nom_event="'.$nom_event.'" LIMIT 1' ;
        
    $req_sql = $db->query($req);
        
    $resultat = $req_sql->fetch();
     return $resultat['id_event']; 

}




/*



    Fonctionalités des participation


*/



// Création d'une participation
function participerEvent($id_event,$id_membre,$role){
    
    $db = dbConnect();
    
    $req_sql = 'INSERT INTO `particpation` (`id_participation`, `fk_id_event`, `fk_id_role`, `fk_id_user`, `etat_droit_entree`) VALUES (NULL, "'.$id_event.'", "'.$role.'", "'.$id_membre.'", 1);';
    
    $prepare = $db->prepare($req_sql);   
    $res = $prepare ->execute();
     
}




// Test si l'on participe
function testparticipation($id_event,$id_membre){
    
    $db = dbConnect();
    
    $req_sql = 'SELECT COUNT(*) FROM particpation WHERE fk_id_event="'.$id_event.'" AND fk_id_user ="'.$id_membre.'"' ;

    
    $req = $db->query($req_sql);
    $result = $req->fetch();

    return $result[0];

}

// Affichage des participants d'un event
function afficherParticipants($id_event){
    
    $db = dbConnect();
    
    $req = 'SELECT * FROM particpation
RIGHT JOIN user ON particpation.fk_id_user = user.id_user
WHERE fk_id_event="'.$id_event.'"';
        
    $req_sql = $db->query($req);
    
    $participants = $req_sql; 
        
    return $participants;
    
    
}

// Supression d'une particpation

function supprimerparticipation($id){
    
    $db = dbConnect();
    
    $req_sql = 'DELETE FROM particpation WHERE id_participation="'.$id.'"';
    
    $prepare = $db->prepare($req_sql);   
    $res = $prepare ->execute();
    
     
}



// Affichage de l'id de la particpation

function getparticipation($id_event,$id_membre){
    
    $db = dbConnect();
    
    $req = 'SELECT id_participation FROM particpation WHERE fk_id_event = '.$id_event.' AND fk_id_user = '.$id_membre.' LIMIT 1' ;
        
    $req_sql = $db->query($req);
        
    $resultat = $req_sql->fetch();
    return $resultat['id_participation']; 
}
    









/*



    Fonctionalités des apports


*/







// Ajoute un apport
function apporterproduit($id_produit,$participation){
    
        
    $db = dbConnect();
    
    $req_sql = 'INSERT INTO `apports` (`id_apports`, `fk_id_produit`, `fk_id_participation`, `quantité`) VALUES (NULL, "'.$id_produit.'", "'.$participation.'", 1)';
    
    $prepare = $db->prepare($req_sql);   
    $res = $prepare ->execute();
}


// ajoute un produit

function ajouterproduit($nom_produit){
    
     $db = dbConnect();
    
    $req_sql = 'INSERT INTO `produit` (`id_produit`, `nom_produit`) VALUES (NULL, "'.$nom_produit.'");';
    
    $prepare = $db->prepare($req_sql);   
    $res = $prepare ->execute();
}


// affiche l'id d'un produit
function getidproduit($nom_produit){
    
    $db = dbConnect();
    
    $req = 'SELECT id_produit FROM produit WHERE nom_produit="'.$nom_produit.'" LIMIT 1' ;
        
    $req_sql = $db->query($req);
        
    $resultat = $req_sql->fetch();
    return $resultat['id_produit']; 
}
    
    
    


// afficher la liste des choses à ramener
function affichercourses($id_event){
    
    $db = dbConnect();
    
    $req = 'SELECT * FROM `apports` 
            LEFT JOIN particpation ON particpation.id_participation = apports.fk_id_participation
            LEFT JOIN user ON particpation.fk_id_user = user.id_user 
            RIGHT JOIN produit ON produit.id_produit = apports.fk_id_produit
            WHERE fk_id_event='.$id_event.'' ;
        
    $req_sql = $db->query($req);
    
    $courses = $req_sql;
        
    return $courses; 
}

// supprime un appport
function supprimerapport($id){
    
   $db = dbConnect();
    
    $req_sql = 'DELETE FROM apports WHERE id_apports="'.$id.'"';
    
    $prepare = $db->prepare($req_sql);   
    $res = $prepare ->execute();
}





?>
