<?php 
include_once('../database/connection.php');
$missings = getMissingPeople();
$news = GetNews();
?>



<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Polícia Nacional</title>
    <link href="../css/public_style.css" rel="stylesheet">
    <link href="../css/public_layout.css" rel="stylesheet">
</head>
  
<div class="container">
<header class="header">
    <h2>Polícia Nacional</h2>
    <div class=log_in>
        <button id="log_in_button" type="log_in" onclick="location.href='log_in.php'">Entrar</button>
    </div>
</header>

<aside class="missing">
    <h3>Pessoas desaparecidas</h3>
    <?php if (isset($missings)) { ?>
    <ul>
        <?php foreach($missings as $missing) {
            $nif=$missing['nif'];
            $occurrence = getOccByMissingPerson($nif);
            echo '<li><h4>' . $missing['name'] . '</h4><p>' . $missing['birthdate'] . ' - ' . $missing['physical_description'] . '</p><p>' . $occurrence['location'] . '</p>';
            if (isset($missing['profile_pic'])) { ?>
                <img src="../person_pic/<?=$missing['profile_pic']?>.jpg">
            <?php }
        } ?>
    </ul>
    <p>Tem alguma pista? <a href="contact.php">Contacte-nos!</a></p>
    <p>Reporte um desaparecimento <a href="missing_person_submition.php">aqui</a>.</p>
    <?}?>
</aside>

<body id="public_body">
    <div class="stats">
    <div id="stats_title">
        <h3> Estatísticas</h3>
    <div class="stats_title">
    <div id="stat_form">
        <form class="stats" action="../actions/action_stats.php" method="post">
            <p><select name="station">
                    <option value="geral">Geral</option>
                    <?php $personnel="Detetive";
                    $stations=GetStations();
                    foreach ($stations as $station){?>
                        <option value= <?=$station['id']?>> <?= $station['name'] ?> </option>
                    <?php } ?>          
            </select></p>
            <input type="submit" value="Verificar">
        </form>
    </div>
    <div id="stats">
        <?php if (isset($_GET['station']) and $_GET['station']!='geral'){
            $id=$_GET['station'];
            $station=GetStationByID($id);
            echo '<h3>' . $station['name'] . '</h3>';
            echo '<p>Casos abertos - ' . CountOccurrencesByStateAndStation('Aberto', $station)[0] . '</p>';
            echo '<p>Casos fechados - ' . CountOccurrencesByStateAndStation('Fechado', $station)[0] . '</p>';
            echo '<p>Casos arquivados - ' . CountOccurrencesByStateAndStation('Arquivado', $station)[0] . '</p>';
        }
        else {
            echo '<p>Casos abertos - ' . CountOccurrencesByState('Aberto')[0] . '</p>';
            echo '<p>Casos fechados - ' . CountOccurrencesByState('Fechado')[0] . '</p>';
            echo '<p>Casos arquivados - ' . CountOccurrencesByState('Arquivado')[0] . '</p>';
        } ?>
    </div>
    </div>
    <div class="news">
        <h3>Notícias</h3>
        <?php
        $i = 0;
        foreach($news as $new) {
            echo "<a href='news.php?id=" . $new['id'] . "'>" . "<h4>" . $new['title'] . "</h4></a>";
            echo '<footer>' . $new['date'] . '</footer>';
            if(++$i > 5) break;
        }
        ?>
    </div>
</body>
</div>
<?php include_once('../common/footer.php'); ?>
</html>