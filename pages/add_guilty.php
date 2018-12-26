<?php 
include_once('../database/connection.php');
session_start();
if (!isset($_SESSION['username'])){
    die("Página Privada");
}
$username = $_SESSION['username'];
$user = getUserByUsername($username);
if (!isset($_GET['occurrence_id'])){
    die('Não autorizado');
}
$id = $_GET['occurrence_id']; ;

?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo "Alocar ". $type ?></title>
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/layout_one.css" rel="stylesheet">
    <link href="../css/form.css" rel="stylesheet">
</head>

<div class="container">
    <?php include_once('../common/header_aside.php'); ?>

    <body>
        <div id="left">
                <h1>Adicionar culpado</h1>
                <h4>Pessoa no sistema:</h4>
                <form action="../actions/action_guilty.php?id=<?=$id?>&known=1" method="post">
                    <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
                    <p> NIF:<input type="number" name="nif"></p>
                    <input type="submit" value="Atribuir">
                </form>
                <form>
                <h4>Pessoa nova:</h4>
                <form action="../actions/action_guilty.php?id=<?=$id?>" method="post">
                    <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
                    <p>NIF:<input type="number" name="nif"></p>
                    <p>Nome:<input type="text" name="name"></p>
                    <p>Sexo:
                    <label><input type="radio" name="gender" value="Masculino">Masculino</label>
                    <label><input type="radio" name="gender" value="Feminino">Feminino</label></p>
                    <p>Data de nascimento: <input type="date" name="birthdate"></p>
                    <p>Naturalidade:<input type="text" name="naturality"></p>
                    <p>Morada:<input type="text" name="adress"></p>
                    <textarea rows="4" cols="30" name="description"  placeholder="Descrição física"></textarea><br>
                    <p>Altura(cm):<input type="number" name="victim_height"></p>
                    <p>Peso(kg):<input type="number" name="victim_weight"></p>
                    <input type="submit" value="Atribuir">
                </form>
        </div>
    </body>

    <?php include_once('../common/footer.php'); ?>
</div>
</html>