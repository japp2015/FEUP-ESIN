
<!DOCTYPE html>
<html>

<head>
<?php session_start(); 
if (!isset($_SESSION['username'])){
    die("Página Privada");
}
$username = $_SESSION['username'];
?>

</head>

<?php include_once('common/header_aside.php'); ?>

<body>
    <h1>Pesquisa</h1>
    <h3>Pesquisa Orientada</h3>
    <ul>
        <li><a href="person_search.php">Pessoa</a></li> 
        <li><a href="personnel_search.php">Pessoal</a></li> 
        <li><a href="occurence_search.php">Ocorrência</a></li>
        <li><a href="station_search.php">Esquadra</a></li>
    </ul>
    <form action="general_search_result.php" method="post">
        <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
        <fieldset>
            <legend><h3>Pesquisa Geral</h3></legend>
            <textarea name="general_search" cols="40" rows="5"></textarea><br>
            <input type="submit" value="Pesquisar">
        </fieldset>
    </form>
</body>

<?php include_once('common/footer.php'); ?>
</html>



