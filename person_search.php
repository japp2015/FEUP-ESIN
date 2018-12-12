
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Pesquisa de Pessoas </title>
    <link href="style.css" rel="stylesheet">
    <link href="layout.css" rel="stylesheet">
</head>

<head>
<?php 
session_start();
if (!isset($_SESSION['username'])){
    die("Página Privada");
}
$username = $_SESSION['username'];
?>
</head> 

<div class="container">
<?php include_once('common/header_aside.php'); ?>

<body>

<form action="person_search_result.php" method="post">
    <h1>Pesquisa de Pessoa</h1>
    <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
    <label>Género:</label>
    <label><input type="radio" name="gender" value="Masculino">Masculino</label>
    <label><input type="radio" name="gender" value="Feminino">Feminino</label><br>
    <label>Nome:<input type="text" name="name"></label><br>
    <label>Morada:<input type="text" name="adress"></label><br>
    <label>Descrição física:</label><br>
    <textarea name="physical_description" cols="40" rows="5"></textarea><br>
    <input type="submit" value="Pesquisar">
</form>
</body>

<?php include_once('common/footer.php'); ?>
</div>
</html>