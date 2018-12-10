<?php 
include_once('database/connection.php');
session_start();
?>

<!DOCTYPE html>
<html>
<title>Polícia Nacional</title>

<header id="header_public">
    <a href="public.php"><h2>Polícia Nacional</h2></a>
    <button type="log_in" onclick="location.href='log_in.php'">Entrar</button>
<header>

<body>
    <h1>Submeter pessoa desaparecida</h1>
    <div class="image_container">
        <form class="edit_image" action="action_upload_person_pic.php" method="post" enctype="multipart/form-data">
        <!--<input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">-->
        <h3>Imagem</h3>
        <label>Escolha um ficheiro</label>
            <input type="file" name="image">
            <input type="submit" value="Inserir">
        </form>
    </div>
    <div class="person_info">
        <form id="missing_person" action="action_missing_person.php" method="post">
            <!--<input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">-->
            <label>Sexo:</label>
            <label><input type="radio" name="gender" value="Masculino">Masculino</label>
            <label><input type="radio" name="gender" value="Feminino">Feminino</label><br>
            <label>Nome:<input type="text" name="name"></label><br>
            <label>Morada:<input type="text" name="adress"></label><br>
            <label>Descrição física:</label><br>
            <textarea name="physical_description" cols="40" rows="5" placeholder="Descrição física"></textarea><br>
            <label>Local do desaparecimento:<input type="text" name="local"></label><br>
            <label>Data do desaparecimento:<input type="date" name="date"></label><br>
            <label>Associar esquadra:</label>
            <p><select name="station">
                    <?php
                    $stations=GetStations();
                    foreach ($stations as $station){?>
                        <option value= <?=$station['id']?>> <?= $station['name'] ?> </option>
                    <?php } ?>          
            </select></p>
            <input type="submit" value="Submeter">
        </form>
    </div>
    
</body>
<?php include_once('common/footer.php'); ?>
</html>