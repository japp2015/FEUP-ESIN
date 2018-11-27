<?php
    include_once('database/connection.php');    
    session_start();
    
    $username = htmlspecialchars($_POST["username"]);
    $password = htmlspecialchars($_POST["password"]);
    
    if (validateLogin($username, $password)) {
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        header('Location: main.php');
    } else {
        $error = "Username or password are incorrect.";
        header('Location: login.php?error=' . $error);
    }
?>