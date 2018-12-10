
<!DOCTYPE html>
<html>

<head>
<?php 
session_start();
if (!isset($_SESSION['username'])){
    die("Página Privada");
}
$username = $_SESSION['username'];
?>
</head>

<?php include_once('common/header_aside.php'); ?>

<body>
<h1>Pesquisa de Pessoa</h1>

<form action="person_search_result.php" method="post">
    <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
    <label>Género:</label>
    <label><input type="radio" name="gender" value="Masculino">Masculino</label>
    <label><input type="radio" name="gender" value="Feminino">Feminino</label><br>
    <label>Nome:<input type="text" name="name"></label><br>
    <label>Morada:<input type="text" name="adress"></label><br>
    <label>Descrição física:</label><br>
    <textarea name="physical_description" cols="40" rows="5"></textarea>
    <p>Dica: Use palavras ou frases chave separadas por ponto e vírgula.</p>
    <input type="submit" value="Pesquisar">
</form>
</body>

<?php include_once('common/footer.php'); ?>
</html>