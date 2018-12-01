<?php 
include_once('database/connection.php');
session_start();
$username = $_SESSION['username'];
$stations = GetAllStations();
?>

<!DOCTYPE html>
<html>
<title> Nova Esquadra: </title>

<?php include_once('common/header_aside.php'); ?>

<body>
    <section class = "add_station">
        <h2> Adicionar Nova Esquadra: </h2>
            <form action="action_station.php" method="post">
                <div> Nome da Esquadra: <input type="text" placeholder="Nome da Esquadra" name="name"></div>
                <div> Cidade: <input type="text" placeholder="Cidade" name="city"></div>
                <div> Morada: <input type="text" placeholder="Morada" name="adress"></div>
                <br>
                <div> <input type="submit" value="Adicionar"></div>
            </form>
    </section>
            
    </section>
  
</body>
</html>