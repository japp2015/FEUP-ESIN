<?php
    include_once('../database/connection.php');  
    
    $id=$_GET['id'];
    DeleteMissingPersonById($id);
    header('Location: ../pages/missing_people.php');

?>  