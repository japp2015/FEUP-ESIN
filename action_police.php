<?php
    include_once('database/connection.php');  
    session_start();
      
    $police_username=$_POST['add_police'];
    $id_occurrence=$_GET['occurrence'];
    AddWorksPolice($police_username,$id_occurrence);
    header('Location: single_occurrence.php?id=' . $id_occurrence);

?>  