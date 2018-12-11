<?php 
    include_once('database/connection.php');    
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

<title> Pesquisa de Pessoas </title>

<?php include_once('common/header_aside.php'); ?>

<body>
    <div class="search_results"> 

        <?php if (empty($person) ) {
            echo  "Não foram encontrados resultados para a sua pesquisa.";
        } else{
            foreach($person as $person) { ?>
            <section>
                    <?php echo "<p>" . $person['name'] . "</p>"; #remeter para a pagina da pessoa quando estiver funcional ?>
            </section>
            <? }
        } ?>
        
    </div>

</body>

<?php include_once('common/footer.php'); ?>
</html>