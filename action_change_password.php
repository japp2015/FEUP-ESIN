<?php
    include_once('database/connection.php');    
    session_start();
    
    $username = $_SESSION['username'];
    $password = $_SESSION['password'];

    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirmed_password = $_POST['confirmed_password'];

    if (!isset($_POST['csrf']) || $_SESSION['csrf'] !== $_POST['csrf']) {
        die('Não autorizado');
    } 

    if ($old_password == $password) {
        if ($new_password == $password ) {
            $error = "Por favor introduza uma nova password diferente.";
            header('Location: change_password.php?error=' . $error);
        } elseif (($new_password != $password) && ($new_password == $confirmed_password)) {
            if (changePassword($new_password, $username)) {
                $_SESSION['password'] = $new_password;
                header('Location: main.php');
            } else {
                $error = "Falha a alterar a password.";
                header('Location: change_password.php?error=' . $error);
            }
        } else {
            $error = "Confirmação inválida: Não correspondem.";
            header('Location: change_password.php?error=' . $error);
        }
    } else {
        $error = "Password atual incorreta";
        header('Location: change_password.php?error=' . $error);
    }  
?>