<?php 
    include_once('database/connection.php');    
    session_start();
    if (!isset($_SESSION['username'])){
        die("Página Privada");
    }
    $username = $_SESSION['username'];
    $gender=$name=$adress="xxxxx"; #Algo parvo a que comparar, ou entao compara a espaço e encontra sempre
    if(!empty($_POST["gender"])){
        $gender = $_POST["gender"];
    }   
    
    if(!empty($_POST["name"])){
        $name = $_POST["name"];
    } 

    if(!empty($_POST["adress"])){
        $adress = $_POST["adress"];  
    } 

    #Isto ta mesmo restolho e nao consigo as caracteristicas fisicas

    $person = FindPerson($gender, $name, $adress);   
    
?>
<!DOCTYPE html>
<html>

<title> Pesquisa de Pessoas </title>

<?php include_once('common/header_aside.php'); ?>

<body>
    <div class="search_results">

        <?php if (empty($person) ) {
            echo  "Did not find any results for this page.";
        } else{
            foreach($person as $person) { ?>
            <section>
                    <?php echo "<p>" . $person['name'] . "</p>"; ?>
            </section>
            <? }
        } ?>
        
    </div>

</body>

<?php include_once('common/footer.php'); ?>
</html>