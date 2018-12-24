<?php 
    include_once('../database/connection.php');  
    $id=$_POST['station'];
    header('Location: ../pages/public.php?station=' . $id);
?>