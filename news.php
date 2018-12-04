<?php 
    include_once('database/connection.php');
    $id=$_GET["id"];
    $new=GetNewById($id);
    $missings = getMissingPeople();
?>

<!DOCTYPE html>
<html>
<title>Polícia Nacional</title>

<header id="header_public">
    <a href="public.php"><h2>Polícia Nacional</h2></a>
    <button type="log_in" onclick="location.href='log_in.php'">Entrar</button>
<header>

<aside id=missing>
    <h4>Pessoas desaparecidas</h4>
    <ul>
        <?php foreach($missings as $missing) {
            $occurrence = getOccByMissingPerson($missing);
            echo '<li><h5>' . $missing['name'] . '</h5><p>' . $missing['birthdate'] . ' - ' . $missing['physical_description'] . '</p><p>' . $occurrence['location'] . '</p>';
        } ?>
    </ul>
    <p>Tem alguma pista? <a href="contact.php">Contacte-nos!</a></p>
    <p>Reporte um desaparecimento <a href="missing_person_submition.php">aqui</a>.</p>
</aside>

<body>
    <div id="news_title">
        <?php echo "<h1>" . $new['title'] . "</h1>";
        echo "<h4>" . $new['date'] . "</h4>"; ?>
    </div>
    <div id="news_text">
        <?php echo "<p>" . $new['text'] . "</p>"; ?>
    </div>
</body>