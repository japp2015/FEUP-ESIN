 <?php 
include_once('database/connection.php');
session_start();
if (!isset($_SESSION['username'])){
    die("Página Privada");
}
$username = $_SESSION['username'];
$user = getUserByUsername($username);
?>
 
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $user['position'] . ' | ' . $user['fullname'] ?></title>
    <link href="style.css" rel="stylesheet">
    <link href="layout.css" rel="stylesheet">
</head>

<div class="container">
<?php include_once('common/header_aside.php'); ?>

<body class="body">
    <div id="personnel_info">
        <h1><?php echo $user['fullname']?></h1>
        <p> <?php if (isset($user['profile_pic'])) { ?>
            <img src="profile_pic/<?=$username?>.jpg">
        <?php }?></p>
        <p> Sexo: <?php echo $user['gender'] ?></p>
        <p> Data de nascimento: <?php echo $user['birthdate'] ?>  </p>
        <p> Naturalidade: <?php echo $user['naturality'] ?> </p>
        <p> Em serviço desde: <?php echo $user['start_service'] ?> </p>
        <p> Formação: <?php echo $user['school'] ?> </p>
        <p> Cargo: <?php echo $user['position'] ?> </p>
        <?php if ($user['position']!="Diretor Nacional"){?>
            <p> Esquadra: <?php echo $station['name'] ?></a></p>
        <?php } ?>
            
    </div>
    
    <?php if ($user['position']=='Diretor Nacional'){
        $occurrences=GetAllOccurrences();
    }elseif ($user['position']=='Chefe de Esquadra'){
        $occurrences=GetOccurrencesByStation($station['id']);
    }elseif ($user['position']=='Detetive'){
        $occurrences=GetOccurrencesByUsernameAndMinorOccurrences($username,$station['id']);
    }elseif ($user['position']=='Polícia'){
        $occurrences=GetOccurrencesByUsername($username);
    }
    
    if (!empty($occurrences)) { ?>

        <div id="current_work">
            <h3>Casos atuais</h3>
            <ul>
                <?php foreach($occurrences as $occurrence) { ?>
                    <?php if ($occurrence['state']=='Aberto') {?> 
                        <?php echo "<li><a href='single_occurrence.php?id=" . $occurrence['id'] . "'>" . $occurrence['id'] . " | " . $occurrence['title'] . "</a></li>" ; ?> 
                    <? } ?> 
                <? } ?>
            </ul>
        </div>

        <div id="past_work">
            <h3>Últimos casos</h3>
            <ul>
                <?php foreach($occurrences as $occurrence) { ?>
                    <?php if ($occurrence['state']=='Fechado' or $occurrence['state']=='Arquivado') { ?> 
                        <?php echo "<li><a href='single_occurrence.php?id=" . $occurrence['id'] . "'>" . $occurrence['id'] . " | " . $occurrence['title'] . "</a></li>" ; ?> 
                    <? } ?> 
                <? } ?>
            </ul>
        </div>

    <? } ?>
</body>
<?php include_once('common/footer.php'); ?>
</div>
</html>