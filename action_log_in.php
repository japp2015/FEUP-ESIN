<?php
    include_once('database/connection.php');    
    session_start();
    $username = htmlspecialchars($_POST["username"]);
    $password = htmlspecialchars($_POST["password"]);
  
    if (validateLogin($username, $password)) {
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        if (!isset($_SESSION['csrf'])) {
            $_SESSION['csrf'] = generate_random_token();
        }
        header('Location: main.php');
    } else {
        $error = "Username or password are incorrect.";
        header('Location: log_in.php?error=' . $error);
    }
?>