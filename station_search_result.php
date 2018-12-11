<?php 
    include_once('database/connection.php');    
    session_start();
    if (!isset($_SESSION['username'])){
        die("Página Privada");
    }
    $username = $_SESSION['username'];
    
    $name=$city=""; 
    if(!empty($_POST["name"])){
        $name = $_POST["name"];
    } 

    if(!empty($_POST["city"])){
        $city = $_POST["city"];  
    }

    $stations = SearchStation($name, $city);   
    
?>
<!DOCTYPE html>
<html>

<title> Pesquisa de Pessoas </title>

<?php include_once('common/header_aside.php'); ?>

<body>
    <div class="search_results">

        <?php if (empty($stations) ) {
            echo  "Não foram encontrados resultados para a sua pesquisa.";
        } else{
            foreach($stations as $station) { ?>
            <section>
            <a href="station.php?station=<?=$station['id']?>"> <?=$station['name']?> </a> 
            </section>
            <? }
        } ?>
        
    </div>

</body>

<?php include_once('common/footer.php'); ?>
</html>