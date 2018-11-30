<?php
    include_once('database/connection.php');  
    session_start();

    $username=$_SESSION['username'];
    $title=$_POST['title'];
    $text=$_POST['note'];
    AddNote($username, $title, $text);
    header('Location: notes.php');

?>  