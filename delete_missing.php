<?php
    include_once('database/connection.php');  
    
    $id=$_GET['id'];
    DeleteMissingPersonById($id);
    header('Location: missing_people.php');

?>  