<?php
    include_once('../database/connection.php'); 
    session_start();
    $username=$_SESSION['username'];
    $user = getUserByUsername($username);
 
    $new_username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $confirmed_password = htmlspecialchars($_POST['confirmed_password']);
    $email = htmlspecialchars($_POST['email']);

    $fullname=$_POST['fullname'];
    $gender=$_POST['gender'];
    $naturality=$_POST['naturality'];
    $birthdate=$_POST['birthdate'];
    $school=$_POST['school'];
    if (!isset($_POST['station'])){
        $station=$user['station'];
    }else{
        $station=$_POST['station'];
    }
    $position=$_GET['position'];
    $start_service=date("y-m-d");
    
    if ($password == $confirmed_password) {
        if (!userExists($new_username)) {
            if (AddPersonnel($new_username, $password, $email, $fullname, $gender, $birthdate, $naturality, $start_service, $school, $position, $station)) {
                if ($position=="Chefe de Esquadra"){
                    SetStationChief($new_username, $station);
                }            
                if (!isset($_SESSION['csrf'])) {
                    $_SESSION['csrf'] = generate_random_token();
                }
                header('Location: ../pages/main.php');
            } else {
                $error = "Erro ao criar colaborador";
                header('Location: ../pages/create_personnel.php?error=' . $error);
            }
        } else {
            $error = "Username de colaborador já existente";
            header('Location: ../pages/create_personnel.php?error=' . $error);
        }
    } else {
        $error = "Password não correspondem";
            header('Location: ../pages/create_personnel.php?error=' . $error);
    }  

?>


