<?php
    include_once('database/connection.php');  
    session_start();
    if (!isset($_POST['csrf']) || $_SESSION['csrf'] !== $_POST['csrf']) {
        die("Não autorizado.");
    }
    $name=$_POST['name'];
    $city=$_POST['city'];
    $adress=$_POST['adress'];
    AddStation($name, $city, $adress);

    header('Location: main.php');

?>  