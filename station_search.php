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
    <link href="style.css" rel="stylesheet">
    <link href="layout.css" rel="stylesheet">
</head>

<div class="container">
<?php include_once('common/header_aside.php'); ?>
<body>

<form action="station_search_result.php" method="post">
    <h1>Pesquisa de Esquadra</h1>
    <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
    <label>Nome:<input type="text" name="name"></label><br>
    <label>Cidade:<input type="text" name="city"></label><br>
    <input type="submit" value="Pesquisar">
</form>
</body>

<?php include_once('common/footer.php'); ?>
</div>
</html>