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
    $adress = $_POST["adress"];  
    $physical_description = $_POST["physical_description"];  
  
    $person = SearchPerson($gender, $name, $adress,$physical_description);   
    
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Pessoas Encontradas </title>
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/layout.css" rel="stylesheet">
</head>

<div class="container">
<?php include_once('../common/header_aside.php'); ?>

<body>
    <div class="search_results"> 
    <h1> Pessoas Encontradas: </h1>
        <?php if (empty($person) ) {
            echo  "Não foram encontrados resultados para a sua pesquisa.";
        } else{
            foreach($person as $person) { ?>
            <section>
            <a href="person.php?nif=<?=$person['nif']?>"><?echo $person['name'];?></a>
            </section>
            <? }
        } ?>
        
    </div>

</body>

<?php include_once('../common/footer.php'); ?>
<div>
</html>