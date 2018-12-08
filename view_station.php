<?php 
include_once('database/connection.php');
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
<title> Esquadras Nacionais </title>

<?php include_once('common/header_aside.php'); ?>

<body>
    <h1> Esquadras já existentes a nivel Nacional: </h1>
    <section class="view_stations">
            <?php foreach ($stations as $station) { ?>
                <h3 class="title"> <a href="station.php?station=<?=$station['id']?>"> <?=$station['name']?> </a> </h3>
            <?php } ?>
    </section>
</body>
</html>