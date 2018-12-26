<?php 
include_once('../database/connection.php');
session_start();
?>
    
<!DOCTYPE html>
<html>

<head>
    <title>Polícia Nacional</title>
    <link href="../css/public_style.css" rel="stylesheet">
    <link href="../css/public_layout.css" rel="stylesheet">
    <link href="../css/form.css" rel="stylesheet">
</head>
    
<div class="missing_container">

    <header class="header" id="header_public">
        <a href="public.php"><h2>Polícia Nacional</h2></a>
        <button type="log_in" onclick="location.href='log_in.php'">Entrar</button>
    </header>

    <body>
        <div class="person_info">
            <form id="missing_person" action="../actions/action_missing_person.php" method="post">
                <h3>Submissão de Pessoa Desaparecida</h3>
                <label>Sexo:</label>
                <label><input type="radio" name="gender" value="Masculino">Masculino</label>
                <label><input type="radio" name="gender" value="Feminino">Feminino</label><br>
                <label>Nome:<input type="text" name="name"></label><br>
                <label>Morada:<input type="text" name="adress"></label><br>
                <textarea name="physical_description" cols="40" rows="5" placeholder="Descrição física"></textarea><br>
                <label>Local do desaparecimento:<input type="text" name="local"></label><br>
                <label>Data do desaparecimento:<input type="date" name="date"></label><br>
                <label>Contacto de conhecido:<input type="number" name="contact"></label><br>
                <label>Associar esquadra:</label>
                <p><select name="station">
                        <?php
                        $stations=GetStations();
                        foreach ($stations as $station){?>
                            <option value= <?=$station['id']?>> <?= $station['name'] ?> </option>
                        <?php } ?>          
                </select></p>
                <?php if (isset($_GET['error'])) {
                    echo '<p id=error>' . $_GET['error'] . '</p>';
                }?>
                <input type="submit" value="Submeter">
            </form>
        </div>
        
    </body>
</div>
<?php include_once('../common/footer.php'); ?>
</html>