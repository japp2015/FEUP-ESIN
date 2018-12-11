<?php 
    include_once('database/connection.php');    
    session_start();
    if (!isset($_SESSION['username'])){
        die("Página Privada");
    }
    $username = $_SESSION['username'];
    
    $gender=$name=$position=$station=""; 
    if(!empty($_POST["gender"])){
        $gender = $_POST["gender"];
    }   
    
    if(!empty($_POST["name"])){
        $name = $_POST["name"];
    }  
    if(!empty($_POST["position"])){
        $position = $_POST["position"];  
    } 
    if(!empty($_POST["station"])){
        $station = $_POST["station"];  
    } 

    $personnel = SearchPersonnel($gender,$name,$position,$station);   
    
?>
<!DOCTYPE html>
<html>

<title> Pesquisa de Pessoas </title>

<?php include_once('common/header_aside.php'); ?>

<body>
    <div class="search_results">

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

<?php include_once('common/footer.php'); ?>
</html>