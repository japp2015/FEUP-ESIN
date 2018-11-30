<!-- Falta descobrir como adiciono os policias, tendo em conta que nao sei quantos são... e como adiciono pessoas,
pela mesma razão-->

<?php
    include_once('database/connection.php');  
    session_start();

    $occ_type=$_POST['occ_type'];
    $chief=$_POST['chief'];
    $location=$_POST['location'];
    $title=$_POST['title'];
    $description=$_POST['description'];
    $state=$_POST['state'];
    $date=date("Y-m-d");
          
    AddOcurrence($occ_type, $title, $chief, $state, $date, $location, $description);
    header('Location: main.php');  
?>  