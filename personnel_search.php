<!DOCTYPE html>
<html lang="en-US">

<head>
</head>

<?php include_once('common/header_aside.php'); ?>

<h1>Pesquisa de Pessoal</h1>

<form action="personnel_search_result.php" method="post">
    <label>Sexo:</label>
    <label><input type="radio" name="gender" value="male">Masculino</label>
    <label><input type="radio" name="gender" value="female">Feminino</label><br>
    <label>Nome:<input type="text" name="name"></label><br>
    <label>Posição:<input type="text" name="position"></label><br>
    <label>Primeiro ano de serviço:<input type="number" name="year"></label><br>
    <label>Esquadra:<input type="text" name="station"></label><br>
    <input type="submit" value="Pesquisar">
</form>
</html>