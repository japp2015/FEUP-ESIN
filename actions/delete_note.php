<?php
    include_once('../database/connection.php');  
    
    $id=$_GET['id_note'];
    DeleteNote($id);
    header('Location: ../pages/notes.php');

?>  