<?php 
    include_once('database/connection.php');    
    session_start();
    if (!isset($_SESSION['username'])){
        die("Página Privada");
    }
    $username = $_SESSION['username'];
    
    $gender=$name=$adress=$physical_description=""; 
    if(!empty($_POST["gender"])){
        $gender = $_POST["gender"];
    }   
    
    if(!empty($_POST["name"])){
        $name = $_POST["name"];
    } 

    if(!empty($_POST["adress"])){
        $adress = $_POST["adress"];  
    }

    if(!empty($_POST["physical_description"])){
        $physical_description = $_POST["physical_description"];  
    }
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