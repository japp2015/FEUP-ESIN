<?php 
include_once('../database/connection.php');
session_start();
if (!isset($_SESSION['username'])){
    die("Página Privada");
}
$username = $_SESSION['username'];
?>

<!DOCTYPE html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Mudar Password</title>
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/layout.css" rel="stylesheet">
    <link href="../css/form.css" rel="stylesheet">
</head>

<div class="container">
<?php include_once('../common/header_aside.php'); ?>

<body>
    <div class="change_password">
        <form class="edit_content" action='../actions/action_change_password.php' method='post'>
            <div class="change-password-title">
                <h3>Mudar Password</h3>
            </div>

            <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">

            <div class="password_input_container">
                <input type="password" placeholder="Password actual" name="old_password" required>
            </div>

            <div class="password_input_container">
                <input type="password" placeholder="Nova Password" pattern=".{6,}" title="Pelo menos 8 caracteres" name="new_password" required>
            </div>

            <div class="password_input_container">
                <input type="password" placeholder="Confirme Nova Password" pattern=".{6,}" title="Pelo menos 8 caracteres" name="confirmed_password" required>
            </div>

            <div class="button_container">
                <button type="submit">Guardar Alterações</button>
            </div>
            
            <?php if (isset($_GET['error'])) {
                $error = $_GET['error'];
                echo $error;
            } ?>

        </form>
    </div>
    
</body>
<?php include_once('../common/footer.php'); ?>
</div>
</html>