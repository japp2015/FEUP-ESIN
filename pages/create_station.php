<?php 
include_once('../database/connection.php');
session_start();
if (!isset($_SESSION['username'])){
    die("Página Privada");
}
$username = $_SESSION['username'];
$user = getUserByUsername($username);
if ($user['position']!='Diretor Nacional'){
   die('Página não disponível para as atuais permissões');
}
$stations = GetAllStations();
?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Nova Esquadra: </title>
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/layout.css" rel="stylesheet">
    <link href="../css/form.css" rel="stylesheet">
</head>

<div class="container">
<?php include_once('../common/header_aside.php'); ?>

<body>
    <section class = "add_station">
        <h2> Adicionar Nova Esquadra: </h2>
            <form action="../action_station.php" method="post">
                <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
                <div> Nome da Esquadra: <input type="text" placeholder="Nome da Esquadra" name="name"></div>
                <div> Cidade: <input type="text" placeholder="Cidade" name="city"></div>
                <div> Morada: <input type="text" placeholder="Morada" name="adress"></div>
                <br>
                <div> <input type="submit" value="Adicionar"></div>
            </form>
    </section>
</body>

<?php include_once('../common/footer.php'); ?>
</div>
</html>