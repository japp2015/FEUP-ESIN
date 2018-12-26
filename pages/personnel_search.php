

<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Pesquisa de Pessoal </title>
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/layout_one.css" rel="stylesheet">
    <link href="../css/form.css" rel="stylesheet">
</head>

<head>
<?php 
session_start();
if (!isset($_SESSION['username'])){
    die("Página Privada");
}
$username=$_SESSION['username'];
?>

</head>

<div class="container">
    <?php include_once('../common/header_aside.php'); ?>

    <body>

    <div id="left">
        <form action="personnel_search_result.php" method="post">
            <h1>Pesquisa de Pessoal</h1>
            <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
            <label>Género:</label> 
            <label><input type="radio" name="gender" value="Masculino">Masculino</label>
            <label><input type="radio" name="gender" value="Feminino">Feminino</label><br>
            <label>Nome:</label> <input type="text" name="name"><br>
            <label>Posição:</label> <input type="text" name="position"><br>
            <label>Esquadra:</label> <input type="text" name="station"><br>
            <input type="submit" value="Pesquisar">
        </form>
    </div>
    </body>

    <?php include_once('../common/footer.php'); ?>
</div>
</html>