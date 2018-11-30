<?php 
include_once('database/connection.php');
session_start();
$username = $_SESSION['username'];
$stations = GetAllStations();
?>

<!DOCTYPE html>
<html>
<title> Nova Ocorrência </title>

<?php include_once('common/header_aside.php'); ?>

<body>
    <section id="Stations">
    <h1> Esquadras já existentes a nivel Nacional: </h1>
    <section class="view_stations">
            <?php foreach ($stations as $station) { ?>
                <h3 class="title"> <a href="station.php?station=<?=$station['id']?>"> <?=$station['name']?> </a> </h3>
            <?php } ?>
    </section>

    <section class = "add_station">
        <h2> Adicionar Nova Esquadra: </h2>
            <form action="action_station.php" method="post">
                <div> Nome da Esquadra: <input type="text" placeholder="Nome da Esquadra" name="name"></div>
                <div> Cidade: <input type="text" placeholder="Cidade" name="city"></div>
                <div> Morada: <input type="text" placeholder="Morada" name="adress"></div>
                    
                <section class="new_chief"> 
                    <p> Criar Chefe de Esquadra: </p>
                    <div> Username: <input type="text" placeholder="Username" name="username"> </div>
                    <div> Password: <input type="password" placeholder="Password" name="password"> </div>
                    <div> Confirme Password: <input type="password" placeholder="Confirme password" name="confirmed_password"> </div>
                    <div> E-mail: <input type="email" placeholder="E-mail" name="email"> </div>
                    <div> Nome Completo: <input type="text" placeholder="Nome Completo" name="Fullname"> </div>
                    <div> Género: <input type="text" placeholder="Género" name="gender "> </div>
                    <div> Naturalidade: <input type="text" placeholder="Naturalidade" name="naturality"> </div>
                    <div> Data de Nascimento: <input type="date"  name="birthday"> </div>
                    <div> Escola: <select name="school"> <?php $schools=GetAllSchools();
                        foreach ($schools as $school){?>
                             <option value= <?=$school['name']?>> <?= $school['name'] ?> </option>
                        <?php } ?>
                    </select> </div>
                </section>

                <div> <input type="submit" value="Adicionar"></div>
            </form>
    </section>
            
    </section>
  
</body>
</html>