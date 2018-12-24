<?php
    include_once('../database/connection.php');  

    $id_occurrence=$_GET['id'];
    $id_update=$_GET['id_update'];
    DeleteUpdate($id_update);
    header('Location: ../pages/single_occurrence.php?id='. $id_occurrence );

?>  