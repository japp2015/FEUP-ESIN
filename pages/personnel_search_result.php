<?php 
    include_once('../database/connection.php');    
    session_start();
    if (!isset($_SESSION['username'])){
        die("Página Privada");
    }
    $username = $_SESSION['username'];
    
    if (!isset($_POST['csrf']) || $_SESSION['csrf'] !== $_POST['csrf']) {
        die('Não autorizado');
    } 
    
    if (isset($_POST["gender"])){
        $gender = $_POST["gender"]; 
    }
    else {
        $gender="";
    }
    
    $name = $_POST["name"];
    $position = $_POST["position"];  
    $station = $_POST["station"];  

    $personnel = SearchPersonnel($gender,$name,$position,$station);   
    
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pessoal Encontrado</title>
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/layout_one.css" rel="stylesheet">
</head>

<div class="container">
    <?php include_once('../common/header_aside.php'); ?>

    <body>
        <div id="left"> 
        <h1> Pessoal Encontrado: </h1>
            <?php if (empty($personnel) ) {
                echo  "Não foram encontrados resultados para a sua pesquisa.";
            } else{
                foreach($personnel as $personnel) { ?>
                <section>
                        <?php echo "<p>" . $personnel['position'] . " " .$personnel['fullname'] . "</p>"; ?>
                </section>
                <? }
            } ?>
            
        </div>

    </body>

    <?php include_once('../common/footer.php'); ?>
</div>
</html>