<?php
    include_once('database/connection.php');
    session_start();

    $title=$_POST['title'];
    $text=$_POST['text'];
    $date=date("Y-m-d");

    AddNews($title, $text, $date);
    header('Location: main.php');

?>