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

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Pessoas desaparecidas </title>
    <link href="style.css" rel="stylesheet">
    <link href="layout.css" rel="stylesheet">
</head>

<div class="container">
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
            <button type="button" onclick="location.href='new_occurrence.php?id=<?=$person['id']?>&adress=<?=$person['adress']?>&name=<?=$person['name']?>&date=<?=$person['date']?>&local=<?=$person['local']?>&description=<?=$person['description']?>'">Criar ocorrência</button>
            <button type="button" onclick="location.href='delete_missing.php?id=<?=$person['id']?>'">Apagar</button>
        <?}?>
    </ul>
</body>

<?php include_once('common/footer.php'); ?>
        </div>
</html>

