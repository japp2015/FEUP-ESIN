<!-- FAZER UM FOOTER TIPO O HEADER. QUE É COMUM-->

<?php 
include_once('database/connection.php');
session_start();
$username = $_SESSION['username'];
$user = getUserByUsername($username);
$occurrences = getOccurrencesByUsername($username);
?>

<!DOCTYPE html>
<html>
<title><?php echo $user['position'] . ' | ' . $user['fullname'] ?></title>

<?php include_once('common/header_aside.php'); ?>

<body>
    <div id="personal_info">
        <h1><?php echo $user['fullname']?></h1>
        <img src="http://lorempixel.com/600/300/business/" alt="photo">
        <p> Sexo: <?php echo $user['gender'] ?></p>
        <p> Data de nascimento: <?php echo $user['birthdate'] ?>  </p>
        <p> Naturalidade: <?php echo $user['naturality'] ?> </p>
        <p> Em serviço desde: <?php echo $user['start_service'] ?> </p>
        <p> Formação: <?php echo $user['school'] ?> </p>
        <p> Cargo: <?php echo $user['position'] ?> </p>
        <p> Esquadra: <?php echo $station['name'] ?></a></p>
            
    </div>
  
    <div id="current_work">
        <h3>Casos atuais</h3>
        <ul>
            <?php foreach($occurrences as $occurrence) { ?>
                <?php if ($occurrence['state']=='Aberto') {?> 
                    <?php echo "<li><a href='occurrence.php?id=" . $occurrence['id'] . "'>" . $occurrence['id'] . "</a><p>" . $occurrence['title'] . "</p></li>" ; ?> 
                <? } ?> 
            <? } ?>
        </ul>
    </div>

    <div id="past_work">
        <h3>Últimos casos</h3>
        <ul>
            <?php foreach($occurrences as $occurrence) { ?>
                <?php if ($occurrence['state']=='Fechado' or $occurrence['state']=='Arquivado') { ?> 
                    <?php echo "<li><a href='occurrence.php?id=" . $occurrence['id'] . "'>" . $occurrence['id'] . "</a><p>" . $occurrence['title'] . "</p></li>" ; ?> 
                <? } ?> 
            <? } ?>
        </ul>
    </div>
</body>
</html>