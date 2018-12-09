<?php 
include_once('database/connection.php');
session_start();
if (!isset($_SESSION['username'])){
    die("Página Privada");
}
$username = $_SESSION['username'];
$user = getUserByUsername($username);
$people = GetMissingPeopleByUserStation($username);
?>

<!DOCTYPE html>
<html>
<title> Pessoas desaparecidas </title>

<?php include_once('common/header_aside.php'); ?>

<body>
    <h1>Pessoas desaparecidas</h1>
    <ul>
        <?php foreach ($people as $person) {
            echo '<li><h3>' . $person['name'] . '</h3></li>';
            echo '<p>' . $person['gender'] . '</p>';
            echo '<p>' . $person['adress'] . '</p>';
            echo '<p>' . $person['description'] . '</p>';
            echo '<p>' . $person['local'] . '</p>';
            echo '<p>' . $person['date'] . '</p>'; ?>
            <button type="button" onclick="location.href='new_occurrence.php?id=<?=$person['id']?>&local=<?=$person['local']?>&name=<?=$person['name']?>&date=<?=$person['date']?>&local=<?=$person['local']?>'">Criar ocorrência</button>
        <?}?>
    </ul>

