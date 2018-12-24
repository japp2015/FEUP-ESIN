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
  
    $name = $_POST["name"];
    $city = $_POST["city"];  

    $stations = SearchStation($name, $city);   
    
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Esquadras Encontradas </title>
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/layout.css" rel="stylesheet">
</head>

<div class="container">
<?php include_once('../common/header_aside.php'); ?>

<body>
    <div class="search_results">
    <h1> Esquadras Encontradas: </h1>
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

<?php include_once('../common/footer.php'); ?>
    </div>
</html>