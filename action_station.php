<?php
    include_once('database/connection.php');  
    
    $name=$_POST['name'];
    $city=$_POST['city'];
    $adress=$_POST['adress'];
    $chief=$_POST['username'];
    AddStation($name, $city, $adress, $chief);

    // falta adicionar o chefe que vai ser a mesma função que adicionar qualquer outra pessoa
    $password=$_POST['password'];
    $confirmed_password=$_POST['confirmed_password'];
    $email=$_POST['email'];
    $fullname=$_POST['fulname'];
    $gender=$_POST['gender'];
    $naturality=$_POST['naturality'];
    $birthday=$_POST['birthday'];
    $position="Chefe de Esquadra"

    
    
    header('Location: notes.php');

?>  