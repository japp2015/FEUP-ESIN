<?php
    include_once('../database/connection.php');  
    session_start();
    if (!isset($_POST['csrf']) || $_SESSION['csrf'] !== $_POST['csrf']) {
        die("Não autorizado.");
    }
    $username=$_SESSION['username'];
    $title=$_POST['title'];
    $text=$_POST['note'];
    AddNote($username, $title, $text);
    header('Location: ../pages/notes.php');

?>  