<?php session_start(); 
if (!isset($_SESSION['username'])){
    die("Página Privada");
}
$username = $_SESSION['username'];
?>


<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pesquisa Geral</title>
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/layout.css" rel="stylesheet">
    <link href="../css/form.css" rel="stylesheet">
</head>

<div class="container">
    <?php include_once('../common/header_aside.php'); ?>

    <body>
        <div id="left">
            <h1>Pesquisa Orientada</h1>
            <ul>
                <li><a href="person_search.php">Pessoa</a></li> 
                <li><a href="personnel_search.php">Pessoal</a></li> 
                <li><a href="occurence_search.php">Ocorrência</a></li>
                <li><a href="station_search.php">Esquadra</a></li>
            </ul>
        </div>
        <div id="right">
            <form action="general_search_result.php" method="post">
                <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
                <fieldset>
                    <legend><h1>Pesquisa Geral</h1></legend>
                    <textarea name="general_search" cols="40" rows="5"></textarea><br>
                    <input type="submit" value="Pesquisar">
                </fieldset>
            </form>
        </div>
    </body>

    <?php include_once('../common/footer.php'); ?>
</div>

</html>



