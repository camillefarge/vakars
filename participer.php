<?php

require('model/model.php');

/* 
    Controleur de participer a un event
*/

if(isset($_GET['id'])&&isset($_GET['id_user'])){
    participerEvent($_GET['id'],$_GET['id_user'],'1');
    header('location:event.php?id='.$_GET['id']);
}
