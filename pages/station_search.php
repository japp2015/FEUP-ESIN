<?php 
session_start();
if (!isset($_SESSION['username'])){
    die("Página Privada");
}
$username=$_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Pesquisa de Esquadra </title>
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/layout_one.css" rel="stylesheet">
    <link href="../css/form.css" rel="stylesheet">
</head>

<div class="container">
    <?php include_once('../common/header_aside.php'); ?>
    <body>
    <div id="left">
        <form action="station_search_result.php" method="post">
            <h1>Pesquisa de Esquadra</h1>
            <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
            <label>Nome:</label> <input type="text" name="name"><br>
            <label>Cidade:</label> <input type="text" name="city"><br>
            <input type="submit" value="Pesquisar">
        </form>
    </div>
    </body>

    <?php include_once('../common/footer.php'); ?>
</div>
</html>