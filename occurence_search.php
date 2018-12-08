
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

<h1>Pesquisa de ocorrência</h1>

<form action="occurence_search_result.php" method="post">
    <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
    <label>Nome:<input type="text" name="name"></label><br>
    <label>Data de publicação/abertura:<input type="date" name="start_date"></label><br>
    <label>Pessoal envolvido:<input type="text" name="personnel_involved"></label><br>
    <label>Localização:<input type="text" name="location"></label><br>
    <label>Estado:<input type="text" name="state"></label><br>
    <label>Descrição:</label><br>
    <textarea name="case_description" cols="40" rows="5"></textarea>
    <p>Dica: Use palavras ou frases chave separadas por ponto e vírgula.</p>
    <input type="submit" value="Search">
</form>
</html>