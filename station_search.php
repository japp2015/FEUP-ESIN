<!DOCTYPE html>
<html lang="en-US">

<head>
<?php 
session_start();
if (!isset($_SESSION['username'])){
    die("Página Privada");
}
?>
</head>

<?php include_once('common/header_aside.php'); ?>

<h1>Pesquisa de Esquadra</h1>

<form action="occurence_search_result.php" method="post">
    <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
    <label>Nome:<input type="text" name="name"></label><br>
    <label>Cidade:<input type="text" name="age"></label><br>
    <input type="submit" value="Pesquisar">
</form>
</html>