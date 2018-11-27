<?php 
include_once('database/connection.php');
session_start();
$username = $_GET['username'];
$user = getUserByUsername($username);
?>

<!DOCTYPE html>
<html>
<title><?php echo $user['position'] . $user['fullname'] ?></title>

<?php include_once('common/header_aside.php'); ?>

<body>
    <div id="personal_info">
        <h1><?php $user['fullname']?></h1>
        <img src="http://lorempixel.com/600/300/business/" alt="photo">
        <p> Sexo: <?php echo $user['gender'] ?></p>
        <p> Data de nascimento: <?php echo $user['birthdate'] ?>  </p>
        <p> Naturalidade: <?php echo $user['naturality'] ?> </p>
        <p> Em serviço desde: <?php echo $user['star_service'] ?> </p>
        <p> Formação: <?php echo $user['school'] ?> </p>
        <p> Cargo: <?php echo $user['position'] ?> </p>

    </div>
    <div id="current_work">
        <p>Esquadra: <a href="nypd.php"><?php echo $user['position'] ?></a></p>
        <h3>Casos atuais</h3>
        <ul>
            <li><a href="10201.php">10201</a><p>Homicídio</p></li> 
            <li><a href="10200.php">10200</a><p>Desaparecimento</p></li></li>
        </ul>
    </div>
    <div id="past_work">
        <h3>Últimos casos</h3>
        <ul>
            <li><a href="news.php">10179</a><p>Homicídio</p><p>Estado: Fechado</p></li> 
            <li><a href="department.php">10165</a><p>Desaparecimento</p><p>Estado: Fechado</p></li>
            <li><a href="department.php">10120</a><p>Fraude</p><p>Estado: Arquivado</p></li>
            <li><a href="department.php">10110</a><p>Desaparecimento</p><p>Estado: Fechado</p></li>
            <li><a href="department.php">10102</a><p>Desaparecimento</p><p>Estado: Fechado</p></li>
        </ul>
    </div>
</body>
</html>