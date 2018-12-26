<?php
    include_once('../database/connection.php');    
    session_start();
    $username = htmlspecialchars($_POST["username"]);
    $password = htmlspecialchars($_POST["password"]);
  
    if (validateLogin($username, $password)) {
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        if (!isset($_SESSION['csrf'])) {
            $_SESSION['csrf'] = generate_random_token();
        }
        header('Location: ../pages/main.php');
    } else {
        $error = "Utilizador ou palavra-chave incorretos";
        header('Location: ../pages/log_in.php?error=' . $error);
    }
?>