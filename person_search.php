
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

<h1>Pesquisa de Pessoa</h1>

<form action="person_search_result.php" method="post">
    <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
    <label>Sexo:</label>
    <label><input type="radio" name="gender" value="male">Masculino</label>
    <label><input type="radio" name="gender" value="female">Feminino</label><br>
    <label>Nome:<input type="text" name="name"></label><br>
    <label>Morada:<input type="text" name="adress"></label><br>
    <label>Descrição física:</label><br>
    <textarea name="physical_description" cols="40" rows="5"></textarea>
    <p>Dica: Use palavras ou frases chave separadas por ponto e vírgula.</p>
    <label>Referência:<input type="text" name="reference"></label><br>
    <input type="submit" value="Pesquisar">
</form>
</html>