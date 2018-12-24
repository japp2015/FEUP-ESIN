 <?php 
include_once('../database/connection.php');
session_start();
if (!isset($_SESSION['username'])){
    die("Página Privada");
}
$username = $_SESSION['username'];
$user = getUserByUsername($username);

if (isset($_GET['work'])) {
    if ($_GET['work'] == 'past') {
        $work = $_GET['work'];
    } else {
        die('Página não existe');
    }
}
?>
 
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $user['position'] . ' | ' . $user['fullname'] ?></title>
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/layout.css" rel="stylesheet">
</head>

<div class="container">
<?php include_once('../common/header_aside.php'); ?>

<body>
    <div id="personnel_info">
        <h1><?php echo $user['fullname']?></h1>
        <p> <?php if (isset($user['profile_pic'])) { ?>
            <img src="../profile_pic/<?=$username?>.jpg">
        <?php }else{?>
            <img src="../profile_pic/default/avatar.jpg">
        <?php }?></p>
        <p> <i> Sexo: </i> <?php echo $user['gender'] ?></p>
        <p> <i> Data de nascimento: </i> <?php echo $user['birthdate'] ?>  </p>
        <p> <i> Naturalidade:  </i><?php echo $user['naturality'] ?> </p>
        <p> <i> Em serviço desde: </i> <?php echo $user['start_service'] ?> </p>
        <p> <i> Formação: </i> <?php echo $user['school'] ?> </p>
        <p> <i> Cargo:  </i><?php echo $user['position'] ?> </p>
        <?php if ($user['position']!="Diretor Nacional"){?>
            <p> <i> Esquadra: </i> <?php echo $station['name'] ?></a></p>
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
       <div id="work">
            <ul id="tab">
                <li><a href="main.php">Casos Atuais</a></li>
                <li><a href="main.php?work=past">Últimos Casos</a></li>
            </ul>
        <?php if (isset($work)) { ?>
            <div id="past_work">
                <ul>
                    <?php foreach($occurrences as $occurrence) { ?>
                        <?php if ($occurrence['state']=='Fechado' or $occurrence['state']=='Arquivado') { ?> 
                            <?php echo "<li><a href='single_occurrence.php?id=" . $occurrence['id'] . "'>" . $occurrence['id'] . " | " . $occurrence['title'] . "</a></li>" ; ?>                             <? } ?> 
                        <? } ?>
                </ul>
            </div>
        <?php } else { ?>
            <div id="current_work">
                <ul>
                    <?php foreach($occurrences as $occurrence) { ?>
                        <?php if ($occurrence['state']=='Aberto') {?> 
                            <?php echo "<li><a href='single_occurrence.php?id=" . $occurrence['id'] . "'>" . $occurrence['id'] . " | " . $occurrence['title'] . "</a></li>" ; ?> 
                        <? } ?> 
                    <? } ?>
                </ul>
            </div>
        <? } ?>
        </div>
    <? } ?>
</body>
<?php include_once('../common/footer.php'); ?>
</div>
</html>

