<?php
    include_once('database/connection.php'); 

    $username=$_POST['username'];
    $password=$_POST['password'];
    $confirmed_password=$_POST['confirmed_password'];
    $email=$_POST['email'];
    $fullname=$_POST['fullname'];
    $gender=$_POST['gender'];
    $naturality=$_POST['naturality'];
    $birthdate=$_POST['birthdate'];
    $school=$_POST['school'];
    $station=$_POST['station'];
    $position=$_GET['position'];
    $start_service=date("y-m-d");

    AddPersonnel($username, $password, $email, $fullname, $gender, $birthdate, $naturality, $start_service, $school, $position, $station);
    if ($position=="Chefe de Esquadra"){
        SetStationChief($username, $station);
    }
    header('Location: main.php');

?>


