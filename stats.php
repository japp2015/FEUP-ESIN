<?php 
    include_once('database/connection.php');  
    $id=$_POST['station'];
    header('Location: public.php?station=' . $id);
?>