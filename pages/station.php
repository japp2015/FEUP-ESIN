<?php 
include_once('../database/connection.php');
session_start();
if (!isset($_SESSION['username'])){
    die("Página Privada");
}
$username=$_SESSION['username'];
$user = getUserByUsername($username);
if (!isset($_GET['station'])){
    die("Não Autorizado");
}
$station = GetStationByID($_GET['station']);
?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo "Esquadra " . $station['name'] ?></title>
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/layout.css" rel="stylesheet">
</head>

<div class="container">
    <?php include_once('../common/header_aside.php'); ?>

    <body>
        <div id="left">
            <h1> <?php echo $station['name']?> </h1>
            <p> <i> Morada: </i> <?php echo $station['adress'] ?> </p>
            <p> <i> Cidade: </i> <?php echo $station['city'] ?> </p>
            <?php $chief=getUserByUsername($station['chief']) ?>
            <p> <i> Chefe de Esquadra:</i> <?php echo $chief['fullname'] ?> </p>
        </div>
    
        <div id="right_station">
            <section id="station_tab">
                <h1>Equipa </h1>
                <?php $position="Detetive";
                $detectives=GetPersonnelStation($position,$station["id"])?>
                <h4><i> Detetives: </i></h4>
                    <ul>
                    <?php foreach($detectives as $detective) { ?>
                            <li> <?php echo $detective['fullname'] ?> </li> 
                    <?php } ?>
                    </ul>

                <?php $position="Polícia";
                $polices=GetPersonnelStation($position,$station["id"])?> 
                <h4> <i> Polícias:</i> </h4>
                    <ul>
                    <?php foreach($polices as $police) { ?>
                            <li> <?php echo $police['fullname'] ?> </li> 
                    <?php } ?>
                    </ul>
            <section>
        </div>
    </body>

    <?php include_once('../common/footer.php'); ?>
</div>
</html>