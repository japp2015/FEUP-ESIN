<?php
    include_once('database/connection.php');  
    
    $name=$_POST['name'];
    $city=$_POST['city'];
    $adress=$_POST['adress'];
    AddStation($name, $city, $adress);

    header('Location: main.php');

?>  